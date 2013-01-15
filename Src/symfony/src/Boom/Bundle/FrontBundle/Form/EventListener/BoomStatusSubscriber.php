<?php

namespace Boom\Bundle\FrontBundle\Form\EventListener;

use Boom\Bundle\BackBundle\Form\DataTransformer\BoomFeaturedTransformer;
use Boom\Bundle\LibraryBundle\Entity\Boom;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

/**
 * Description of BoomStatusSubscriber
 *
 * @author daniel
 */
class BoomStatusSubscriber implements EventSubscriberInterface {

    //put your code here
    private $factory;

    public function __construct(FormFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents() {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(DataEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        $choices = array();
        $choices[Boom::STATUS_DRAFT] = 'Draft';
        $choices[Boom::STATUS_PRIVATE] = 'Público';

        if(null !== $data && $data['status'] == Boom::STATUS_DRAFT){
        $named = $this->factory->createNamedBuilder(
                'status',
                'choice',
                null,
                array(
            'choices' => $choices
                )
        );
        $form->add($named->getForm());
        }
    }

}