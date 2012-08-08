<?php
namespace Boom\Bundle\LibraryBundle\Decoda\Filter;

//use Decoda\DecodaFilter;
/**
 * QuoteFilter
 *
 * Provides the tag for quoting users and blocks of texts.
 *
 * @author      Miles Johnson - http://milesj.me
 * @copyright   Copyright 2006-2011, Miles Johnson, Inc.
 * @license     http://opensource.org/licenses/mit-license.php - Licensed under The MIT License
 * @link        http://milesj.me/code/php/decoda
 */

class MagicFilter extends \DecodaFilter {

	/**
	 * Supported tags.
	 *
	 * @access protected
	 * @var array
	 */
	protected $_tags = array(
		'magic' => array(
			'template' => 'magic',
			'type' => self::TYPE_BLOCK,
			'allowed' => self::TYPE_BOTH,
			'attributes' => array(
				'default' => '/.*?/',
				'date' => '/.*?/'
			),
			'map' => array(
				'default' => 'author'
			),
			'maxChildDepth' => 2
		)
	);

}