<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
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
}
