<?php

namespace Boom\Bundle\FrontBundle\Form;

use Boom\Bundle\LibraryBundle\Form\BoomelementType;
use Boom\Bundle\FrontBundle\Form\EventListener\BoomStatusSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoomType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $subscriber = new BoomStatusSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);

        $builder
                ->add('title', 'text', array('required' => true))
                ->add('summary', 'textarea', array('required' => true));

        $builder->add(
                'category', 'entity', array(
            'class' => 'Boom\Bundle\LibraryBundle\Entity\Category',
            'property' => 'name',
            'multiple' => false,
            'required' => true
                )
        );

        $builder->add(
                'nsfw', 'checkbox', array(
            'required' => false
                )
        );

        $builder->add(
                'image',
                'ajax_image',
                array('required' => true)
                );

        $builder->add(
                'tags', 'tags_selector', array()
        );


        $builder->add(
                'elements', 'collection', array(
            'type' => new BoomelementType(),
            'allow_add' => false,
            'allow_delete' => false
                )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Boom'
        ));
    }

    public function getName() {
        return 'front_boom';
    }

}
