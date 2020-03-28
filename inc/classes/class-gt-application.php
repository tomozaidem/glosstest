<?php
/**
 * Main theme component that contains different core functions related to theme.
 *
 * @author    Tomo Zaidem
 * @package   Gloss_Dev_Test
 * @version   1.0.0
 */

/**
 * No direct access to this file.
 *
 * @since 1.0.0
 */
defined( 'ABSPATH' ) || die();

/**
 * Class Application
 */
class GT_Application extends BT_App {

	/**
	 * List of body classes.
	 *
	 * @var array
	 */
	public $body_classes = array();

	/**
	 * Flag to determine if body classes should be filtered.
	 *
	 * @var bool
	 */
	protected $_body_class_filter_set = false;

	/* body classes management */
	/**
	 * Adds specefined class to body.
	 *
	 * @param string $class the body class.
	 * @return  Theme
	 */
	public function add_body_class( $class ) {
		$this->body_classes[] = $class;
		if ( ! $this->_body_class_filter_set ) {
			add_filter( 'body_class', array( $this, 'body_class_filter' ) );
			$this->_body_class_filter_set = true;
		}
		return $this;
	}

	/**
	 * Filter for wp 'body_class' function.
	 *
	 * @param  array $classes list of classes.
	 * @return array
	 */
	public function body_class_filter( $classes ) {
		if ( $this->body_classes ) {
			foreach ( $this->body_classes as $class ) {
				$classes[] = $class;
			}
		}
		return $classes;
	}
	/* end body classes management */
}
