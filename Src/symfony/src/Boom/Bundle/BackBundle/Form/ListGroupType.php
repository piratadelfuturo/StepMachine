<?php

namespace Boom\Bundle\BackBundle\Form;

use Boom\Bundle\BackBundle\Form\DataTransformer\ListGroupTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListGroupType extends AbstractType {


    /**
     * @var ObjectManager
     */
    private $om;

    /**
     *
     *  @param ObjectManager $om
     */

     /*
    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }

     */

     /*
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options) {


        //$builder->prependNormTransformer(new ListGroupTransformer());

        $builder->add(
                'list_elements',
                'collection',
                array(
                    'type' => 'boom_bundle_backbundle_listelementtype',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Boom\Bundle\LibraryBundle\Entity\ListGroup'
        ));
    }

    public function getName() {
        return 'boom_bundle_backbundle_listgrouptype';
    }

}
