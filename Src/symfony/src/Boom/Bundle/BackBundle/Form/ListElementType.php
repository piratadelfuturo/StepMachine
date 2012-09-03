<?php

namespace Boom\Bundle\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\BackBundle\Form\EventListener\AddBoomelementIdSubscriber;

class BoomelementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('position','hidden')
            ->add('title')
            ->add('summary')
            ->add('url')
            ->add('image','hidden')
            ->add('boom','hidden')
            ->add('category','hidden')
            ->add('position','hidden');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\ListElement'
        ));
    }

    public function getName()
    {
        return 'boom_bundle_backbundle_listelementtype';
    }
}
