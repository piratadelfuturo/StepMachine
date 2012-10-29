<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class UserController extends Controller {

    public function listAction() {

    }

    public function collaboratorsAction($page) {
        $limit = 20;
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('BoomLibraryBundle:User')->findBy(
                array('collaborator' => true), array('username' => 'DESC'), $limit, $limit * ($page - 1)
        );

        $query = $em->createQuery('SELECT COUNT(u.id) FROM BoomLibraryBundle:User u WHERE u.collaborator = true');
        $total = $query->getSingleScalarResult();

        return $this->render('BoomFrontBundle:User:collaborators.html.php', array(
                    'list' => $result,
                    'total' => $total,
                    'limit' => $limit,
                    'page' => $page
                ));
    }

    public function profileAction($username, $listname, $page) {

        $limit = 20;
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:User')->findOneByUsername($username);
        if (!$entity) {
            throw $this->createNotFoundException('Usuario no existente.');
        }
        $modified = false;

        if ($listname == 'modificados') {
            $modified = true;
        }
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $list = $boomRepo->findBoomsByUser(
                $entity, $modified, array(Boom::STATUS_PUBLIC, Boom::STATUS_PRIVATE), $limit, $limit * ($page - 1)
        );

        $total = $boomRepo->totalBoomsByUser(
                $entity, $modified, array(Boom::STATUS_PUBLIC, Boom::STATUS_PRIVATE)
        );

        return $this->render('BoomFrontBundle:User:profile.html.php', array(
                    'entity' => $entity,
                    'list' => $list,
                    'total' => $total,
                    'limit' => $limit,
                    'page' => $page
                ));
    }

}