<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\BackBundle\Form\ListGroupType;
use Boom\Bundle\LibraryBundle\Entity\ListGroup;
use Boom\Bundle\LibraryBundle\Entity\ListElement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function dashboardAction() {
        return $this->render('BoomBackBundle:Default:dashboard.html.php');
    }

    public function clearCacheAction() {
        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN') == false) {
            $realCacheDir = $this->container->getParameter('kernel.cache_dir');
            $this->container->get('cache_clearer')->clear($realCacheDir);
            $this->container->get('cache.apc')->deleteAll();
            $this->get('session')->getFlashBag()->add('notice', 'El cache fué borrado, andale tú!');
        }
        return $this->redirect($this->generateUrl('BoomBackBundle_dashboard'));
    }

}
