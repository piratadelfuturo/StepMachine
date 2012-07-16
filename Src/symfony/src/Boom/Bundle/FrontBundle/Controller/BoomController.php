<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BoomController extends Controller
{
    public function indexAction($name = 'juanis')
    {        
        
        return $this->render(
                'BoomFrontBundle:Default:index.html.php',
                array(
                    'name' => $name
                    )
                );
    }
    
    public function homeBlockAction($title = 'boom'){
        
        return $this->render(
                'BoomFrontBundle:Boom:home/block.html.php',
                array(
                    'title' => $title
                    )
                );        
    }
    
    public function longBlockAction(){
        
        return $this->render(
                'BoomFrontBundle:Boom:home/long.html.php',
                array(
                    'title' => $title
                    )
                );                
        
    }
    
}