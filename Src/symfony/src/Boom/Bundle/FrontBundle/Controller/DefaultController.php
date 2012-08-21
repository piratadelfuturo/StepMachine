<?php
namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('BoomFrontBundle:Default:index.html.php');
    }

    public function bigTopBlockAction(){
        return $this->render(
                'BoomFrontBundle:Default:blocks/bigTop.html.php');
    }

}
