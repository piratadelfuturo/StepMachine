<?php
namespace Boom\Bundle\FrontBundle\Decoda\Filter;

class BoomVideoFilter extends \DecodaFilter {

	/**
	 * Supported tags.
	 *
	 * @access protected
	 * @var array
	 */
	protected $_tags = array(
		'youtube' => array(
			'tag' => 'iframe',
			'template' => 'youtube',
			'type' => self::TYPE_BLOCK,
			'allowed' => self::TYPE_NONE,
                        'pattern' => '/[a-z0-9]+/i',
			'attributes' => array(
				'default' => '/[a-z0-9]+/i',
			),
			'map' => array(
				'default' => 'video_id'
			),
			'maxChildDepth' => -1,
                        'preserveTags' => true
		),
		'vimeo' => array(
			'tag' => 'iframe',
			'template' => 'vimeo',
			'type' => self::TYPE_BLOCK,
			'allowed' => self::TYPE_NONE,
                        'pattern' => '/[a-z0-9]+/i',
			'attributes' => array(
				'default' => '/[a-z0-9]+/i',
			),
                        'map' => array(
                                'default' => 'video_id'
                        ),
			'maxChildDepth' => -1,
                        'preserveTags' => true
		)
	);

        	public function parse(array $tag, $content) {
                    $parsed = parent::parse($tag, $content);
                    return $parsed;
                }

}