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

    public function getBoomImageUrl($image_path, $w = null, $h = null, $default = ''){
        $path = $this->container->getParameter('boom_library.boom_image_path');
        if( ($w !== null || $h !== null) && $this->hasBoomImageSize($w,$h)){
            $image_path = explode('.',$image_path);
            $image_path = $image_path[0].'/'.$w.'_'.$h.'.'.$image_path[1];
        }
        $request    = $this->container->get('request');
        $assetUrl   = $this->container->get('templating.helper.assets')->getUrl($path.$image_path);
        //$finalUrl   = $request->getUriForPath($assetUrl);
        $finalUrl   = $assetUrl;
        return $finalUrl;
    }

    public function getBoomImageSizes(){
        return (array) $this->container->getParameter('boom_library.boom_image_sizes');
    }

    public function hasBoomImageSize($w,$h){
        $sizes = $this->getBoomImageSizes();
        foreach($sizes as $size){
            if($size['width'] == $w && $size['height'] == $h){
                return true;
            }
        }
        return false;
    }


    public function getProfileImagePath(){
        return $this->container->getParameter('boom_library.profile_image_path');
    }

    public function getProfileImageUrl($image_path, $size = null,$default = ''){
        if(strpos($image_path,'http://') == 0){
            return $image_path;
        }
        $path = $this->container->getParameter('boom_library.profile_image_path');
        if($size !== null && !empty($size) && count($size) == 2){
            $image_path = explode('.',$image_path);
            $image_path = $image_path[0].'/'.(int)$size[0].'_'.(int)$size[1].'.'.$image_path[1];
        }
        return $this->container->get('templating.helper.assets')->getUrl($path.$image_path);
    }

    public function imageExists(){

    }

    public function thumb(){

    }

    public function getName(){
        return 'boom_image';
    }

}