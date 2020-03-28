<?php
/**
 * Page header section template.
 *
 * @author    Tomo Zaidem
 * @version   1.0.0
 */

defined( 'ABSPATH' ) || die();

$section_meta = glosstest_header_section_meta( get_the_ID() );

$mode = isset( $section_meta['section_mode'] ) ? $section_meta['section_mode'] : 'hide';

//if ( is_404() || is_archive() || is_search() ) {
//    $blod_slide_id 	= get_field( 'global_header_section_id', 'option' );
//    $section_meta 	= $section_meta_service->get_section_meta_by_post_id( $blod_slide_id );
//    $mode 			= 'slider';
//}

switch ( $mode ) {
    case 'banner':
        print '<div id="dee-slider">';
        qed_render_template_part( 'templates/header/banner', '', $section_meta );
        print '<div class="clearfix"></div></div>';
        if ( ! $is_home ):
            qed_render_template_part( 'templates/header/title-block', '', $section_meta );
        endif;
        break;

    case 'slider':
        print '<div id="dee-slider">';
        qed_render_template_part( 'templates/header/slider', '', $section_meta );
        print '<div class="clearfix"></div></div>';
        if ( ! $is_home ):
            qed_render_template_part( 'templates/header/title-block', '', $section_meta );
        endif;
        break;

    case 'hide':
    default:
        if ( ! is_page_template('template-contact-page.php') ):
            qed_render_template_part( 'templates/header/title-block', '', $section_meta );
        endif;
        break;
}
