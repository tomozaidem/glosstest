<?php
/**
 * Page header section template.
 *
 * @author    Tomo Zaidem
 * @version   1.0.0
 */

defined( 'ABSPATH' ) || die();

$section_meta_service = gt_di( 'header_section' );
$section_meta = $section_meta_service ? $section_meta_service->get_section_meta() : array();

// $mode == 'hide' means "default" mode.
$mode = isset( $section_meta['section_mode'] ) ? $section_meta['section_mode'] : 'hide';

if ( 'hero' === $mode && empty( $section_meta['hero_banner_image'] ) ) {
	$mode = 'hide';
}

if ( 'hide' === $mode && is_front_page() ) {
	// To hide default title for home page.
	return;
}

//if ( is_404() || is_archive() || is_search() ) {
//	$blod_slide_id 	= get_field( 'global_header_section_id', 'option' );
//	$section_meta 	= $section_meta_service->get_section_meta_by_post_id( $blod_slide_id );
//	$mode 			= 'slider';
//}

switch ( $mode ) {
	case 'hero':
		print '<div id="dee-slider">';
		gt_render_template_part( 'templates/header/banner', '', $section_meta );
		print '<div class="clearfix"></div></div>';
		break;

	case 'slider':
		print '<div id="dee-slider">';
		gt_render_template_part( 'templates/header/slider', '', $section_meta );
		print '<div class="clearfix"></div></div>';
		if ( ! is_home() ):
			gt_render_template_part( 'templates/header/title-block', '', $section_meta );
		endif;
		break;

	case 'hide':
	default:
		if ( ! is_page_template('template-contact-page.php') ):
			gt_render_template_part( 'templates/header/title-block', '', $section_meta );
		endif;
		break;
}
