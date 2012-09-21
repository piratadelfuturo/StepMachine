<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DailySevenType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add(
                'name', 'text', array(
            'label' => 'Nombre',
            'required' => true
        ));
        $builder->add(
                'list', 'collection', array(
            'type' => new DailySevenLineType(),
            'data_class' => null,
            'allow_add' => false,
            'allow_delete' => false
                )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_dailyseventype';
    }

}

class DailySevenLineType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('line_1', 'text');
        $builder->add('line_2', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_dailysevenlinetype';
    }

}
