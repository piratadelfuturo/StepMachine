<?php

namespace Boom\Bundle\FrontBundle\Decoda\Filter;

class BoomVideoFilter extends \DecodaFilter {

    const IMAGE_PATTERN = '/^(?:https?:\/\/)?(.*?)\.(jpg|jpeg|png|gif|bmp)$/is';

    /**
     * Supported tags.
     *
     * @access protected
     * @var array
     */
    protected $_tags = array(
        'boom_image' => array(
            'tag' => 'img',
            'template' => 'boom_image',
            'type' => self::TYPE_INLINE,
            'allowed' => self::TYPE_NONE,
            'pattern' => self::IMAGE_PATTERN,
            'attributes' => array(
                'default' => '/[a-z0-9]+/i',
            ),
            'map' => array(
                'default' => 'image_path'
            ),
            'maxChildDepth' => -1,
            'preserveTags' => true
        )
    );

    /**
     * Use the content as the image source.
     *
     * @access public
     * @param array $tag
     * @param string $content
     * @return string
     */
    public function parse(array $tag, $content) {
        // If more than 1 http:// is found in the string, possible XSS attack
        if (substr_count($content, 'http://') > 1) {
            return;
        }

        $tag['attributes']['src'] = $content;

        if (empty($tag['attributes']['alt'])) {
            $tag['attributes']['alt'] = '';
        }

        return parent::parse($tag, $content);
    }

}