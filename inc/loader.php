<?php
/**
 * Theme bootstrap file that defines classes loaders.
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

$loader_path = dirname( __FILE__ );
if ( ! defined( '_THEME_VENDOR_PATH_' ) ) {
	define( '_THEME_VENDOR_PATH_', $loader_path . '/../vendor/' );
}

if ( ! defined( '_THEME_VENDOR_PATH_URI_' ) ) {
	define( '_THEME_VENDOR_PATH_URI_', PARENT_URL . '/vendor/' );
}

set_include_path(
	get_include_path() .
	PATH_SEPARATOR . $loader_path
);

if ( ! function_exists( 'glosstest_autoloader' ) ) {
	/**
	 * Vendor components loading function.
	 *
	 * @param  string $class class name that should be loaded.
	 * @return void
	 */
	function glosstest_autoloader( $class ) {
		static $map, $includes_path;
		if ( ! $map ) {
			$map = array(
				'JuiceContainer' => _THEME_VENDOR_PATH_ . 'juice/JuiceContainer.php'
			);
			$includes_path = dirname( __FILE__ );
		}

		if ( isset( $map[ $class ] ) ) {
			$file_name = $map[ $class ];
			if ( $file_name ) {
				require $file_name;
			}
		} elseif ( 0 === strpos( $class, 'GT' ) ) {
			$class_filename = 'class-' . str_replace( '_', '-', strtolower( $class ) );
			$theme_class_file = "{$includes_path}/classes/{$class_filename}.php";
			if ( file_exists( $theme_class_file ) ) {
				require $theme_class_file;
			}
		}
	}

	spl_autoload_register( 'glosstest_autoloader' );
}

require _THEME_VENDOR_PATH_ . 'brewedtech/wp-components/bootstrap.php';