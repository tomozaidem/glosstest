<?php
/**
 * Theme core functions file.
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

require PARENT_DIR . '/inc/loader.php';
//require PARENT_DIR . '/includes/data/loader.php';

/**
 * Returns dependency injection container/element from container by key.
 *
 * @param  string $key dependency key.
 * @return mixed
 */
function &gt_di( $key = null ) {
	static $di;
	if ( ! $di ) {
		$di = new JuiceContainer();
	}
	if ( $key ) {
		$result = $di[ $key ];
		return $result;
	}
	return $di;
}

/**
 * Initialize dependency injector callback.
 *
 * @param array $di dependency injector.
 * @param mixed $config di config.
 */
function gt_init_di_callback( $di, $config ) {
	if ( $config ) {
		foreach ( $config as $key => $value ) {
			$instance = null;
			$class = '';
			$typeof = gettype( $value );
			switch ( $typeof ) {
				case 'string':
					$class = $value;
					break;

				case 'array':
					$class = array_shift( $value );
					break;

				default:
					$instance = $value;
					$class = get_class( $instance );
					break;
			}
			$di_key = is_string( $key ) ? $key : $class;
			if ( isset( $di[ $di_key ] ) ) {
				continue;
			}

			$di[ $di_key ] = $instance ? $instance : JuiceDefinition::create( $class, $value );
		}
	}
}
add_action( 'gt_init_di', 'gt_init_di_callback', 10, 2 );

if ( ! function_exists( 'gt_get_option' ) ) {
	/**
	 * Returns theme option value.
	 *
	 * @param  string $name    option name.
	 * @param  mixed  $default default value.
	 * @return mixed
	 */
	function gt_get_option( $name, $id = null, $default = null ) {
		$option = ( $id ) ? $id : 'option';
		if ( get_field( $name, $option ) ) {
			return get_field( $name, $option );
		} else {
			return $default;
		}
	}
}

if ( ! function_exists( 'glosstest_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function glosstest_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Gloss Dev Test, use a find and replace
		 * to change 'glosstest' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'glosstest', get_template_directory() . '/languages' );

		do_action( 'gt_init_di', gt_di(), require PARENT_DIR . '/inc/config.php' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Primary Menu', 'glosstest' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'glosstest_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
	add_action( 'after_setup_theme', 'glosstest_setup' );
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function glosstest_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'glosstest_content_width', 640 );
}
add_action( 'after_setup_theme', 'glosstest_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function glosstest_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'glosstest' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'glosstest' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'glosstest_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/functions-enqueue.php';

/**
 * Register custom post types.
 */
require get_template_directory() . '/inc/functions-cpt.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}