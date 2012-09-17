<?php

namespace Boom\Bundle\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of WidgetBlockType
 *
 * @author daniel
 */
class WidgetBlockType extends AbstractType {

    protected $blockChoices;

    public function __construct(array $blockChoices) {
        $this->blockChoices = $blockChoices;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'choices' => $this->blockChoices,
        ));
    }

    public function getParent() {
        return 'choice';
    }

    public function getName() {

        return 'widget_block';
    }

}