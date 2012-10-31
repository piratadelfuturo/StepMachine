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
                        'username',
                        'text'
                      )
                ->add(
                        'name',
                        'text'
                      )
                ->add(
                        'twitter_username',
                        'text'
                      )
                ->add(
                        'profile_image',
                        'file', array ('label' => 'Sube una imagen de 150X150 pixeles para que sea tu ávatar en 7Boom.')
                        )
                ->add(
                        'bio',
                        'textarea', array('label' => 'Bio'));
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
