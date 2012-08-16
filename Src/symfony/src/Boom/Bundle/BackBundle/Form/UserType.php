<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('bio')
                ->add(
                        'groups',
                        null,
                        array(
                            'expanded' => true
                            )
                        )
                ->add(
                        'admin',
                        'checkbox',
                        array(
                            'required' => false
                        )
                        );

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\User'
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_usertype';
    }

}