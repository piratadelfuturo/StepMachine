<?php

namespace Boom\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Image;
use Boom\Bundle\LibraryBundle\Entity\BoomelementRank;
use Boom\Bundle\FrontBundle\Form\BoomType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Boom controller.
 *
 */
class BoomController extends Controller {

    public function favoriteStatusAction($slug) {
        $request = $this->getRequest();
        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException('Forbidden method');
        }

        /** @var Boom\Bundle\LibraryBundle\Repository\BoomRepository $boomRepo */
        /** @var Boom\Bundle\LibraryBundle\Entity\Boom $entity */
        $em = $this->getDoctrine()->getManager();
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');
        $entity = $boomRepo->findOneBySlug($slug);

        if (!$entity || !in_array($entity['status'], array(Boom::STATUS_PUBLIC, Boom::STATUS_PRIVATE))) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }
        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();
        $fav = $boomRepo->isFavoriteUser($entity, $sessionUser);
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $response = array(
                'fav' => $fav,
                'url' => $this->generateUrl(
                        'BoomFrontBundle_boom_fav', array(
                    'slug' => $slug,
                    '_format' => 'json'
                        )
                )
            );
            if ($fav == true) {
                $response['text'] = 'Quitar de favoritos.';
            } else {
                $response['text'] = 'Marcar como favorito.';
            }
            return new Response(json_encode($response));
        } else {
            return $this->redirect($this->generateUrl(
                                    'BoomFrontBundle_boom_show', array(
                                'category_slug' => $entity['category']['slug'],
                                'slug' => $entity['slug']
                                    )
                            ));
        }
    }

    public function favoriteAction($slug) {
        $request = $this->getRequest();
        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException('Forbidden method');
        }

        /** @var Boom\Bundle\LibraryBundle\Repository\BoomRepository $boomRepo */
        /** @var Boom\Bundle\LibraryBundle\Entity\Boom $entity */
        $em = $this->getDoctrine()->getManager();
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');
        $entity = $boomRepo->findOneBySlug($slug);

        if (!$entity || !in_array($entity['status'], array(Boom::STATUS_PUBLIC, Boom::STATUS_PRIVATE))) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }
        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();
        $fav = $boomRepo->isFavoriteUser($entity, $sessionUser);
        if ($fav) {
            $sessionUser->removeFavorite($entity);
        } else {
            $sessionUser->addFavorite($entity);
        }
        $em->persist($sessionUser);
        $em->flush();

        $response = array(
            'fav' => !$fav,
            'url' => $this->generateUrl(
                    'BoomFrontBundle_boom_fav', array(
                'slug' => $slug,
                '_format' => 'json'
                    )
            )
        );
        if (!$fav == true) {
            $response['text'] = 'Quitar de favoritos.';
        } else {
            $response['text'] = 'Marcar como favorito.';
        }


        return new Response(json_encode($response));
    }

    public function reorderAction($slug) {

        $request = $this->getRequest();
        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException('Forbidden method');
        }

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        $em = $this->getDoctrine()->getManager();
        $boomRepo = $em->getRepository('BoomLibraryBundle:Boom');
        $repoRank = $em->getRepository('BoomLibraryBundle:BoomelementRank');

        $boom = $boomRepo->findOneBySlug($slug);

        $ranks = $repoRank->findBy(array(
            'boom' => $boom,
            'user' => $sessionUser
                ), array(
            'position' => 'ASC'
                ));

        $newOrder = $request->request->get('order');
        if (empty($ranks)) {
            foreach ($newOrder as $original => $order) {
                $ranks[$order['final']] = new BoomelementRank($boom, $sessionUser, $boom['elements'][$order['original'] - 1], $order['final']);
                $em->persist($ranks[$order['final']]);
            }
        } else {
            foreach ($newOrder as $original => $order) {
                $ranks[$order['original'] - 1]['position'] = $order['final'];
                $em->persist($ranks[$order['original'] - 1]);
            }
        }
        $em->flush();

        $repoRank->calculatePublicRank($boom);

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
        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();
        $form->bind($request);
        $entity['user'] = $sessionUser;
        $entity['status'] = Boom::STATUS_PRIVATE;

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

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

        if (!$foundEntity || $foundEntity['status'] !== Boom::STATUS_PUBLIC) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $sessionToken = $this->get('security.context')->getToken();
        $sessionUser = $sessionToken->getUser();

        if ($sessionUser['id'] == $foundEntity['user']['id']) {
            throw new AccessDeniedHttpException('No puedes responder tus propios booms');
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
        foreach ($foundEntity['elements']->toArray() as $o_index => $entElem) {
            foreach ($clonedBoomelementValues as $clBoomelV) {
                $entity['elements'][$o_index][$clBoomelV] = $entElem[$clBoomelV];
            }
        }
        $entity['user'] = $sessionUser;

        $form = $this->createForm(new BoomType(), $entity);

        return $this->render('BoomFrontBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form_url' => $this->generateUrl(
                            'BoomFrontBundle_boom_replied', array(
                        'slug' => $foundEntity['slug']
                            )
                    ),
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

        if ($sessionUser['id'] == $foundEntity['user']['id']) {
            throw new AccessDeniedHttpException('No puedes responder tus propios booms');
        }


        $request = $this->getRequest();
        $entity = new Boom();
        $entity['parent'] = $foundEntity;
        $entity['user'] = $sessionUser;
        $entity['status'] = Boom::STATUS_PRIVATE;
        $form = $this->createForm(new BoomType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                            $this->generateUrl(
                                    'BoomFrontBundle_boom_show', array(
                                'category_slug' => $entity['category']['slug'],
                                'slug' => $entity['slug']
                                    )
                            )
            );
        }

        return $this->render('BoomFrontBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form_url' => $this->generateUrl(
                            'BoomFrontBundle_boom_replied', array(
                        'slug' => $slug
                            )
                    ),
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
