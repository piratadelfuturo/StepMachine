<?php
namespace Boom\Bundle\LibraryBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ImageHelper extends Helper {
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

    public function getBoomImagePath(){
        return $this->container->getParameter('boom_library.boom_image_path');
    }

    public function getUserImagePath(){
        return $this->container->getParameter('boom_library.boom_user_path');
    }

    public function imageExists(){

    }

    public function thumb(){

    }

    public function getName(){
        return 'boom_image';
    }

}