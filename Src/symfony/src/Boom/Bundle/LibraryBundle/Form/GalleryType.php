<?php
namespace Boom\Bundle\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $hiddenImageCollection = $builder->create(
                'galleryimagerelations', 'collection', array(
            'type' => 'gallery_image',
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => true
        ));

        $builder->add($hiddenImageCollection);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(
                array(
                    'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Gallery'
                )
        );
    }

    public function getName() {
        return 'boom_gallery';
    }

}