<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('BoomBackBundle:Default:dashboard.html.php');
    }

    public function homepageAction()
    {


        return $this->render('BoomBackBundle:Default:homepage.html.php');
    }


}
