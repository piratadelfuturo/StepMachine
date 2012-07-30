<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Form\BoomType;
use Boom\Bundle\LibraryBundle\Form\BoomelementType;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Boom\Bundle\LibraryBundle\Entity\Boomelement;


class BoomController extends Controller {

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
            array(
                'user' => array(
                    'username'
                )
            ),
            'title',
            'date_created',
            'nsfw',
            'id actionId'
        );
        $get['columns'] = $columns;

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Boom');
        $query = $repo->ajaxTable($get, true);
        $rResult = $query->getArrayResult();

        /* Data set length after filtering */
        $iFilteredTotal = count($rResult);


        if (!empty($rResult)) {
            $columnNames = array_keys(current($rResult));
        }

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval(isset($get['sEcho']) ? $get['sEcho'] : NULL),
            "iTotalRecords" => $repo->getCount(),
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
        $entity = new Boom();

        for($i=1;$i<=7;$i++){
            $element = new Boomelement();
            $element->setPosition($i);
            $entity->addElement($element);
        }

        $form = $this->createForm(new BoomType(), $entity);
        return $this->render('BoomBackBundle:Boom:new.html.php', array(
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
        $request = $this->getRequest();
        $form = $this->createForm(new BoomType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boom_show', array('id' => $entity->getId())));
        }

        return $this->render('BoomBackBundle:Boom:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
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

        $editForm = $this->createForm(new BoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Boom:edit.html.php', array(
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

        return $this->render('BoomBackBundle:Boom:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
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

        return $this->redirect($this->generateUrl('boom'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}