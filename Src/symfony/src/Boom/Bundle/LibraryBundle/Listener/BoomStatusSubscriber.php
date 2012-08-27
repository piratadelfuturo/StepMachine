<?php

namespace Boom\Bundle\LibraryBundle\Listener;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Boom\Bundle\LibraryBundle\Entity\Boom;

class BoomStatusSubscriber implements EventSubscriberInterface {

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

        $form->add(
                $this->factory->createNamed(
                        'status', 'choice', $data['status'], array(
                    'required' => true,
                    'choices' => array(
                        Boom::STATUS_DRAFT => 'Draft',
                        Boom::STATUS_REVIEW => 'Revisión',
                        Boom::STATUS_PUBLIC => 'Público',
                        Boom::STATUS_PRIVATE => 'Privado',
                        Boom::STATUS_DELETE => 'Eliminado'
                    )
                        )
                )
        );
    }

}