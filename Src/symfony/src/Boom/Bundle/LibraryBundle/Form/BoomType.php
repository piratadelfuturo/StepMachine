<?php

namespace Boom\Bundle\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoomType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('slug')
                ->add('title')
                ->add('summary')
                ->add('date_created')
                ->add('date_published');
        $builder->add(
                'nsfw', null, array(
            'required' => false
                )
        );
        $builder->add(
                'image', 'file', array(
            'required' => false
        ));
        $builder->add(
                'elements',
                'collection',
                array(
                    'type' => new BoomelementType()
                    )
                );

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Boom'
        ));
    }

    public function getName() {
        return 'boom_bundle_librarybundle_boomtype';
    }

}
