<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class UserController extends Controller{

    public function listAction(){

    }


    public function collaboratorsAction($page){
        $limit = 20;
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('BoomLibraryBundle:User')->findBy(
                array('collaborator' => true),
                array('username'     => 'DESC'),
                $limit,
                $limit*($page - 1)
                );

        $query = $em->createQuery('SELECT COUNT(u.id) FROM BoomLibraryBundle:User u WHERE u.collaborator = true');
        $total = $query->getSingleScalarResult();

        return $this->render('BoomFrontBundle:User:collaborators.html.php', array(
                    'list'  => $result,
                    'total' => $total,
                    'limit' => $limit,
                    'page'  => $page
                ));
    }


    public function profileAction($username,$page){

        $limit  = 20;
        $em     = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:User')->findOneByUsername($username);

        $list   = $em->getRepository('BoomLibraryBundle:Boom')->findBy(
                    array(
                        'user' => $entity,
                        'status' => Boom::STATUS_PUBLIC
                    ),
                    array('date_published' => 'DESC'),
                    $limit,
                    $limit*($page - 1)
                );

        $query = $em->createQuery('
            SELECT COUNT(b.id)
            FROM BoomLibraryBundle:Boom b
            WHERE
                b.status = ?0
                AND
                b.user = ?1');
        $query->setParameters(
                array(
                    Boom::STATUS_PUBLIC,
                    $entity)
                );
        $total = $query->getSingleScalarResult();

        return $this->render('BoomFrontBundle:User:profile.html.php', array(
            'entity'=> $entity,
            'list'  => $list,
            'total' => $total,
            'limit' => $limit,
            'page'  => $page
        ));
    }

}