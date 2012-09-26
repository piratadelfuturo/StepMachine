<?php

namespace Boom\Bundle\LibraryBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of ListElementTransformer
 *
 * @author daniel
 */
class HiddenCategoryTransformer extends AbstractHiddenEntityTransformer {

    public function __construct(ObjectManager $om) {
        parent::__construct($om);
        $this->entityName = 'Category';
    }

}