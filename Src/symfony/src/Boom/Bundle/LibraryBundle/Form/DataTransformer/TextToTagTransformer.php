<?php

namespace Boom\Bundle\LibraryBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Boom\Bundle\LibraryBundle\Entity\Tag;

/**
 * Description of TextToTagTransformer
 *
 * @author daniel
 */
class TextToTagTransformer implements DataTransformerInterface {

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
    public function reverseTransform($tags) {
        if (!$tags) {
            return array();
        }

        $tagEntities = array();

        $tagsLocation = array();

        $repo = $this->om->getRepository('BoomLibraryBundle:Tag');

        $tags = explode(',', $tags);
        foreach ($tags as &$tag) {
            $tag = trim($tag);
            $tag = preg_replace('!\s+!', ' ', $tag);
            $tag = mb_strtolower($tag, 'UTF-8');
            if (!empty($tag)) {
                $TagEntity = $repo->findOneBy(array('name' => $tag));
                if ($TagEntity === null) {
                    $tagsLocation[$tag] = new Tag($tag);
                    //$this->om->persist($tagsLocation[$tag]);
                    $tagEntities[$tag] = &$tagsLocation[$tag];
                } elseif (!isset($tagsLocation[$tag])) {
                    $tagEntities[$tag] = $TagEntity;
                }
            }
        }

        return $tagEntities;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($tags) {
        if (null === $tags) {
            return "";
        }

        $tagNames = array();

        foreach ($tags as $tag) {
            if ($tag instanceOf Tag) {
                $tagNames[] = $tag['name'];
            }
        }


        return implode(' ,', $tagNames);
    }

}