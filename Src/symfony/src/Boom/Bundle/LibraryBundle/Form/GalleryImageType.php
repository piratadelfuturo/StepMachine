<?php

namespace Boom\Bundle\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Boom\Bundle\LibraryBundle\Form\DataTransformer\HiddenImageTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Boom\Bundle\LibraryBundle\Templating\Helper\ImageHelper;

class GalleryImageType extends AbstractType {

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
        $hiddenId = $builder->create('image','hidden',array());
        $hiddenId->prependNormTransformer(new HiddenImageTransformer($this->om));
        $builder->add($hiddenId);
        $builder->add('position','hidden');
        //$builder->prependNormTransformer(new GalleryImageTransformer($this->om));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(
                array(
                    'data_class' => 'Boom\Bundle\LibraryBundle\Entity\GalleryImageRelation'
                )
        );
    }

    public function getName() {
        return 'gallery_image';
    }

}