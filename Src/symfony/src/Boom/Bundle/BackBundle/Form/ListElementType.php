<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('position','hidden')
            ->add('title','text',array('required' => true))
            ->add('summary','text',array('required' => true))
            ->add('url','text',array('required' => true))
            ->add('image','text',array('required' => false))
            ->add('boom','hidden',array('required' => false))
            ->add('category','hidden',array('required' => false));

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
