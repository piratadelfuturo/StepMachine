<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Image;
use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\BackBundle\Form\ImageFormType;

class ImageController extends Controller {

    public function indexAction(Request $request) {


        $get = $request->query->all();

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Image');
        $query = $repo->ajaxTable($get, true);
        $result = $query->getResult(Query::HYDRATE_ARRAY);

        if ($request->getRequestFormat() == 'json') {
            $response = new Response(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');
        } else {
            $response = $this->render(
                    'BoomBackBundle:Image:index.html.php', array(
                'result' => $result
                    )
            );
        }

        return $response;
    }

    public function newAction() {

        $entity = new Image();
        $form = $this->createForm(new ImageFormType(), $entity);


        return $this->render('BoomBackBundle:Image:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    public function createAction() {
        $form = $this->createForm(new ImageFormType());
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
                                    'BoomBackBundle_image_show', array(
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


    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('BoomLibraryBundle:Image');
        $entity = $repo->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm = $this->createForm(new ImageFormType(), $entity);
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

        $editForm = $this->createForm(new ImageFormType(), $entity);
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