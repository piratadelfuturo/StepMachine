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

    public function recommendedAction($page = 1) {

    }

    public function latestAction($page = 1) {

    }

    public function userAction($page = 1) {

    }

    public function collaboratorAction($page = 1) {

    }

    public function topAction($page = 1) {

    }

    public function tagAction($slug,$page = 1){

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

        $total = $boomRepo->totalBoomsByTag($thisTag,array(Boom::STATUS_PUBLIC));

        return $this->render('BoomFrontBundle:List:tag.html.php', array(
                    'total'     => $total,
                    'page'      => $page,
                    'list'      => $latest,
                    'entity'    => $thisTag
                ));

    }

}