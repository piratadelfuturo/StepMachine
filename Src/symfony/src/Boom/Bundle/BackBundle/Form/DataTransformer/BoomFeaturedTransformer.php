<?php

namespace Boom\Bundle\BackBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Description of ListElementTransformer
 *
 * @author daniel
 */
class BoomFeaturedTransformer implements DataTransformerInterface {

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($data) {

        if($data == 2){
            $data = new \DateTime();
        }elseif($data !== 2 || $data !== 0){
            $data = new \DateTime($data);
        }else{
           $data = null;
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
        if($data == null){
            $data = 0;
        }elseif($data instanceOf \DateTime){
            $data = $data->format('Y-m-d H:i:s');
        }

        return $data;
    }

}
