<?php
namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function userBlockAction($name = 'juanis')
    {        
        
        return $this->render(
                'BoomFrontBundle:User:blocks/header.html.php'
                );
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