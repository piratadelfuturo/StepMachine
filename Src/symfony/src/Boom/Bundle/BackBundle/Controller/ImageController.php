<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Form\BoomType;
use Boom\Bundle\LibraryBundle\Form\BoomelementType;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Boomelement;


class ImageController extends Controller {


    public function indexAction(Request $request){


        $get = $request->query->all();

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Image');
        $query = $repo->ajaxTable($get, true);
        $result = $query->getResult(Query::HYDRATE_ARRAY);

        if ($request->getRequestFormat() == 'json') {
            $response = new Response(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');
        }else{
            $response = $this->render(
                    'BoomBackBundle:Image:index.html.php',
                    array(
                        'result' => $result
                    )
                    );

        }

        return $response;


    }



}