<?php

namespace Boom\Bundle\BackBundle\Form\EventListener;

use Boom\Bundle\BackBundle\Form\DataTransformer\BoomFeaturedTransformer;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

/**
 * Description of BoomTagsSubscriber
 *
 * @author daniel
 */
class BoomFeaturedSubscriber implements EventSubscriberInterface {

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
        $choices[0] = 'No';

        if (null !== $data) {
            if ($data['featured'] instanceOf \DateTime) {
                $choices[$data['featured']->format('Y-m-d H:i:s')] = $data['featured']->format('Y-m-d H:i:s');
            } elseif (!empty($data['featured'])) {
                $choices[$data['featured']] = $data['featured'];
            }
        }
        $choices[2] = 'Ahora';

        $named = $this->factory->createNamedBuilder(
                'featured',
                'choice',
                null,
                array(
            'choices' => $choices
                )
        );
        $named->addModelTransformer(new BoomFeaturedTransformer());
        $form->add($named->getForm());
    }

}