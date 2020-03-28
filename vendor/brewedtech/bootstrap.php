<?php
/**
 * Theme bootstrap file that defines component loaders.
 *
 * @author    Tomo Zaidem
 * @package   BrewedTech/WP_Components
 * @version   1.0.0
 */

if ( ! function_exists( 'brewedtech_autoloader' ) ) {

	/**
	 *  Vendor components loading function.
	 *
	 * @param string $class class name that should be loaded.
	 */
	function brewedtech_autoloader( $class ) {

		if ( 0 === strpos( $class, 'BT' ) ) {
			$class_filename = 'class-' . str_replace( '_', '-', strtolower( $class ) );
			require dirname( __FILE__ ) . '/components/' . $class_filename . '.php';
		}

	}
	spl_autoload_register( 'brewedtech_autoloader' );
}
