<?php

namespace Boom\Bundle\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add(
                        'firstname',
                        'text'
                        )
                ->add(
                        'lastname',
                        'text'
                        )
                ->add(
                        'name',
                        'text'
                        )
                ->add(
                        'nickname',
                        'text'
                        )
                ->add(
                        'bio',
                        'textarea', array('label' => 'Bio'))
                ->add(
                        'profile_image',
                        'file'
                        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\User'
        ));
    }

    public function getName() {
        return 'front_user';
    }

}