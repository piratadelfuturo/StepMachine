<?php
namespace Boom\Bundle\BackBundle\Form;

use Boom\Bundle\BackBundle\Form\ListGroupType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListBlockType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add(
                'list_groups', 'collection', array(
            'type' => new ListGroupType(),
                    'allow_add' => true,
                    'allow_delete'  => true
                )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'virtual' => false,
            'by_reference' => false
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_listblocktype';
    }

}
