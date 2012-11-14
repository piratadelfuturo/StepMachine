<?php

namespace Boom\Bundle\FrontBundle\Templating\Helper;

use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Activity;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Cache\PhpFileCache;

class MainHelper extends Helper {

    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getFeaturedCategories() {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Category');
        return $repo->findFeaturedCategories();
    }

    public function getFeaturedBooms() {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        $featured = $repo->findFeaturedBooms(
                array('boom.date_published' => 'DESC'), 7, 0, array(
            'status' => Boom::STATUS_PUBLIC
                )
        );
        return $featured;
    }

    public function getUserBoomReply(User $user, Boom $boom) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        return $repo->getUserBoomReply($user, $boom);
    }

    public function getFollowedActivities(User $user, $offset = 0, $limit = 14) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:User');
        return $repo->getFollowedActivities($user, $offset, $limit);
    }

    public function renderActivity(Activity $activity) {
        $activity_name = 'default';
        $allowed_activities = array('create', 'edit', 'fav');
        if (is_string($activity['data']) && in_array($activity['data'], $allowed_activities)) {
            $activity_name = $activity['data'];
        }
        $act = $this->_filterActivity($activity);

        return $this->container->get('templating')->render(
                        'BoomFrontBundle:Activity:blocks/' . $activity_name . '.html.php', array(
                    'entity' => $activity,
                    'act' => $act
                        )
        );
    }

    private function _filterActivity(Activity $entity) {
        $act = array();
        $act['self'] = false;
        $sessionToken = $this->container->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();
        $router = $this->container->get('router');
        if ($entity['user']['id'] === $sessionUser->getId()) {
            $act['user'] = $entity['boom']['user'];
            $act['self'] = true;
        } else {
            $act['user'] = $entity['user'];
        }
        $act['profile_url'] = $router->generate(
                'BoomFrontBundle_user_profile', array('username' => $entity['user']['username'])
        );
        if ($entity['boom'] !== null) {
            $act['boom_url'] = $router->generate(
                    'BoomFrontBundle_boom_show', array(
                'category_slug' => $entity['boom']['category']['slug'], 'slug' => $entity['boom']['slug']
                    )
            );
            $act['boom_profile_url'] = $router->generate(
                    'BoomFrontBundle_user_profile', array('username' => $entity['boom']['user']['username'])
            );
            $act['boom_user'] = $entity['boom']['user'];
            $act['boom_title'] = $entity['boom']['title'];
        }
        $act['date'] = $this->getLocaleFormatDate($entity['date'], 'EEE, d MMM, yyyy');
        return $act;
    }

    public function createActivity(User $user, $text = '', Boom $boom = null) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Activity');
        return $repo->createActivity($user, $text, $boom);
    }

    public function getLatestCollaborators($number = 7) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:User');
        return $repo->getLatestCollaborators($number);
    }

    public function getDailySeven() {
        $FileCache = new PhpFileCache(
                        $this->container->get('kernel')->getCacheDir(),
                        '.dailySeven.php');
        $dailySeven = $FileCache->fetch('dailySeven');
        if ($dailySeven == false) {
            $dailySeven = array();
        }
        return $dailySeven;
    }

    public function getWidgetBlock($block_name) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Widget');
        $widgets = $repo->findBy(array('block' => $block_name), array('position' => 'ASC'));
        $out = array();
        foreach ($widgets as $widget) {
            $out[] = $this->container->get('templating')->render(
                    'BoomFrontBundle:Widget:sidebarBlock.html.php', array(
                'entity' => $widget
                    )
            );
        }

        return $out;
    }

    public function getGallery($tag) {
        if (!isset($tag['attributes']['default'])) {
            return '';
        }
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Gallery');
        $gallery = $repo->findOneById($tag['attributes']['default']);
        return $this->container->get('templating')->render('BoomFrontBundle:Gallery:inline.html.php', array(
                    'entity' => $gallery
                        )
        );
    }

    public function getUserBoomOrder(User $user, Boom $boom) {
        $entity = null;
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:BoomelementRank');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');
        $order = $repo->findBy(array(
            'user' => $user,
            'boom' => $boom
                ), array('position' => 'ASC'));
        if (!empty($order)) {
            $entity = clone($boom);
            $entity['elements']->clear();
            $sort = 1;
            foreach ($order as $element) {
                $entity['elements'][] = $element['boomelement'];
                $sort++;
            }
        }

        return $entity;
    }

    public function getLocaleFormatDate(\DateTime $date, $format = '', \Locale $locale = null) {
        $locale = $locale !== null ? $locale : \Locale::getDefault();
        $ftm = new \IntlDateFormatter(
                        $locale,
                        \IntlDateFormatter::FULL,
                        \IntlDateFormatter::FULL
        );
        $ftm->setPattern($format);
        return $ftm->format($date);
    }

    public function ellipsis($text, $max = 100, $append = '&hellip;') {
        if (strlen($text) <= $max)
            return $text;
        $out = substr($text, 0, $max);
        if (strpos($text, ' ') === FALSE)
            return $out . $append;
        return preg_replace('/\w+$/', '', $out) . $append;
    }

    public function getName() {
        return 'boom_front';
    }

}