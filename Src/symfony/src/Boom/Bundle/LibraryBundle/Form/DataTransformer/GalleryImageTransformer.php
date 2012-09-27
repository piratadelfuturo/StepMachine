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
class GalleryImageTransformer implements DataTransformerInterface {

    /**
     * @var ObjectManager
     */
    protected $om;

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
