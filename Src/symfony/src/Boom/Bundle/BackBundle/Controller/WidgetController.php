<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boom\Bundle\LibraryBundle\Entity\Widget;
use Boom\Bundle\LibraryBundle\Entity\User;
use Boom\Bundle\BackBundle\Form\WidgetType;
use Boom\Bundle\BackBundle\Form\DailySevenType;

class WidgetController extends Controller {


    public function dailySevenAction(){



        $form = $this->createForm(new DailySevenType());
        $request = $this->getRequest();
        $form->bind($request);

        return $this->render('BoomBackBundle:Widget:dailySeven.html.php', array(
                    'form' => $form->createView(),
                ));


    }

    /**
     * Lists all Boom entities.
     *
     */
    public function indexAction(Request $request) {

        if ($request->getRequestFormat() == 'html') {
            return $this->render('BoomBackBundle:Widget:index.html.php');
        }

        $get = $request->query->all();

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $columns = array(
            'id',
            'name',
            'block',
            'position',
            'id action_id'
        );
        $get['columns'] = $columns;

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository('BoomLibraryBundle:Widget');
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
     * Finds and displays a Widget entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:Widget')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoomBackBundle:Widget:show.html.php', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Widget entity.
     *
     */
    public function newAction() {

        $entity = new Widget();
        $form = $this->createForm(new WidgetType(), $entity);

        return $this->render('BoomBackBundle:Widget:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Creates a new Boom entity.
     *
     */
    public function createAction() {
        $form = $this->createForm(new WidgetType());
        $request = $this->getRequest();
        $form->bind($request);
        $entity = $form->getData();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                            $this->generateUrl(
                                    'BoomBackBundle_widget_edit', array(
                                'id' => $entity->getId()
                                    )
                            )
            );
        }


        return $this->render('BoomBackBundle:Widget:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Displays a form to edit an existing Widget entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('BoomLibraryBundle:Widget');
        $entity = $repo->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }

        $editForm = $this->createForm(new WidgetType(), $entity);

        return $this->render('BoomBackBundle:Widget:edit.html.php', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                ));
    }

    /**
     * Edits an existing Boom entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BoomLibraryBundle:Widget')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Widget entity.');
        }

        $editForm = $this->createForm(new BoomType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('BoomBackBundle_widget_edit', array('id' => $id)));
        }

        return $this->render('BoomBackBundle:Widget:edit.html.php', array(
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
            $entity = $em->getRepository('BoomLibraryBundle:Widget')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Widget entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('BoomBackBundle_widget_index'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}