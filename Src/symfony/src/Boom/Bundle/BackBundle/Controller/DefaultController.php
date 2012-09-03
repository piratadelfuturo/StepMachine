<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\BackBundle\Form\ListBlockType;

class DefaultController extends Controller {

    public function dashboardAction() {
        return $this->render('BoomBackBundle:Default:dashboard.html.php');
    }

    public function homepageAction() {
        $blockName = 'home_page';
        $blocks = 2;
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        $entity['list_groups'] = $repo->findBy(array('block' => $blockName), array('position' => 'ASC'));
        if (empty($entity['list_groups'])) {
            for ($i = 1; $i <= $blocks; $i++) {
                $entity['list_groups'][] = new ListGroup();
            }
        } elseif (count($entity['list_groups']) < $blocks) {
            $increase = count($entity['list_groups']) - $blocks;
            for ($i = $increase; $i <= $blocks; $i++) {
                $entity['list_groups'][] = new ListGroup();
            }
        }

        $form = $this->createForm(new ListBlockType(), $entities);

        return $this->render(
                        'BoomBackBundle:Default:homepage.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                        )
        );
    }

}
