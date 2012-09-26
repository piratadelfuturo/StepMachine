<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Image;
use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\LibraryBundle\Form\ImageType;
use Boom\Bundle\LibraryBundle\Form\AjaxImageType;

class ImageController extends Controller {

    public function indexAction(Request $request) {

        if ($request->getRequestFormat() !== 'json') {
            return $this->render('BoomBackBundle:Image:index.html.php');
        }

        $result = array();

        $get = $request->query->all();
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Image');
        $result['data'] = (array) $repo->findBy(array());
        $result['total'] = 100;

        $response = new Response(
                        json_encode($result)
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function newAction() {

        $entity = new Image();
        $form = $this->createForm(new ImageType(), $entity);


        return $this->render('BoomBackBundle:Image:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    public function createAction() {
        $form = $this->createForm(new ImageType(), new Image());
        $request = $this->getRequest();
        $form->bind($request);
        $entity = $form->getData();

        $sessionToken = $this->get('security.context')->getToken();

        if ($sessionToken->getUser() instanceof User) {
            $entity->setUser($sessionToken->getUser());
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                            $this->generateUrl(
                                    'BoomBackBundle_image_edit', array(
                                'id' => $entity->getId()
                                    )
                            )
            );
        }

        return $this->render('BoomBackBundle:Image:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    public function ajaxNewAction() {

        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $entity = new Image();
        $form = $this->createForm($this->get('boom_library.ajax_image.type'), $entity);
        $request = $this->getRequest();
        return $this->render('BoomBackBundle:Image:ajax_new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    public function ajaxCreateAction() {
        if ($this->getRequest()->isXmlHttpRequest() == false) {
            throw $this->createNotFoundException('Only ajax request');
        }

        $entity = new Image();
        $request = $this->getRequest();
        $file = $request->files->get($request->query->get('path'), null, true);
        if ($file instanceOf \Symfony\Component\HttpFoundation\File\UploadedFile) {
            $entity['file'] = $file;
            $sessionToken = $this->get('security.context')->getToken();

            if ($sessionToken->getUser() instanceof User) {
                $entity->setUser($sessionToken->getUser());
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $imgHelper = $this->get('boom_library.image.helper');
            $result = array(
                'id' => $entity['id'],
                'path' => $imgHelper->getBoomImageUrl(
                        $entity['path'], $request->query->get('w', 158), $request->query->get('h', 90)
                )
            );
        } else {
            $result = null;
        }

        $response = new Response(
                        json_encode($result)
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('BoomLibraryBundle:Image');
        $entity = $repo->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm = $this->createForm(new ImageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Image:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'entity' => $entity
                ));
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:Image')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $editForm = $this->createForm(new ImageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('BoomBackBundle_image_edit', array('id' => $id)));
        }

        return $this->render('BoomBackBundle:Image:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm();
    }

}