<?php

namespace Boom\Bundle\BackBundle\Form\EventListener;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

/**
 * Description of AddBoomelementIdSubscriber
 *
 * @author daniel
 */
class ImageFileSubscriber implements EventSubscriberInterface {

    //put your code here

    private $factory;

    public function __construct(FormFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents() {
        // Tells the dispatcher that we want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(DataEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        $putFile = false;
        if ($data === null) {
            $putFile = true;
        }elseif($data->getId() === null){
            $putFile = true;
        }
        if($putFile){
            $form->add($this->factory->createNamed('file', 'file'));
        }
    }

}