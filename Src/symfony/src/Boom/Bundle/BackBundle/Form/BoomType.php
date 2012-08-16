<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoomType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('title')
                ->add('summary')
                ->add('date_published',null,array(
                    'read_only' => false,
                    'attr' => array(
                        'style' => 'display:none;'
                    )
                ));

        $builder->add(
                'categories', 'entity', array(
            'class' => 'Boom\Bundle\LibraryBundle\Entity\Category',
            'property' => 'name',
            'multiple' => true,
            'required' => true,
            'expanded' => true
                )
        );
        $builder->add(
                'nsfw', 'checkbox', array(
            'required' => false
                )
        );
        $builder->add(
                'image', 'hidden');

        $builder->add(
                'tags', 'collection', array(
            'type' => 'text',
            'allow_add' => true,
            'allow_delete' => true)
        );

        $builder->add(
                'elements', 'collection', array(
            'type' => new BoomelementType(),
            'allow_add' => true,
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
        return 'boom_bundle_backbundle_boomtype';
    }

}
