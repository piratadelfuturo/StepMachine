<?php

namespace Boom\Bundle\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\BackBundle\Form\EventListener\AddBoomelementIdSubscriber;

class BoomelementType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //$subscriber = new AddBoomelementIdSubscriber($builder->getFormFactory());
        //$builder->addEventSubscriber($subscriber);

        $builder
                ->add('title')
                ->add('content')
                ->add(
                        'image', 'ajax_image', array(
                    'required' => false,
                    'data_class' => null
                        )
                )
                ->add('position', 'hidden');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Boomelement'
        ));
    }

    public function getName() {
        return 'boom_bundle_librarybundle_boomelementtype';
    }

}
