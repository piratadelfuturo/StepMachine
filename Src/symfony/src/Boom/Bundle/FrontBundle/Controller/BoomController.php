<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Boomelement;
use Boom\Bundle\BackBundle\Form\BoomType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Boom controller.
 *
 */
class BoomController extends Controller {

    /**
     * Lists all Boom entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BoomLibraryBundle:Boom')->findAll();

        return $this->render('BoomFrontBundle:Boom:index.html.php', array(
                    'entities' => $entities,
                ));
    }

    
    /**
     * Displays a form to create a new Boom entity.
     *
     */
    public function newAction() {
        $entity = new Boom();
        for ($i = 1; $i <= 7; $i++) {
            $element = new Boomelement();
            $element->setPosition($i);
            $entity->addElement($element);
        }
        $form = $this->createForm(new BoomType(), $entity);

        return $this->render('BoomFrontBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Creates a new Boom entity.
     *
     */
    public function replyAction($slug) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneBySlug($slug);

        if (!$entity || $entity['status'] !== Boom::STATUS_PUBLIC) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }


        $request = $this->getRequest();
        $form = $this->createForm(new BoomType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $sessionToken = $this->get('security.context')->getToken();
            $entity->setUser($sessionToken->getUser());

            $em->flush();

            return $this->redirect(
                            $this->generateUrl(
                                    'BoomFrontBundle_slug_show', array(
                                'slug' => $entity['maincategory']['name'].'/'.$entity['slug']
                                    )
                            )
            );
        }

        return $this->render('BoomFrontBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Displays a form to edit an existing Boom entity.
     *
     */
    public function editAction($slug) {
        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneBySlug($slug);
        if($entity['user']['id'] !== $sessionUser['id']){
            throw new HttpException('Unauthorized access.', 401);
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm = $this->createForm(new BoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomFrontBundle:Boom:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Edits an existing Boom entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:Boom')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm = $this->createForm(new BoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boom_edit', array('id' => $id)));
        }

        return $this->render('BoomFrontBundle:Boom:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a Boom entity.
     *
     */
    public function deleteAction($slug) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoomLibraryBundle:Boom')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Boom entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('boom'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
