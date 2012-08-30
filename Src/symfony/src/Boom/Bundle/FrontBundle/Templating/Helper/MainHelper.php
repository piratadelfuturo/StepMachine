<?php

namespace Boom\Bundle\FrontBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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

    public function getLatestCollaborators($number = 7) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:User');
        return $repo->getLatestCollaborators($number);
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

    public function getName() {
        return 'boom_front';
    }

}