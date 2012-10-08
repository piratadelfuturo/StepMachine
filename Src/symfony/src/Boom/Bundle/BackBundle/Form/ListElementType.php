<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\LibraryBundle\Form\DataTransformer\HiddenImageTransformer;
use Boom\Bundle\LibraryBundle\Form\DataTransformer\HiddenBoomTransformer;
use Boom\Bundle\LibraryBundle\Form\DataTransformer\HiddenCategoryTransformer;
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
                ->add('title', 'text', array('required' => false,'label' => 'Título'))
                ->add('summary', 'text', array('required' => false,'label' => 'Sumario'))
                ->add('url', 'text', array('required' => false,'label' => 'URL'));
        $ajax_image =   $builder->create('image', 'ajax_image', array('required' => false,'label' => 'Imagen'));

        $builder->add($ajax_image)
                ->add(
                        $builder->create('boom', 'hidden', array('required' => false))
                        ->prependNormTransformer(new HiddenBoomTransformer($this->om))
                )
                ->add(
                        $builder->create('category', 'hidden', array('required' => false))
                        ->prependNormTransformer(new HiddenCategoryTransformer($this->om))
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\ListElement'
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_listelementtype';
    }

}
