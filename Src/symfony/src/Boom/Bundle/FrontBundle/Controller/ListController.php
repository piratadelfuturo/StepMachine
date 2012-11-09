<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;

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
                array('boom.date_published' => 'DESC')
                , $limit
                , $limit * ($page - 1)
                , array(Boom::STATUS_PUBLIC)
        );

        $total = $boomRepo->totalFeaturedBooms(array(Boom::STATUS_PUBLIC));


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'page_title' => 'Recomendados',
                    'total' => $total,
                    'page' => $page,
                    'list' => $list,
                    'limit' => $limit
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

        $total = $boomRepo->totalBoomsByCategory($thisCat, array(Boom::STATUS_PUBLIC), true);


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $latest,
                    'entity' => $thisCat,
                    'limit' => $limit,
                    'page_title' => 'recomendados'
                ));
    }

    public function latestAction($page = 1) {

        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $list = $boomRepo->findLatestBooms(
                array(
            'boom.date_published' => 'DESC'
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
                    'list' => $list,
                    'limit' => $limit,
                    'page_title' => 'últimos'
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
            'boom.date_published' => 'DESC'
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
                    'list' => $list,
                    'limit' => $limit,
                    'page_title' => 'últimos'
                ));
    }

    public function usersCategoryAction($slug, $page = 1) {
        /* @var $boomRepo \Boom\Bundle\LibraryBundle\Repository\BoomRepository */
        /* @var $catRepo \Boom\Bundle\LibraryBundle\Repository\CategoryRepository */
        $limit = 14;
        $em = $this->getDoctrine()->getManager();
        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');

        $thisCat = $catRepo->findOneBySlug($slug);

        if (is_null($thisCat) || $thisCat == false) {
            throw $this->createNotFoundException('Categoría no existente');
        }
        $boomRepo->
                $list = $boomRepo->findUserBoomsByCategory(
                $thisCat
                , array(
            'boom.date_published' => 'DESC'
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
                    'list' => $list,
                    'limit' => $limit,
                    'page_title' => 'usuarios'
                ));
    }

    public function usersAction($page = 1) {
        /* @var $boomRepo \Boom\Bundle\LibraryBundle\Repository\BoomRepository */
        $limit = 14;

        $em = $this->getDoctrine()->getManager();
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');


        $list = $boomRepo->findUsersBooms(
                array(
            'boom.date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(Boom::STATUS_PUBLIC, Boom::STATUS_PRIVATE)
        );

        $total = $boomRepo->totalUsersBooms(array(Boom::STATUS_PUBLIC, Boom::STATUS_PRIVATE)
        );

        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list,
                    'limit' => $limit,
                    'page_title' => 'usuarios'
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
            'boom.date_published' => 'DESC'
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
                    'list' => $list,
                    'limit' => $limit,
                    'page_title' => 'colaboradores'
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
            'boom.date_published' => 'DESC'
                )
                , $limit
                , $limit * ($page - 1)
                , array(
            'status' => Boom::STATUS_PUBLIC
                ), false, true
        );

        $total = $boomRepo->totalUsersBooms(
                array(
            'status' => Boom::STATUS_PUBLIC
                ), false, true
        );


        return $this->render('BoomFrontBundle:List:booms.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $list,
                    'limit' => $limit,
                    'page_title' => 'colaboradores'
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
                , array('boom.date_published' => 'DESC')
                , $limit
                , $limit * ($page - 1)
                , array(Boom::STATUS_PUBLIC)
        );

        $total = $boomRepo->totalBoomsByTag($thisTag, array(Boom::STATUS_PUBLIC));

        return $this->render('BoomFrontBundle:List:tag.html.php', array(
                    'total' => $total,
                    'page' => $page,
                    'list' => $latest,
                    'entity' => $thisTag,
                    'limit' => $limit
                ));
    }

    public function userAction($username, $listname, $page = 1) {

        $limit = 7;
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:User')->findOneByUsername($username);
        if (!$entity) {
            throw $this->createNotFoundException('Usuario no existente.');
        }

        $list = $em->getRepository('BoomLibraryBundle:Boom')->findBy(
                array(
            'user' => $entity,
            'status' => Boom::STATUS_PUBLIC
                ), array('date_published' => 'DESC'), $limit, $limit * ($page - 1)
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

        return $this->render(
                        'BoomFrontBundle:List:user.html.php', array(
                    'list' => $list,
                    'total' => $total,
                    'limit' => $limit,
                    'page' => $page
                        )
        );
    }

}