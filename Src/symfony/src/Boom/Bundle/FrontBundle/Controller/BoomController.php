<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Image;
use Boom\Bundle\LibraryBundle\Entity\Boomelement;
use Boom\Bundle\LibraryBundle\Entity\BoomelementRank;
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

    public function reorderAction($slug) {

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $em = $this->getDoctrine()->getManager();
        $boomRank = $em->getRepository('BoomLibraryBundle:Boom');
        $repoRank = $em->getRepository('BoomLibraryBundle:BoomelementRank');

        $boom = $boomRank->findOneBy($slug);

        $ranks = $repoRank->findBy(array(
            'boom' => $boom,
            'user' => $sessionUser
                ), array(
            'position' => 'ASC'
                ));

        $request = $this->getRequest();
        $newOrder = array();
        if (empty($ranks)) {
            //create ranks
            foreach ($newOrder as $original => $order) {
                $ranks[] = new BoomelementRank($boom, $boom['elements'][$original], $order);
            }
        } else {
            //update ranks
            foreach ($newOrder as $original => $order) {
                $ranks[$original]['position'] = $order;
            }
        }


        $response = new Response(
                        json_encode($ranks)
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function ajaxImageAction() {
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

    /**
     * Displays a form to create a new Boom entity.
     *
     */
    public function newAction() {
        $entity = new Boom();
        $entity['status'] = Boom::STATUS_PRIVATE;

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
        $entity = new Boom();
        $form = $this->createForm(new BoomType(), $entity);
        $request = $this->getRequest();
        $form->bind($request);

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
                                    'BoomFrontBundle_boom_edit', array(
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
        foreach ($entity['elements'] as $o_index => $entElem) {
            foreach ($clonedBoomelementValues as $clBoomelV) {
                $entity['elements'][$o_index][$clBoomelV] = $entElem[$clBoomelV];
            }
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
        $entity = new Boom();
        $form = $this->createForm(new BoomType(),$entity);
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
            throw new HttpException(401, 'Unauthorized access.');
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

        if ($entity['user']['id'] !== $sessionUser['id']) {
            throw new HttpException(401, 'Unauthorized access.');
        }


        $editForm = $this->createForm(new BoomType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boom_edit', array('id' => $id)));
        }

        return $this->render('BoomFrontBundle:Boom:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView()
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
