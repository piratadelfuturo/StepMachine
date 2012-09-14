<?php
namespace Boom\Bundle\BackBundle\Form;

use Boom\Bundle\BackBundle\Form\EventListener\BoomFeaturedSubscriber;
use Boom\Bundle\LibraryBundle\Form\BoomelementType;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoomType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        //$subscriber = new BoomFeaturedSubscriber($builder->getFormFactory());
        //$builder->addEventSubscriber($subscriber);

        $builder
                ->add('title')
                ->add('summary', null, array('required' => true))
                ->add('date_published', 'datetime', array(
                    'read_only' => false
                ));
       $builder->add(
                'status',
                'choice',
                array(
                    'required' => true,
                    'choices' => array(
                        Boom::STATUS_DRAFT      => 'Draft',
                        Boom::STATUS_REVIEW     => 'Revisión',
                        Boom::STATUS_PUBLIC     => 'Público',
                        Boom::STATUS_PRIVATE    => 'Privado',
                        Boom::STATUS_DELETE     => 'Eliminado',
                        Boom::STATUS_BLOCK      => 'Bloqueado',
                    )
                )
                );

               $builder->add(
                'category', 'entity', array(
            'class' => 'Boom\Bundle\LibraryBundle\Entity\Category',
            'property' => 'name',
            'multiple' => false,
            'required' => true
                )
        );

        $builder->add(
                'nsfw', 'checkbox', array(
            'required' => false
                )
        );

        $builder->add(
                'image', 'hidden');

        $builder->add(
                'tags', 'tags_selector', array()
        );


        $builder->add(
                'elements', 'collection', array(
            'type' => new BoomelementType(),
            'allow_add' => false,
            'allow_delete' => false
                )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\Boom'
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_boomtype';
    }

}
