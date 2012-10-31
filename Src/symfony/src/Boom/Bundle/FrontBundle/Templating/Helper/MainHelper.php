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

    public function createActivity(User $user, $text = '', Boom $boom = null) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $act = new Activity($user, $text);
        if ($boom !== null) {
            $act['boom'] = $boom;
        }

        $em->persist($act);
        $em->flush();
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

    public function getUserBoomOrder($user_id, $boom_id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:BoomelementRank');
        return $repo->findBy(array(
                    'user' => $user_id,
                    'boom' => $boom_id
                ));
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

    public function getName() {
        return 'boom_front';
    }

}