<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Boom\Bundle\FrontBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Boom\Bundle\LibraryBundle\Entity\Image;

class ProfileController extends Controller {

    public function indexAction() {
        $data = array();

        return $this->render(
                        'BoomFrontBundle:Profile:index.html.php', array(
                    'data' => $data
                        )
        );
    }

    public function editAction() {
        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $form = $this->createForm(new UserType(), $sessionUser);

        return $this->render(
                        'BoomFrontBundle:Profile:edit.html.php', array(
                    'form' => $form->createView(),
                    'entity' => $sessionUser
                        )
        );
    }

    public function updateAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $form = $this->createForm(new UserType(), $sessionUser);
        $request = $this->getRequest();
        $form->bindRequest($request);

        if ($this->get('validator')->validate($sessionUser, array('front_edit'))) {
            $em->persist($sessionUser);
            $em->flush();

            return $this->redirect($this->generateUrl('BoomFrontBundle_profile_edit', array('id' => $id)));
        }
        return $this->render(
                        'BoomFrontBundle:Profile:edit.html.php', array(
                    'form' => $form->createView(),
                    'entity' => $sessionUser
                        )
        );
    }

    public function recentAction($page) {

    }

    public function boomsAction($page) {

    }

    public function userBlockAction() {
        $response = new Response();
        $template = 'BoomFrontBundle:Profile:blocks/header.html.php';
        $viewVars = array();

        $security = $this->container->get('security.context');

        if ($security->isGranted('ROLE_USER') == true) {
            $response->setPrivate();
            $response->setMaxAge(5);
            $response->headers->addCacheControlDirective('must-revalidate', true);
            $response->headers->addCacheControlDirective('no-cache', true);
        } else {
            $template = 'BoomFrontBundle:Profile:blocks/headerNotGranted.html.php';
            $response->setPublic();
            $response->setSharedMaxAge(600);
        }

        return $this->render($template, $viewVars, $response);
    }

    public function fbLoginAction(Request $request) {

        $query_referer = $request->query->get('referer');
        $header_referer = $request->headers->get('referer');

        $query_referer_array = parse_url($query_referer);
        $header_referer_array = parse_url($header_referer);

        if (isset($query_referer_array['host']) && $query_referer_array['host'] == $request->getHttpHost()) {
            $referer = $query_referer;
        } elseif (isset($header_referer_array['host']) && $header_referer_array['host'] == $request->getHttpHost()) {
            $referer = $header_referer;
        } else {
            $referer = $this->get('router')->generate('BoomFrontBundle_homepage');
        }

        $scope = $this->container->getParameter('fos_facebook.permissions');
        $facebook = $this->get('fos_facebook.api');
        $fbLoginCheck = $this->get('router')->generate('BoomFrontBundle_login_check_fb', array('referer' => $referer), true);

        $loginUrl = $facebook->getLoginUrl(
                array(
                    'scope' => implode(',', $scope),
                    'redirect_uri' => $fbLoginCheck)
        );

        return new RedirectResponse($loginUrl);
    }

    public function followingAction($page) {
        $limit = 14;
        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $result = $sessionUser['following']->slice(($page-1) * $limit,$limit);
        $total = $sessionUser['following']->count();
        return $this->render('BoomFrontBundle:User:user_list.html.php', array(
                    'page_title' => 'Sigues',
                    'list' => $result,
                    'total' => $total,
                    'limit' => $limit,
                    'page' => $page
                ));
    }

    public function followersAction($page) {

        $limit = 14;
        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $result = $sessionUser['followers']->slice(($page-1) * $limit,$limit);
        $total = $sessionUser['followers']->count();

        return $this->render('BoomFrontBundle:User:user_list.html.php', array(
                    'page_title' => 'Seguidores',
                    'list' => $result,
                    'total' => $total,
                    'limit' => $limit,
                    'page' => $page
                ));
    }

}
