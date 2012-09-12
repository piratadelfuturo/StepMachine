<?php

namespace Boom\Bundle\BackBundle\Form;

use Boom\Bundle\BackBundle\Form\ListElementType;
use Boom\Bundle\LibraryBundle\Entity\ListGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListGroupType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add(
                'list_elements', 'collection', array(
            'type' => new ListElementType(),
            'allow_add' => true,
            'allow_delete' => true,
                    'by_reference' => false
                )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\ListGroup'
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_listgrouptype';
    }

}
