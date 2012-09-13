<?php

namespace Boom\Bundle\BackBundle\Form\EventListener;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

/**
 * Description of BoomTagsSubscriber
 *
 * @author daniel
 */
class ListElementSubscriber implements EventSubscriberInterface {

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

        if (isset($data['id'])) {
            $form->add($this->factory->createNamed('id', 'hidden',array('required' => 'true')));
        }
    }

}