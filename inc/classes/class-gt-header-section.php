<?php
/**
 * Component for handling page header section settings.
 * Requires ACF.
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
 * Class GT_Header_Section
 */
class GT_Header_Section extends BT_Component {

	/**
	 * The header section meta key.
	 *
	 * @var string
	 */
	public $page_meta_key = 'header_section_meta';

	/**
	 * The mobile header section meta key.
	 *
	 * @var string
	 */
	public $mobile_page_meta_key = 'mobile_header_section_meta';

	/**
	 * Flag for hidden mode.
	 *
	 * @var string
	 */
	private $mode_none = 'hide';

	/**
	 * Default title separator.
	 *
	 * @var string
	 */
	public $title_separator = '';

	/**
	 * Flag to determine if we are going to use the wordpress title function.
	 *
	 * @var bool
	 */
	public $use_wp_title_function = false;

	/**
	 * Method to get the section meta.
	 *
	 * @return array
	 */
	public function get_section_meta() {
		$section_meta = array();

		$is_single = is_singular();

		$section_post_id = $is_single ? get_the_ID() : $this->get_section_id_for_archive_page();

		if ( $section_post_id ) {
			$section_meta = $this->get_section_meta_by_post_id( $section_post_id );
		}

		if ( ! $is_single && empty( $section_meta ) ) {
			$default_image_url = gt_get_option( 'banner_is_show', 'option' ) ? gt_get_option( 'banner_default_image', 'option' ) : null;
			$section_meta['section_mode'] = $default_image_url ? 'banner' : $this->mode_none;
			$section_meta['banner_image'] = $default_image_url;
			$section_meta['banner_subtitle'] = gt_get_option( 'banner_default_subtitle', 'option' );
			$section_meta['is_banner_image_parallax'] = gt_get_option( 'is_banner_default_image_parallax', 'option' );
			$section_meta['banner_image_repeat'] = gt_get_option( 'banner_default_image_repeat', 'option' );
			$section_meta['banner_mask'] = gt_get_option( 'banner_default_mask', 'option' );
			$section_meta['test'] = 'Confirmed';
		}

		$section_meta['title'] = $this->get_title();
		return $section_meta;
	}

	/**
	 * Method to get title tag.
	 *
	 * @return null|string|void
	 */
	public function get_title() {
		$separator = $this->title_separator;
		$use_wp_title = $this->use_wp_title_function;

		// Disabling 'title-tag' feature.
		$activate_title_tag_back = false;
		if ( $use_wp_title && get_theme_support( 'title-tag' ) ) {
			remove_theme_support( 'title-tag' );
			$activate_title_tag_back = true;
		}

		$q = $GLOBALS['wp_query'];
		if ( $q->get( 'wc_query' ) && function_exists( 'woocommerce_page_title' ) ) {
			if ( $separator ) {
				$separator = '';
			}
			$title = woocommerce_page_title( false );
		} else {
			$is_home = is_home();
			$is_front_page = is_front_page();
			if ( $is_home || $is_front_page ) {
				if ( $is_home && $is_front_page ) {
					$title = get_bloginfo( 'name' );
				} elseif ( $is_home ) {
					$title = get_the_title( get_option( 'page_for_posts' ) );
				} elseif ( $is_front_page ) {
					$title = get_the_title( get_option( 'page_on_front' ) );
				}
			} else {
				if ( $use_wp_title ) {
					$title = wp_title( $separator, false );
				} else {
					$title = is_singular() ? get_the_title( get_queried_object() ) : strip_tags( get_the_archive_title() );
				}
			}
		}

		// Restoring 'title-tag' feature.
		if ( $activate_title_tag_back ) {
			// add_theme_support( 'title-tag' );
			$GLOBALS['_wp_theme_features']['title-tag'] = true;
		}

		if ( $title ) {
			if ( $separator ) {
				$title = substr( $title, strlen( $separator ) + 1 );
			}
			$title = trim( $title );
		}

		return $title;
	}

	/**
	 * Method to get section id of archive pages.
	 *
	 * @return int|mixed|void
	 */
	protected function get_section_id_for_archive_page() {
		$result = 0;
		if ( is_home() ) {
			$result = get_option( 'page_for_posts' );
		}
		// TODO: Refactor for woocommerce support.
//		elseif ( is_post_type_archive( 'product' ) ) {
//			$result = wc_get_page_id( 'shop' );
//		}

		return $result;
	}

	/**
	 * Method to get section meta.
	 *
	 * @param     $post_id
	 *
	 * @return array
	 */
	public function get_section_meta_by_post_id( $post_id ) {
		$section_meta = array();

		if ( '-1' === $post_id ) {
			$section_meta['section_mode'] = $this->mode_none;
		} else {
			if ( $post_id > 0 ) {
				$section_meta['section_mode'] = gt_get_option( 'section_mode', $post_id );
				$header_option_id = ( $section_meta && ! empty( $section_meta['section_mode'] ) && 'from_list' === $section_meta['section_mode'] ) ? gt_get_option( 'header_section_id', $post_id ) : $post_id;

				$section_meta['section_mode'] = ( 'from_list' === $section_meta['section_mode'] ) ? gt_get_option( 'section_mode', $header_option_id ) : $section_meta['section_mode'];
				$section_meta['slider_order'] = gt_get_option( 'slider_order', $header_option_id );
				$section_meta['slide_transition_type'] = gt_get_option( 'slide_transition_type', $header_option_id );
				$section_meta['slider_timeout'] = gt_get_option( 'slider_timeout', $header_option_id );
				$section_meta['slider_fadespeed'] = gt_get_option( 'slider_fadespeed', $header_option_id );
				$section_meta['slider_group'] = gt_get_option( 'slider_group', $header_option_id );

				// Hero Banner
				$section_meta['hero_banner_title'] = gt_get_option('hero_banner_title', $header_option_id);
				$section_meta['hero_banner_subtitle'] = gt_get_option('hero_banner_subtitle', $header_option_id);
				$section_meta['hero_banner_image'] = gt_get_option('hero_banner_image', $header_option_id);
				$section_meta['hero_banner_image_mobile'] = gt_get_option('hero_banner_image_mobile', $header_option_id);
				$section_meta['hero_banner_button_enabled'] = gt_get_option('hero_banner_button_enabled', $header_option_id);
				$section_meta['hero_banner_button_text'] = gt_get_option('hero_banner_button_text', $header_option_id);
				$section_meta['hero_banner_button_type'] = gt_get_option('hero_banner_button_type', $header_option_id);
				$section_meta['hero_banner_page_link'] = gt_get_option('hero_banner_page_link', $header_option_id);
				$section_meta['hero_banner_post_link'] = gt_get_option('hero_banner_post_link', $header_option_id);
				$section_meta['hero_banner_attachment_link'] = gt_get_option('hero_banner_attachment_link', $header_option_id);
				$section_meta['hero_banner_external_url'] = gt_get_option('hero_banner_external_url', $header_option_id);
				$section_meta['hero_banner_new_tab'] = gt_get_option('hero_banner_new_tab', $header_option_id);
			}
		}

		return $section_meta;
	}
}
