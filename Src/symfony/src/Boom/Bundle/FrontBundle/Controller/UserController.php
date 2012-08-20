<?php
namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function userBlockAction()
    {
        $response = new Response();
        $template = 'BoomFrontBundle:User:blocks/header.html.php';
        $viewVars = array();

        $security = $this->container->get('security.context');

        if($security->isGranted('ROLE_USER') == true){
            $response->setPrivate();
            $response->setMaxAge(5);
        }else{
            $template = 'BoomFrontBundle:User:blocks/headerNotGranted.html.php';
            $response->setPublic();
            $response->setSharedMaxAge(600);
        }

        if ($response->isNotModified($this->getRequest()) == true) {
            return $response;
        }else{
            return  $this->render($template,$viewVars,$response);
        }

    }


    public function indexAction(){

        $data = array();


        return $this->render(
                'BoomFrontBundle:User:index.html.php',
                array(
                    'data' => $data
                )
                );
    }

}