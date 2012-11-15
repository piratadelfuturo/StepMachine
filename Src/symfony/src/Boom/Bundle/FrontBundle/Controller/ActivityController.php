<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;

class ActivityController extends Controller {

    public function checkFollowStatusAction($username) {
        $request = $this->getRequest();
        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException('Forbidden method');
        }


        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        if ($username == $sessionUser['username']) {
            throw new AccessDeniedHttpException('Forbidden method');
        }

        $em = $this->getDoctrine()->getManager();
        $userRepo = $em->getRepository('BoomLibraryBundle:User');

        $response = array();
        if ($userRepo->checkFollowStatus($sessionUser->getUsername(), $username)) {
            $response = array(
                'follow' => true,
                'url' => $this->generateUrl('BoomFrontBundle_activity_unfollow', array('username' => $username))
            );
        } else {
            $response = array(
                'follow' => false,
                'url' => $this->generateUrl('BoomFrontBundle_activity_follow', array('username' => $username))
            );
        }

        return new Response(json_encode($response));
    }

    public function followAction($username) {
        $request = $this->getRequest();
        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException('Forbidden method');
        }

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        if ($username == $sessionUser['username']) {
            throw new AccessDeniedHttpException('Forbidden method');
        }

        $em = $this->getDoctrine()->getManager();
        $userRepo = $em->getRepository('BoomLibraryBundle:User');
        $entity = $userRepo->findOneByUsername($username);

        if (!$entity) {
            throw $this->createNotFoundException('Usuario inexistente.');
        }

        $sessionUser->addFollowing($entity);
        $em->persist($sessionUser);
        $em->flush();
        /*$em->getRepository('BoomLibraryBundle:Activity')->createActivity(
                $sessionUser,'Sigue a '.$entity['name']);*/


        $response = array();
        if ($userRepo->checkFollowStatus($sessionUser->getUsername(), $username)) {
            $response = array(
                'follow' => true,
                'url' => $this->generateUrl('BoomFrontBundle_activity_unfollow', array('username' => $username))
            );
        } else {
            $response = array(
                'follow' => false,
                'url' => $this->generateUrl('BoomFrontBundle_activity_follow', array('username' => $username))
            );
        }

        return new Response(json_encode($response));
    }

    public function unfollowAction($username) {
        $request = $this->getRequest();
        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException('Forbidden method');
        }

        $em = $this->getDoctrine()->getManager();
        $userRepo = $em->getRepository('BoomLibraryBundle:User');
        $entity = $userRepo->findOneByUsername($username);

        if (!$entity) {
            throw $this->createNotFoundException('Usuario inexistente.');
        }

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $sessionUser->removeFollowing($entity);
        $em->persist($sessionUser);
        $em->flush();

        $response = array();
        if ($userRepo->checkFollowStatus($sessionUser->getUsername(), $username)) {
            $response = array(
                'follow' => true,
                'url' => $this->generateUrl('BoomFrontBundle_activity_unfollow', array('username' => $username))
            );
        } else {
            $response = array(
                'follow' => false,
                'url' => $this->generateUrl('BoomFrontBundle_activity_follow', array('username' => $username))
            );
        }

        return new Response(json_encode($response));
    }

    public function recommendAction($slug) {

    }

    public function listAction($page = 1) {

    }

}