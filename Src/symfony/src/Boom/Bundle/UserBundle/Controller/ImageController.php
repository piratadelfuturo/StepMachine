<?php
namespace Boom\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ImageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BoomUserBundle:Default:index.html.twig', array('name' => $name));
    }



}
