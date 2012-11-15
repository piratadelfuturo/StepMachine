<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class UserController extends Controller {

    public function listAction() {

    }

    public function mailAction() {
        $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('server@7boom.mx')
                ->setTo('eder@brutalcontent.com')
                ->setBody('Ace of base rules');
        $this->get('mailer')->send($message);

        $response = new \Symfony\Component\HttpFoundation\Response(json_encode('miau'));
        return $response;
    }

    public function collaboratorsAction($page) {
        $limit = 14;
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('BoomLibraryBundle:User')->findBy(
                array('collaborator' => true), array('username' => 'DESC'), $limit, $limit * ($page - 1)
        );

        $query = $em->createQuery('SELECT COUNT(u.id) FROM BoomLibraryBundle:User u WHERE u.collaborator = true');
        $total = $query->getSingleScalarResult();

        return $this->render('BoomFrontBundle:User:user_list.html.php', array(
                    'page_title' => 'colaboradores',
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
                    'limit' => $limit,
                    'page' => $page
                ));
    }

}