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

}
