<?php

namespace Boom\Bundle\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\BackBundle\Form\EventListener\ImageFileSubscriber;

class AjaxGalleryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
                'images', 'collection', array(
            'type' => 'ajax_image',
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(
                array(
                    'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Gallery'
                )
        );
    }

    public function parent() {
        return 'field';
    }

    public function getName() {
        return 'ajax_gallery';
    }

}