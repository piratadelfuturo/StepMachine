<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImageType extends AbstractType {

    /* public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text');

    } */

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(
                array(
                    'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Image',
                    'required' => false,
                    'error_bubbling' => true,
                    'compound' => false,
                    'allow_add' => true
                )
        );
    }

    public function parent() {
        return 'field';
    }

    public function getName() {
        return 'boom_bundle_librarybundle_imagetype';
    }

}
