<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\BackBundle\Form\BoomType;
use Boom\Bundle\LibraryBundle\Form\AjaxImageType;
use Boom\Bundle\LibraryBundle\Entity as BoomEntity;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\LibraryBundle\Entity\Image;

class BoomController extends Controller {

    public function featureAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneById($id);
        if (!$entity) {
            $entity = new BoomEntity\Boom();
        }
        $entity['featured'] = new \DateTime();
        $entity['status'] = Boom::STATUS_PUBLIC;
        $em->persist($entity);
        $em->flush();
        $response = new Response(json_encode($entity['featured']->format(\DateTime::RFC2822)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function previewAction($id) {

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BoomLibraryBundle:Boom')->findOneById($id);

        if (!$entity) {
            $entity = new BoomEntity\Boom();
        }

        $form = $this->createForm(new BoomType($em), $entity);
        $form->bind($request);
        $sessionToken = $this->get('security.context')->getToken();

        if ($sessionToken->getUser() instanceof BoomEntity\User) {
            $sessionUser = $sessionToken->getUser();
            $entity['user'] = $sessionUser;
        }


        if (!$form->isValid()) {
            throw $this->createNotFoundException('Invalid form information');
        }

        return $this->render(
                        'BoomFrontBundle:Boom:show.html.php', array(
                    'entity' => $entity,
                    'category' => $entity['category'],
                    'user_reordered' => null,
                    'is_visible' => false
                        )
        );
    }

    /**
     * Lists all Boom entities.
     *
     */
    public function indexAction(Request $request) {

        if ($request->getRequestFormat() == 'html') {
            return $this->render('BoomBackBundle:Boom:index.html.php');
        }

        $get = $request->query->all();

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $columns = array(
            'id',
            'title',
            'slug',
            array(
                'category' => array(
                    'name'
                )
            ),
            'date_created',
            'status',
            array(
                'user' => array(
                    'username'
                )
            ),
            'featured',
            'id action_id'
        );
        $get['columns'] = $columns;

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        $result = $repo->ajaxTable($get, true);
        $rResult = $result['query']->getArrayResult();
        $rResult = array_map(function($value) {
                    $value = array_map(function($value) {
                                if ($value instanceof \DateTime) {
                                    $value = $value->format(\DateTime::RFC2822);
                                }
                                return $value;
                            }, $value);
                    return $value;
                }, $rResult);

        /* Data set length after filtering */
        $iFilteredTotal = $result['total'];


        if (!empty($rResult)) {
            $columnNames = array_keys(current($rResult));
        }

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval(isset($get['sEcho']) ? $get['sEcho'] : NULL),
            "iTotalRecords" => (int) $repo->getCount(),
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($columnNames); $i++) {
                if ($columnNames[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$columnNames[$i]] == "0") ? '-' : $aRow[$columnNames[$i]];
                } elseif ($columnNames[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$columnNames[$i]];
                }
            }
            $output['aaData'][] = $row;
        }

        unset($rResult);

        $response = new Response(
                        json_encode($output)
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Finds and displays a Boom entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:Boom')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Boom:show.html.php', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Boom entity.
     *
     */
    public function newAction() {

        $entity = new BoomEntity\Boom();
        $sessionToken = $this->get('security.context')->getToken();
        if ($sessionToken->getUser() instanceof BoomEntity\User) {
            $entity['user'] = $sessionToken->getUser();
        }

        $form = $this->createForm(new BoomType($this->getDoctrine()->getManager()), $entity);

        return $this->render('BoomBackBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'ajax_image_form' => $this->createAjaxImageForm()->createView()
                ));
    }

    /**
     * Creates a new Boom entity.
     */
    public function createAction() {
        /* @var */

        $entity = new Boom();
        $form = $this->createForm(new BoomType($this->getDoctrine()->getManager()), $entity);
        $request = $this->getRequest();
        $sessionToken = $this->get('security.context')->getToken();
        if ($sessionToken->getUser() instanceof User) {
            $entity['user'] = $sessionToken->getUser();
        }
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Boom guardado!');
            if (($entity['status'] === Boom::STATUS_PUBLIC
                    || $entity['status'] === Boom::STATUS_PRIVATE
                    ) && $entity['datepublished'] <= new \DateTime("now")
            ) {
                $em->getRepository('BoomLibraryBundle:Activity')->createActivity(
                        $entity['user'], 'create', $entity);
            }
            return $this->redirect(
                            $this->generateUrl(
                                    'BoomBackBundle_boom_edit', array(
                                'id' => $entity->getId()
                                    )
                            )
            );
        } else {
            $this->get('session')->getFlashBag()->add('notice', 'Boom NO guardado!');
        }


        return $this->render('BoomBackBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                    'ajax_image_form' => $this->createAjaxImageForm()->createView()
                ));
    }

    /**
     * Displays a form to edit an existing Boom entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        $entity = $repo->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm = $this->createForm(new BoomType($this->getDoctrine()->getManager()), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Boom:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'ajax_image_form' => $this->createAjaxImageForm()->createView()
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

        $editForm = $this->createForm(new BoomType($this->getDoctrine()->getManager()), $entity);
        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Boom guardado!');
            return $this->redirect($this->generateUrl('BoomBackBundle_boom_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('notice', 'Boom NO guardado!');
        }

        return $this->render('BoomBackBundle:Boom:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'ajax_image_form' => $this->createAjaxImageForm()->createView()
                ));
    }

    /**
     * Deletes a Boom entity.
     *
     */
    public function deleteAction($id) {
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

        return $this->redirect($this->generateUrl('BoomBackBundle_boom_index'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    private function createAjaxImageForm() {
        return $this->createForm($this->get('boom_library.ajax_image.type'), new Image());
    }

    public function searchBoomAjaxAction() {
        $request = $this->getRequest();
        $queryString = $request->query->get('q', '');
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        $results = $repo->findBoomsByLike($queryString);
        foreach ($results as &$result) {
            $result['image_path'] = $result['image_path'] === null ? '' : $this->get('boom_library.image.helper')->getBoomImageUrl($result['image_path'], 158, 90);
        }
        $response = new Response(json_encode($results));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
