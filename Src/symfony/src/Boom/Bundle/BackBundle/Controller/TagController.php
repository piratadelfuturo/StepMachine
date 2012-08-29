<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Image;
use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\LibraryBundle\Form\ImageFormType;

class GalleryController extends Controller {

    /**
     * Lists all Boom entities.
     *
     */
    public function indexAction(Request $request) {

        if ($request->getRequestFormat() == 'html') {
            return $this->render('BoomBackBundle:Tag:index.html.php');
        }

        $get = $request->query->all();
        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Tag');

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $standardColumn = array(
            'id',
            'slug',
            'name',
            'position',
            'featured'
        );

        $columns = $standardColumn;

        /**
          $columns[] = array(

          'main_booms' => array(
          'id main_boom_total' => 'COUNT(%s)'
          )
          );
         */
        $columns[] = array(
            'booms' => array(
                'id boom_total' => 'COUNT(%s)'
            )
        );

        $columns[] = 'id action_id';

        $get['columns'] = $columns;
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

        $entity = $em->getRepository('BoomLibraryBundle:Tag')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tag.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Tag:show.html.php', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Tag entity.
     *
     */
    public function newAction() {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:Tag');
        $entity = new BoomEntity\Tag();
        $form = $this->createForm(new TagType($repo->getCount()), $entity);

        return $this->render('BoomBackBundle:Tag:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Creates a new Tag entity.
     *
     */
    public function createAction() {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:Tag');
        $form = $this->createForm(new TagType($repo->getCount()));
        $request = $this->getRequest();
        $form->bind($request);
        $entity = $form->getData();
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('cache.apc')->delete('boom_tag_featured');
            return $this->redirect(
                            $this->generateUrl('BoomBackBundle_tag_index')
            );
        }


        return $this->render('BoomBackBundle:Tag:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Displays a form to edit an existing Tag entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:Tag');
        $entity = $repo->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boom entity.');
        }

        $editForm = $this->createForm(new TagType($repo->getCount()), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Tag:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Edits an existing Tag entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:Tag');
        $entity = $repo->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tag.');
        }

        $editForm = $this->createForm(new TagType($repo->getCount()), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('cache.apc')->delete('boom_tag_featured');
            return $this->redirect($this->generateUrl('BoomBackBundle_tag_index'));
        }

        return $this->render('BoomBackBundle:Tag:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a Tag entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BoomLibraryBundle:Tag')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tag entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('BoomLibraryBundle_tag_index'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}