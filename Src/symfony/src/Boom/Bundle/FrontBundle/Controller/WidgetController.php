<?php
namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WidgetController extends Controller
{
    public function dailyAction()
    {               
        return $this->render('BoomFrontBundle:Widget:daily.html.php');
    }
    
    public function collaboratorsAction()
    {               
        return $this->render('BoomFrontBundle:Widget:collaborators.html.php');
    }

    public function facebookAction()
    {               
        return $this->render('BoomFrontBundle:Widget:facebook.html.php');
    }

    
}