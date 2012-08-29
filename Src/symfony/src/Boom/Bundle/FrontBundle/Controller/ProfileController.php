<?php
namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function userBlockAction()
    {
        $response = new Response();
        $template = 'BoomFrontBundle:Profile:blocks/header.html.php';
        $viewVars = array();

        $security = $this->container->get('security.context');

        if($security->isGranted('ROLE_USER') == true){
            $response->setPrivate();
            $response->setMaxAge(5);
        }else{
            $template = 'BoomFrontBundle:Profile:blocks/headerNotGranted.html.php';
            $response->setPublic();
            $response->setSharedMaxAge(600);
        }

        if ($response->isNotModified($this->getRequest()) == true) {
            return $response;
        }else{
            return  $this->render($template,$viewVars,$response);
        }

    }

    public function editAction(){

    }

    public function siteAction(){
        $data = array();

        return $this->render(
                'BoomFrontBundle:Profile:index.html.php',
                array(
                    'data' => $data
                )
                );
    }

    public function recentAction(){

    }

    public function myAction(){

    }

    public function recommendAction(){

    }

}