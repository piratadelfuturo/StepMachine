<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Boomelement;
use Boom\Bundle\FrontBundle\Form\BoomType;
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
    public function reorderAction() {
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
    public function createAction() {
        $form = $this->createForm(new BoomType());
        $request = $this->getRequest();
        $form->bind($request);
        $entity = $form->getData();

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity['user'] = $sessionUser;
            $entity['status'] = Boom::STATUS_PRIVATE;

            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                            $this->generateUrl(
                                    'BoomBackBundle_boom_edit', array(
                                'id' => $entity->getId()
                                    )
                            )
            );
        }


        return $this->render('BoomBackBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Replies a new Boom entity.
     *
     */
    public function replyAction($slug) {

        $em = $this->getDoctrine()->getManager();
        $foundEntity = $em->getRepository('BoomLibraryBundle:Boom')->findOneBySlug($slug);

        if (!$entity || $entity['status'] !== Boom::STATUS_PUBLIC) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $clonedBoomValues = array(
            'title',
            'summary',
            'image',
            'category',
            'tags');

        $clonedBoomelementValues = array(
            'title',
            'content',
            'position',
            'image'
        );


        $entity = new Boom();
        foreach ($clonedBoomValues as $clBoomV) {
            $entity[$clBoomV] = $foundEntity[$clBoomV];
        }
        foreach ($entity['elements'] as $entElem) {
            $element = new Boomelement();
            foreach ($clonedBoomelementValues as $clBoomelV) {
                $element[$clBoomelV] = $entElem[$clBoomelV];
            }
            $entity->addElement($element);
        }
        $form = $this->createForm(new BoomType(), $entity);

        return $this->render('BoomFrontBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Replies a new Boom entity.
     *
     */
    public function repliedAction($slug) {

        $em = $this->getDoctrine()->getManager();
        $foundEntity = $em->getRepository('BoomLibraryBundle:Boom')->findOneBySlug($slug);

        if (!$foundEntity || $foundEntity['status'] !== Boom::STATUS_PUBLIC) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $request = $this->getRequest();
        $form = $this->createForm(new BoomType());
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity['parent'] = $foundEntity;
            $entity['user'] = $sessionUser;
            $entity['status'] = Boom::STATUS_PRIVATE;

            $em->persist($entity);
            $sessionToken = $this->get('security.context')->getToken();
            $entity->setUser($sessionToken->getUser());

            $em->flush();

            return $this->redirect(
                            $this->generateUrl(
                                    'BoomFrontBundle_boom_show', array(
                                'slug_category' => $entity['category']['name'],
                                'slug' => $entity['slug']
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

        if (!$entity || !in_array($entity['status'], array(Boom::STATUS_PUBLIC, Boom::STATUS_PRIVATE))) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        if ($entity['user']['id'] !== $sessionUser['id']) {
            throw new HttpException(401,'Unauthorized access.');
        }

        $editForm = $this->createForm(new BoomType(), $entity);

        return $this->render('BoomFrontBundle:Boom:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView()
                ));
    }

    /**
     * Edits an existing Boom entity.
     *
     */
    public function updateAction($slug) {

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneBySlug($slug);


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
            $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneBySlug($slug);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Boom entity.');
            }

            if ($entity['user']['id'] !== $sessionUser) {
                throw $this->createNotFoundException('Unable to find Boom entity.');
            }
            $entity['status'] = Boom::STATUS_DELETE;
            $em->persist($entity);
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
