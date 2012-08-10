<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Category;

/**
 * Boom controller.
 *
 */
class CategoryController extends Controller {

    /**
     * Lists all Boom entities.
     *
     */
    public function indexAction($slug, $page) {
        $em = $this->getDoctrine()->getManager();

        $catRepo = $em->getRepository('BoomLibraryBundle:Category');
        $thisCategory = $catRepo->findOneBySlug($slug);

        if (is_null($thisCategory) || $thisCategory == false) {
            throw $this->createNotFoundException('Categoria no existente');
        }

        $latest = $catRepo->findBoomsByCategory($thisCategory,'date_created','DESC',14);


        return $this->render('BoomFrontBundle:Category:index.html.php', array(
                    //'top' => $top,
                    'latest' => $latest,
                    'category' => $thisCategory
                ));
    }

}