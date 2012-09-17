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
class FeaturedBoomType extends AbstractType{


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'required' => true,
            'expanded' => true,
            'choices' => array(
                0 => 'No',
                1 => 'Si',
                3 => 'Último'
            ),
        ));
    }

    public function getParent(){
        return 'choice';
    }

    public function getName(){

        return 'widget_block';
    }

}