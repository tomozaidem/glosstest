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
					$section_meta['hero_banner_title'] = get_field('hero_banner_title', $post_id);
					$section_meta['hero_banner_subtitle'] = get_field('hero_banner_subtitle', $post_id);
					$section_meta['hero_banner_image'] = get_field('hero_banner_image', $post_id);
					$section_meta['hero_banner_image_mobile'] = get_field('hero_banner_image_mobile', $post_id);
					$section_meta['hero_banner_button_enabled'] = get_field('hero_banner_button_enabled', $post_id);
					$section_meta['hero_banner_button_text'] = ( $section_meta['hero_banner_button_enabled'] )? get_field('hero_banner_button_text', $post_id) : null;
					$section_meta['hero_banner_button_type'] = ( $section_meta['hero_banner_button_enabled'] )? get_field('hero_banner_button_type', $post_id) : null;
					$section_meta['hero_banner_page_link'] = ( $section_meta['hero_banner_button_enabled'] && $section_meta['hero_banner_button_type'] == 'page' )? get_field('hero_banner_page_link', $post_id) : null;
					$section_meta['hero_banner_post_link'] = ( $section_meta['hero_banner_button_enabled'] && $section_meta['hero_banner_button_type'] == 'post' )? get_field('hero_banner_post_link', $post_id) : null;
					$section_meta['hero_banner_attachment_link'] = ( $section_meta['hero_banner_button_enabled'] && $section_meta['hero_banner_button_type'] == 'attachment' )? get_field('hero_banner_attachment_link', $post_id) : null;
					$section_meta['hero_banner_external_url'] = ( $section_meta['hero_banner_button_enabled'] && $section_meta['hero_banner_button_type'] == 'external' )? get_field('hero_banner_external_url', $post_id) : null;
					$section_meta['hero_banner_new_tab'] = ( $section_meta['hero_banner_button_enabled'] )? get_field('hero_banner_new_tab', $post_id) : null;
					return $section_meta;
			}
		}
		return false;
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
