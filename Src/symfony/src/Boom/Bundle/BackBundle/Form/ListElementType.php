<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\BackBundle\Form\DataTransformer\ListElementImageTransformer;
use Boom\Bundle\BackBundle\Form\DataTransformer\ListElementBoomTransformer;
use Boom\Bundle\BackBundle\Form\DataTransformer\ListElementCategoryTransformer;
use Doctrine\Common\Persistence\ObjectManager;

class ListElementType extends AbstractType {

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('position', 'hidden', array('required' => true))
                ->add('title', 'text', array('required' => true))
                ->add('summary', 'text', array('required' => false))
                ->add('url', 'text', array('required' => true))
                ->add(
                        $builder->create('image', 'hidden', array('required' => false))
                        ->prependNormTransformer(new ListElementImageTransformer($this->om))
                )
                ->add(
                        $builder->create('boom', 'hidden', array('required' => false))
                        ->prependNormTransformer(new ListElementBoomTransformer($this->om))
                )
                ->add(
                        $builder->create('category', 'hidden', array('required' => false))
                        ->prependNormTransformer(new ListElementCategoryTransformer($this->om))
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\ListElement',
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_listelementtype';
    }

}
