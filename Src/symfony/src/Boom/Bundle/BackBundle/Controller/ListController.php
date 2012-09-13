<?php

namespace Boom\Bundle\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Boom\Bundle\BackBundle\Form\ListGroupType;
use Boom\Bundle\LibraryBundle\Entity\ListGroup;

class ListController extends Controller {

    public function newAction($block,$slug) {

        $entity = new ListGroup();
        $entity['block'] = $block;
        $entity['name'] = $entity['slug'] = $slug;

        $form = $this->createForm(new ListGroupType(), $entity);

        return $this->render(
                        'BoomBackBundle:List:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                        )
        );
    }

    public function createAction($block,$slug) {

        $entity = new ListGroup();
        $entity['block'] = $block;
        $entity['name'] = $entity['slug'] = $slug;
        $form = $this->createForm(new ListGroupType(), $entity);
        $request = $this->getRequest();
        $form->bind($request);
        $entity['block'] = $block;
        $entity['name'] = $entity['slug'] = $slug;

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect(
                            $this->generateUrl(
                                    'BoomBackBundle_list_edit', array(
                                'block' => $entity['block'],
                                'slug' => $entity['slug']
                                    )
                            )
            );
        }


        return $this->render(
                        'BoomBackBundle:Homepage:new.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                        )
        );
    }

    public function editAction($block,$slug) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:ListGroup');
        $entity = $repo->findOneBy(
                array(
                    'block' => $block,
                    'slug' => $slug
                )
        );
        if (!$entity) {
            return $this->redirect($this->generateUrl(
                                    'BoomBackBundle_list_new', array(
                                'block' => $block,
                                'slug' => $slug
                                    )
                    ));
        }

        $form = $this->createForm(new ListGroupType(), $entity);

        return $this->render(
                        'BoomBackBundle:List:edit.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                        )
        );
    }

    public function updateAction($block,$slug) {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('BoomLibraryBundle:ListGroup');
        $entity = $repo->findOneBy(
                array(
                    'block' => $block,
                    'slug' => $slug
                )
        );

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $newListElements = array();
        $originalListElements = array();

        foreach($entity['listelements'] as $listelement) $originalListElements[] = $listelement;


        $form = $this->createForm(new ListGroupType(), $entity);
        $request = $this->getRequest();
        $form->bind($request);

        if ($form->isValid()) {
            $newListElements = &$entity['listelements'];
            foreach ($newListElements as $nle) {
                foreach ($originalListElements as $key => $ole) {
                    if ($ole['id'] === $nle['id']) {
                        unset($originalListElements[$key]);
                    }
                }
            }
            foreach ($originalListElements as $ole) {
                $em->remove($ole);
            }
            foreach($newListElements as $element){
                $em->persist($element);
            }

            $em->persist($entity);
            $em->flush();
            /*return $this->redirect($this->generateUrl('BoomBackBundle_list_edit', array(

                'block' => $entity['block'],
                'slug' => $entity['slug']
                )
                            )
            );*/
        }


        return $this->render(
                        'BoomBackBundle:List:edit.html.php', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                        )
        );
    }

}