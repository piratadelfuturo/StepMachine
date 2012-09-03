<?php
namespace Boom\Bundle\LibraryBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Boom\Bundle\LibraryBundle\Entity\Tag;

/**
 * Description of TextToTagBoomTransformer
 *
 * @author daniel
 */
class TextToTagBoomTransformer implements DataTransformerInterface
{

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function reverseTransform($value) {

    }


    public function transform($value) {
        ;
    }

}