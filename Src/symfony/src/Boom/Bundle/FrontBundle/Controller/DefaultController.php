<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class DefaultController extends Controller {

    public function indexAction() {
        /** @var \Boom\Bundle\LibraryBundle\Repository\BoomRepository $repo */
        $response = new Response();
        /*
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $response->setPrivate();
        } else {
            $response->setPublic();
        }

        $date = new \DateTime();
        $date->modify('+600 seconds');
        $response->setExpires($date);
        */
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        $listRepo = $em->getRepository('BoomLibraryBundle:ListGroup');

        $latest = $repo->findBy(
                array('status' => Boom::STATUS_PUBLIC), array('date_published' => 'DESC'), 7, 0);

        $users = $repo->findUsersBooms();

        $featured = $repo->findFeaturedBooms(
                array('boom.date_published' => 'DESC'), 7, 0, array(
            'status' => Boom::STATUS_PUBLIC
                )
        );

        $top = $listRepo->findOneBy(
                array(
                    'block' => 'home_page',
                    'name' => 'top'
                ));

        $weekly = $listRepo->findOneBy(
                array(
                    'block' => 'home_page',
                    'name' => 'semanal'
                ));

        $viewVars = array(
            'top' => $top,
            'weekly' => $weekly,
            'users' => $users,
            'featured' => $featured,
            'latest' => $latest
        );

        //var_dump($viewVars);
        //exit;
        return $this->render('BoomFrontBundle:Default:index.html.php', $viewVars, $response);
    }

    public function testAction() {
        return $this->render('BoomFrontBundle:Default:test.html.php');
    }

    public function bigTopBlockAction() {
        return $this->render(
                        'BoomFrontBundle:Default:blocks/bigTop.html.php');
    }

    public function showAction($slug) {

        $slugArray = explode('/', $slug);
        $slugCount = count($slugArray);
        $response = new Response();

        switch ($slugCount) {
            case 1:
                $response = $this->categoryAction($slug);
                break;
            case 2:
                $response = $this->boomAction($slugArray);
                break;
            default:
                throw $this->createNotFoundException('Not found');
        }

        return $response;
    }

    public function boomAction($category_slug, $slug) {

        //$response = new Response();
        //$response->setPublic();
        //$response->setSharedMaxAge(600);
        //if ($response->isNotModified($this->getRequest()) == true && $this->get('kernel')->isDebug() == false) {
        //return $response;
        //} else {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneBy(
                array(
                    'slug' => $slug,
                    'status' => array(
                        Boom::STATUS_PUBLIC,
                        Boom::STATUS_PRIVATE
                    )
                )
        );

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find.');
        }
        if ($entity['category']['slug'] !== $category_slug) {
            throw $this->createNotFoundException('Unable to find.');
        }

        $thisCategory = $entity['category'];
        return $this->render(
                        'BoomFrontBundle:Boom:show.html.php', array(
                    'entity' => $entity,
                    'category' => $thisCategory
                ));

        //}
    }

    public function categoryAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');
        $listRepo = $em->getRepository('BoomLibraryBundle:ListGroup');

        $thisCategory = $catRepo->findOneBySlug($slug);

        if (is_null($thisCategory) || $thisCategory == false) {
            throw $this->createNotFoundException('Categoria no existente');
        }

        $latest = $boomRepo->findBoomsByCategory(
                $thisCategory, array('boom.date_published' => 'DESC')
                , 14
                , 0
                , array(Boom::STATUS_PUBLIC));

        $featured = $boomRepo->findBoomsByCategory(
                $thisCategory, array('boom.date_published' => 'DESC')
                , 14
                , 0
                , array(Boom::STATUS_PUBLIC), true);

        $top = $listRepo->findOneBy(
                array(
                    'block' => $thisCategory['slug'],
                    'name' => 'top'
                )
        );

        return $this->render('BoomFrontBundle:Category:index.html.php', array(
                    'top' => $top,
                    'featured' => $featured,
                    'latest' => $latest,
                    'category' => $thisCategory
                ));
    }

    public function twitCountAction($category_slug, $slug) {
        $cache = $this->get('cache.apc');
        $url = $this->generateUrl(
                'BoomFrontBundle_boom_show', array(
            'category_slug' => $category_slug,
            'slug' => $slug
                )
                , true);
        $count = $cache->fetch(md5($url));
        if ($count == false) {
            $count = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
            $cache->save(md5($url), $count, 120);
        }

        return new Response($count);
    }

}
