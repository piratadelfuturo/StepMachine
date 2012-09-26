<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Gallery;
use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\LibraryBundle\Form\AjaxGalleryType;

class GalleryController extends Controller {

    public function ajaxNewAction() {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $entity = new Gallery();
        $form = $this->createForm(new AjaxGalleryType(), $entity);
        $request = $this->getRequest();

        return $this->render('BoomBackBundle:Gallery:ajax_new.html.php', array(
                        'entity' => $entity,
                        'form' => $form->createView(),
                    ));
    }

    public function ajaxCreateAction() {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $entity = new Gallery();
        $form = $this->createForm(new AjaxGalleryType(), $entity);
        $request = $this->getRequest();
        $form->bind($request);

        $sessionToken = $this->get('security.context')->getToken();

        if ($sessionToken->getUser() instanceof User) {
            $entity->setUser($sessionToken->getUser());
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $result = array(
                'id' => $entity['id'],
                'entity' => $entity
            );
        } else {
            $result = $form->getErrorsAsString();
        }

        $response = new Response(
                        json_encode($result)
        );
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function ajaxEditAction($id) {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneById($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $form = $this->createForm(new AjaxGalleryType(), $entity);
        $request = $this->getRequest();

        return $this->render('BoomBackBundle:Gallery:ajax_new.html.php', array(
                        'entity' => $entity,
                        'form' => $form->createView(),
                    ));
    }

    public function ajaxUpdateAction($id) {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneById($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }
        $newImages = array();
        $originalImages = array();

        foreach ($entity['images'] as $image)
            $originalImages[] = $image;

        $form = $this->createForm(new AjaxGalleryType(), $entity);
        $request = $this->getRequest();
        $form->bind($request);

        if ($form->isValid()) {
            $newImages = &$entity['images'];
            foreach ($newImages as $n_img) {
                foreach ($originalImages as $key => $o_img) {
                    if ($o_img['id'] === $n_img['id']) {
                        unset($originalImages[$key]);
                    }
                }
            }
            foreach ($originalImages as $ole) {
                $em->remove($ole);
            }

            $em->persist($entity);
            $em->flush();
            $result = array(
                'id' => $entity['id']
            );
        }else{
            $result = $form->getErrorsAsString();
        }
        $response = new Response(
                        json_encode($result)
        );
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}