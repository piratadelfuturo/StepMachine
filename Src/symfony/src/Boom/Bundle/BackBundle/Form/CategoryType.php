<?php

namespace Boom\Bundle\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType {

    protected $categoryCount;

    public function __construct($categoryCount){
        $this->categoryCount = (int) $categoryCount;
    }


    public function buildForm(FormBuilderInterface $builder, array $options) {

        $positionOptions = array('required'  => true);

        $range = array();

        for($i=1;$i<=$this->categoryCount+1;$i++){
            $range[$i] = $i;
        }

        if(isset($options['data']) && $options['data']['id'] !== null){
            array_pop($range);
            $positionOptions['choices'] = $range;
        }else{
            $positionOptions['choices'] = array_reverse($range,true);
        }

        $builder
                ->add('name','text')
                ->add('position','choice',$positionOptions)
                ->add('featured','checkbox',array('required' => false));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Category'
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_categorytype';
    }

}
