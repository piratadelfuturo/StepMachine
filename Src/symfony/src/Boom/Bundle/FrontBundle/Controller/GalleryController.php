<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Gallery;
use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\LibraryBundle\Form\GalleryType;

class GalleryController extends Controller {

    public function ajaxNewAction() {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $entity = new Gallery();
        $form = $this->createForm(new GalleryType(), $entity);
        $request = $this->getRequest();

        return $this->render('BoomFrontBundle:Gallery:ajax_new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    public function ajaxCreateAction() {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $entity = new Gallery();
        $form = $this->createForm(new GalleryType(), $entity);
        $request = $this->getRequest();
        $form->bind($request);

        $sessionToken = $this->get('security.context')->getToken();

        if ($sessionToken->getUser() instanceof User) {
            $entity->setUser($sessionToken->getUser());
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $relations = $entity['galleryimagerelations']->toArray();
            $entity['galleryimagerelations']->clear();
            $em->persist($entity);
            $em->flush();
            $entity['galleryimagerelations'] = $relations;
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
        $entity = $em->getRepository('BoomLibraryBundle:Gallery')->findOneById($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $form = $this->createForm(new GalleryType(), $entity);
        $request = $this->getRequest();

        return $this->render('BoomFrontBundle:Gallery:ajax_new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    public function ajaxUpdateAction($id) {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Gallery')->findOneById($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }
        $relations = $entity['galleryimagerelations']->toArray();

        $form = $this->createForm(new GalleryType(), $entity);
        $request = $this->getRequest();
        $form->bind($request);

        if ($form->isValid()) {
            $newRelations = $entity['galleryimagerelations']->toArray();
            $entity['galleryimagerelations']->clear();

            foreach ($newRelations as $n_r) {
                foreach ($relations as $key => $o_r) {
                    if ($o_r['image']['id'] === $n_r['image']['id']) {
                        unset($relations[$key]);
                    }
                }
            }
            foreach ($relations as $or) {
                $em->remove($or);
            }

            $em->persist($entity);
            $em->flush();
            $entity['galleryimagerelations'] = $newRelations;
            $em->persist($entity);
            $em->flush();
            $result = array(
                'id' => $entity['id']
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

    public function previewAction($id) {
        if ($this->container->has('profiler')) {
            $this->container->get('profiler')->disable();
        }
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Gallery')->findOneById($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        return $this->render('BoomFrontBundle:Gallery:preview.html.php', array(
                    'entity' => $entity
                ));
    }

}