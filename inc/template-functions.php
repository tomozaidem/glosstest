<?php
/**
 * Template functions.
 *
 * @author    Tomo Zaidem
 * @version   1.0.0
 */

/**
 * No direct access to this file.
 *
 * @since 1.0.0
 */
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'glosstest_header_section_meta' ) ) {
    function glosstest_header_section_meta( $post_id ) {
        if ( class_exists( 'ACF' ) ){
	        $section_meta = array();
            $section_mode = get_field( 'section_mode', $post_id );
            switch ( $section_mode ) {
                case 'from_list':
	                $section_meta_id = get_field( 'header_section_id', $post_id );
	                $section_meta_mode = get_field( 'section_mode', $section_meta_id );
	                $section_meta = glosstest_get_header_section_meta( $section_meta_id, $section_meta_mode );
	                return $section_meta;
                    break;
	            default:
		            $section_meta = glosstest_get_header_section_meta( $post_id, $section_mode );
		            return $section_meta;
            }
        }
        return false;
    }
}

if ( ! function_exists( 'glosstest_get_header_section_meta' ) ) {
	function glosstest_get_header_section_meta( $post_id, $section_mode ) {
		if ( class_exists( 'ACF' ) ){
			$section_meta = array();
			switch ( $section_mode ){
				case 'slider':
					$section_meta['slider_group'] = get_field('slider_group', $post_id);
					$section_meta['slider_order'] = get_field('slider_order', $post_id);
					$section_meta['slide_transition_type'] = get_field('slide_transition_type', $post_id);
					$section_meta['slider_fadespeed'] = get_field('slider_fadespeed', $post_id);
					$section_meta['slider_timeout'] = ( $section_meta['slide_transition_type'] == 'autoplay' ) ? get_field('slider_timeout', $post_id) : null;
					return $section_meta;
					break;
				default:

					return $section_meta;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'gt_render_template_part' ) ) {
	/**
	 * Analog for the get_template_part function.
	 * Allows pass params to view file.
	 *
	 * @param  string  $template_name    view name.
	 * @param  string  $template_postfix optional postfix.
	 * @param  array   $data            assoc array with variables that should be passed to view.
	 * @param  boolean $return          if result should be returned instead of outputting.
	 * @return string
	 */
	function gt_render_template_part( $template_name, $template_postfix = '', array $data = array(), $return = false ) {
		static $app;
		if ( ! $app ) {
			$app = gt_di( 'app' );
		}
		return $app->render_template_part( $template_name, $template_postfix, $data, $return );
	}
}

// Default functions from underscore refactor or remove
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function glosstest_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'glosstest_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function glosstest_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'glosstest_pingback_header' );

function gt_split_title( $title, $return_html = true ) {
	$title 		= esc_html( $title );
	$title 		= trim( preg_replace( '/\s+/', ' ', $title ) );

	$words 		= explode( ' ', $title );
	$word_count = count($words);

	$divisor 	= $word_count / 2;
	$word_len 	= round( $divisor, 0, PHP_ROUND_HALF_UP );

	$array1 	= array_slice( $words, 0, $word_len );
	$string1 	= trim( implode( ' ', $array1 ) );

	$array2 	= array_slice( $words, $word_len );
	$string2 	= trim( implode( ' ', $array2 ) );

	if ( $return_html ) {
		return $string1 . ' <span>' . $string2 . '</span>';
	} else {
		return array( $string1, $string2 );
	}
}
