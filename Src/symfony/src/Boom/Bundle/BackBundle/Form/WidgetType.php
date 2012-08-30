<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WidgetType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('name', null, array('label' => 'Nombre'))
                ->add('content', null, array(
                    'required' => false,
                    'label' => 'Contenido'))
                ->add('block', 'widget_block', array('label' => 'Bloque'))
                ->add('position', 'choice', array(
                    'label' => 'Posición',
                    'expanded' => false,
                    'choices' => range(1, 25),
                    'attr' => array(
                        'rows' => 100
                    )
                        )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Widget'
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_widgettype';
    }

}