<?php
namespace Boom\Bundle\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
/**
 * Description of WidgetBlockType
 *
 * @author daniel
 */
class WidgetBlockType extends AbstractType{

    protected $blockChoices;

    public function __construct(array $blockChoices){
        $this->blockChoices = $blockChoices;

    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'choices' => $this->blockChoices,
        );
    }

    public function getParent(){
        return 'choice';
    }

    public function getName(){

        return 'widget_block';
    }

}