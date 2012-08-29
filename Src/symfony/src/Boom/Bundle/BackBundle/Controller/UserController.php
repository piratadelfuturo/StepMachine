<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity as BoomEntity;
use Boom\Bundle\BackBundle\Form\UserType;


class UserController extends Controller {

    /**
     * Lists all Boom entities.
     *
     */
    public function indexAction(Request $request) {
        if ($request->getRequestFormat() == 'html' && !$request->isXmlHttpRequest()) {
            return $this->render('BoomBackBundle:User:index.html.php');
        }

        $get = $request->query->all();

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $columns = array(
            'id',
            'username',
            'firstname',
            'lastname',
            'facebookId',
            'twitterId',
            array(
                'booms' => array(
                    'id boom_total' => 'COUNT(%s)'
                ),
                'images' => array(
                    'id image_total' => 'COUNT(%s)'
                ),
                'galleries' => array(
                    'id gallery_total' => 'COUNT(%s)'
                ),
            ),
            'id action_id'
        );
        $get['columns'] = $columns;

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:User');
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
            "iTotalDisplayRecords" => (int) $iFilteredTotal,
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
        $entity = $em->getRepository('BoomLibraryBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Category:show.html.php', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Category entity.
     *
     */
    public function newAction() {

        $entity = new BoomEntity\Category();
        $form = $this->createForm(new CategoryType(), $entity);


        return $this->render('BoomBackBundle:Category:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Creates a new Category entity.
     *
     */
    public function createAction() {
        $form = $this->createForm(new CategoryType());
        $request = $this->getRequest();
        $form->bind($request);
        $entity = $form->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                            $this->generateUrl(
                                    'BoomBackBundle_category_show', array(
                                'id' => $entity->getId()
                                    )
                            )
            );
        }


        return $this->render('BoomBackBundle:Category:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('BoomLibraryBundle:User');
        $entity = $repo->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);

        return $this->render('BoomBackBundle:User:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView()
                ));
    }

    /**
     * Edits an existing Category entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User.');
        }


        $editForm = $this->createForm(new UserType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                    $this->generateUrl(
                            'BoomBackBundle_user_edit',
                            array(
                                'id' => $id
                            )
                            )
                    );
        }

        return $this->render('BoomBackBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView()
                ));
    }

    /**
     * Deletes a Category entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoomLibraryBundle:Category')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Category entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('BoomLibraryBundle_category_index'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}