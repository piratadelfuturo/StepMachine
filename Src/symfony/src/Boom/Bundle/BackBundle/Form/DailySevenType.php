<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DailySevenType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options) {

         $builder->add(
                'version',
                'hidden',
                array(
                    'label' => 'Nombre',
                    'required' => true
                    ));

        for($i = 1; $i<= 7;$i++){
            $builder->add('name_'.$i, 'text', array('label' => $i,'required' => false));
            //$builder->add('url_'.$i, 'text', array('label' => 'URL '.$i, 'required' => false));
        }

    }


    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null,
            'virtual'    => true
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_widgettype';
    }

}