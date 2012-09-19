<?php

namespace Boom\Bundle\LibraryBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Description of ListElementTransformer
 *
 * @author daniel
 */
class ImageTransformer implements DataTransformerInterface {


    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }


    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($data) {

        $newData = null;

        if($data['id'] !== null){
            $repo = $this->om->getRepository('BoomLibraryBundle:Image');
            $newData = $repo->findOneById($data['id']);
        }

        return $newData;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($data) {

        $newData = array('id'=>null,'file'=>null);

        if($data !== null){
            $newData['id'] = $data['id'];
        }

        return $newData;
    }

}
