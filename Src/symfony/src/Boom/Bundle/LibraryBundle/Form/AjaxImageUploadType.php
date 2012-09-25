<?php

namespace Boom\Bundle\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\LibraryBundle\Form\DataTransformer\ImageTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Boom\Bundle\LibraryBundle\Templating\Helper\ImageHelper;

class AjaxImageUploadType extends AbstractType {

    /**
     * @var ObjectManager
     */
    protected $om;
    protected $image_helper;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, ImageHelper $image_helper) {
        $this->om = $om;
        $this->image_helper = $image_helper;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $transformer = new ImageTransformer($this->om,$this->image_helper);
        $builder->prependNormTransformer($transformer);
        $builder->add('file', 'file', array('attr' => array(
                'multiple' => 'multiple',
                'class' => 'ajax-image-uploader'
                )));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(
                array(
                    'csrf_protection' => false,
                    'required' => false
                )
        );
    }

    public function getName() {
        return 'ajax_image_upload';
    }

}