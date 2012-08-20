<?php

namespace Boom\Bundle\FrontBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class MainHelper extends Helper {
    //put your code here

    protected $container;

    public function __construct(ContainerInterface $container){
        $this->container = $container;

    }

    public function getFeaturedCategories(){
        $em = $this->container->get('doctrine')->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Category');
        return $repo->findFeaturedCategories();
    }


    public function getName(){
        return 'boom_front';
    }


}