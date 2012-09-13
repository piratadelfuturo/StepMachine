<?php

namespace Boom\Bundle\BackBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Boom\Bundle\LibraryBundle\Entity\Boom;

/**
 * Description of ListElementTransformer
 *
 * @author daniel
 */
abstract class AbstractListElementEntityTransformer implements DataTransformerInterface {

    protected $entityName;

    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om) {
        $this->om = $om;
        $this->entityName = null;
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($data) {
        if( $data !== null && !empty($data) ){
            $repo = $this->om->getRepository('BoomLibraryBundle:'.$this->entityName);
            $data = $repo->findOneBy(array('id' => (int) $data));
        }

        return $data;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($data) {
        if ( null !== $data ) {
            $data = $data['id'];
        }

        return $data;
    }

}