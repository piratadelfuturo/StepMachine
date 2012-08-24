<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\BackBundle\Form\EventListener\ImageFileSubscriber;

class ImageFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title')
                ->add('description')
                ->add('nsfw',null,array('required' => false));

        $subscriber = new ImageFileSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(
                array(
                    'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Image'
                )
        );
    }

    public function parent() {
        return 'field';
    }

    public function getName() {
        return 'boom_bundle_backbundle_imagetype';
    }

}