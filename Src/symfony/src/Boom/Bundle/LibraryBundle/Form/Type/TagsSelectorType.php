<?php

namespace Boom\Bundle\LibraryBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Boom\Bundle\LibraryBundle\Form\DataTransformer\TextToTagTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagsSelectorType extends AbstractType {

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
        $transformer = new TextToTagTransformer($this->om);
        $builder->prependNormTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'invalid_message' => 'The selected issue does not exist',
            'required' => false
        ));
    }

    public function getParent() {
        return 'text';
    }

    public function getName() {
        return 'tags_selector';
    }

}