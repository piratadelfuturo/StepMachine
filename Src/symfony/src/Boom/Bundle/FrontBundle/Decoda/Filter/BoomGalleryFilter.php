<?php

namespace Boom\Bundle\FrontBundle\Decoda\Filter;

class BoomGalleryFilter extends \DecodaFilter {

    protected $boom_front_helper;

    public function __construct(\Boom\Bundle\FrontBundle\Templating\Helper\MainHelper $boom_front_helper){
        $this->boom_front_helper = $boom_front_helper;
    }
    /**
     * Supported tags.
     *
     * @access protected
     * @var array
     */
    protected $_tags = array(
        'gallery' => array(
            'template' => 'boom_inline_gallery',
            'type' => self::TYPE_BLOCK,
            'allowed' => self::TYPE_NONE,
            'pattern' => '/[a-z0-9]+/i',
            'attributes' => array(
                'default' => '/[a-z0-9]+/i',
            ),
            'map' => array(
                'default' => 'gallery_id'
            ),
            'maxChildDepth' => -1,
            'preserveTags' => true
        )
    );

    public function parse(array $tag, $content) {
        return $this->boom_front_helper->getGallery($tag);
        //$parsed = parent::parse($tag, $content);
        //return $parsed;
    }

}