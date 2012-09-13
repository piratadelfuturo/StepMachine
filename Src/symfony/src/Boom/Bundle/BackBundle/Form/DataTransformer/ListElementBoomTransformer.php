<?php

namespace Boom\Bundle\BackBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of ListElementTransformer
 *
 * @author daniel
 */
class ListElementBoomTransformer extends AbstractListElementEntityTransformer {

    public function __construct(ObjectManager $om) {
        parent::__construct($om);
        $this->entityName = 'Boom';
    }

}