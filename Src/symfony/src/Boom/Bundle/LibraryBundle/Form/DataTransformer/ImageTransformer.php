<?php

namespace Boom\Bundle\LibraryBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Boom\Bundle\LibraryBundle\Templating\Helper\ImageHelper;

/**
 * Description of ListElementTransformer
 *
 * @author daniel
 */
class ImageTransformer implements DataTransformerInterface {

    /**
     * @var ObjectManager
     */
    protected $om;
    protected $image_helper;

    public function __construct(ObjectManager $om, ImageHelper $image_helper) {
        $this->om = $om;
        $this->image_helper = $image_helper;
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

        if ($data !== null && $data['id'] !== null) {
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

        $newData = array(
            'id' => null,
            'file' => null,
            'path' => null
        );

        if ($data !== null) {
            try {
                $newData['id'] = $data['id'];
                $newData['path'] = $data['path'];
            } catch (\Exception $e) {

            }
        }

        return $newData;
    }

}
