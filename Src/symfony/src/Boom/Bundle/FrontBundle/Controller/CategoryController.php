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
    public function indexAction($slug,$page)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('BoomLibraryBundle:Category')->findOneBySlug($slug);

        //$latest = $em->getRepository('BoomLibraryBundle:Boom')->findByCategories($category);
        
        $latest = array();
        
        
        return $this->render('BoomFrontBundle:Category:index.html.php',
                array(
            'latest' => $latest
        ));
    }

    
    
}