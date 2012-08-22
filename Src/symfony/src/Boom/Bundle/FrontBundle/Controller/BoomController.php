<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Form\BoomType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Boom controller.
 *
 */
class BoomController extends Controller
{
    /**
     * Lists all Boom entities.
     *
     */
    public function indexAction()
    {
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
    public function newAction()
    {
        $entity = new Boom();
        $form   = $this->createForm(new BoomType(), $entity);

        return $this->render('BoomFrontBundle:Boom:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Boom entity.
     *
     */
    public function createAction()
    {
        $entity  = new Boom();
        $request = $this->getRequest();
        $form    = $this->createForm(new BoomType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boom_show', array('id' => $entity->getId())));
        }

        return $this->render('BoomFrontBundle:Boom:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Boom entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:Boom')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm = $this->createForm(new BoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomFrontBundle:Boom:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Boom entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:Boom')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm   = $this->createForm(new BoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boom_edit', array('id' => $id)));
        }

        return $this->render('BoomFrontBundle:Boom:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Boom entity.
     *
     */
    public function deleteAction($id)
    {
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

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
