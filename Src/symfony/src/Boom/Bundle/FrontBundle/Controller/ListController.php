<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Category;

/**
 * Boom controller.
 *
 */
class ListController extends Controller {

    public function featuredAction($page = 1) {

        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $list = $boomRepo->findFeaturedBooms(
                array('date_created' => 'DESC')
                , $limit
                , $limit * ($page - 1)
                , array(Boom::STATUS_PUBLIC)
        );

        $total = $boomRepo->totalBoomsByTag(array(Boom::STATUS_PUBLIC));


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list
                ));
    }

    public function featuredCategoryAction($slug, $page = 1) {

        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisCat = $catRepo->findOneBySlug($slug);

        if (is_null($thisCat) || $thisCat == false) {
            throw $this->createNotFoundException('Categoría no existente');
        }

        $latest = $boomRepo->findBoomsByCategory(
                $thisCat
                , array('date_published' => 'DESC')
                , $limit
                , $limit * ($page - 1)
                , array(Boom::STATUS_PUBLIC)
                , true
        );

        $total = $boomRepo->totalBoomsByTag($thisTag, array(Boom::STATUS_PUBLIC), true);


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $latest,
                    'entity' => $thisTag
                ));
    }

    public function latestAction($page = 1) {

        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $list = $boomRepo->findLatestBooms(
                array(
            'date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(
            'status' => Boom::STATUS_PUBLIC
                )
        );

        $total = $boomRepo->totalLatestBooms(
                array(
                    'status' => Boom::STATUS_PUBLIC
                )
        );


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list
                ));
    }

    public function latestCategoryAction($slug, $page = 1) {

        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisCat = $catRepo->findOneBySlug($slug);

        if (is_null($thisCat) || $thisCat == false) {
            throw $this->createNotFoundException('Categoría no existente');
        }


        $list = $boomRepo->findBoomsByCategory(
                $thisCat
                , array(
            'date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(
            'status' => Boom::STATUS_PUBLIC
                )
        );

        $total = $boomRepo->totalBoomsByCategory(
                $thisCat, array(
            'status' => Boom::STATUS_PUBLIC
                )
        );


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list
                ));
    }

    public function userCategoryAction($slug, $page = 1) {
        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisCat = $catRepo->findOneBySlug($slug);

        if (is_null($thisCat) || $thisCat == false) {
            throw $this->createNotFoundException('Categoría no existente');
        }

        $list = $boomRepo->findUserBoomsByCategory(
                $thisCat
                , array(
            'date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(
            'status' => Boom::STATUS_PUBLIC
                )
        );

        $total = $boomRepo->totalUserBoomsByCategory(
                $thisCat, array(
            'status' => Boom::STATUS_PUBLIC
                )
        );


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list
                ));
    }

    public function userAction($page = 1) {
        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisCat = $catRepo->findOneBySlug($slug);

        if (is_null($thisCat) || $thisCat == false) {
            throw $this->createNotFoundException('Categoría no existente');
        }

        $list = $boomRepo->findUsersBooms(
                array(
            'date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(
            'status' => Boom::STATUS_PUBLIC
                )
        );

        $total = $boomRepo->totalUsersBooms(
                array(
                    'status' => Boom::STATUS_PUBLIC
                )
        );


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list
                ));
    }

    public function collaboratorCategoryAction($slug, $page = 1) {
        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisCat = $catRepo->findOneBySlug($slug);

        if (is_null($thisCat) || $thisCat == false) {
            throw $this->createNotFoundException('Categoría no existente');
        }

        $list = $boomRepo->findUserBoomsByCategory(
                $thisCat
                , array(
            'date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(
            'status' => Boom::STATUS_PUBLIC
                ), false, true
        );

        $total = $boomRepo->totalUserBoomsByCategory(
                $thisCat, array(
            'status' => Boom::STATUS_PUBLIC
                ), false, true
        );


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list
                ));
    }

    public function collaboratorAction($page = 1) {
        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisCat = $catRepo->findOneBySlug($slug);

        if (is_null($thisCat) || $thisCat == false) {
            throw $this->createNotFoundException('Categoría no existente');
        }

        $list = $boomRepo->findUsersBooms(
                array(
            'date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(
            'status' => Boom::STATUS_PUBLIC
                ),false,true
        );

        $total = $boomRepo->totalUsersBooms(
                array(
                    'status' => Boom::STATUS_PUBLIC
                ),false, true
        );


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list
                ));
    }


    public function tagAction($slug, $page = 1) {

        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $tagRepo = $em->getRepository('BoomLibraryBundle:Tag');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisTag = $tagRepo->findOneBySlug($slug);

        if (is_null($thisTag) || $thisTag == false) {
            throw $this->createNotFoundException('Tag no existente');
        }

        $latest = $boomRepo->findBoomsByTag(
                $thisTag
                , array('date_created' => 'DESC')
                , $limit
                , $limit * ($page - 1)
                , array(Boom::STATUS_PUBLIC)
        );

        $total = $boomRepo->totalBoomsByTag($thisTag, array(Boom::STATUS_PUBLIC));

        return $this->render('BoomFrontBundle:List:tag.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $latest,
                    'entity' => $thisTag
                ));
    }

}