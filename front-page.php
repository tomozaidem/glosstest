<?php
/**
 * Front page template file.
 *
 * @author  Tomo Zaidem
 * @package Gloss_Dev_Test
 * @version 1.0.0
 */
defined( 'ABSPATH' ) || die();

get_header();

get_template_part( 'templates/header/header', 'section' );

//if ( have_posts() ) {
//    while ( have_posts() ) {
//        the_post();
//        $post_id = get_the_ID();
//
//
//        /* Introduction */
//        $introduction = get_the_content();
//        if ( $introduction ) { ?>
<!--            <section class="introduction___content-wrap">-->
<!--                <div class="container-fluid">-->
<!--                    <div class="entry-content text-center">-->
<!--                        --><?php //echo $introduction; ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </section>-->
<!--        --><?php //}
//
//        /* Home Page - Focus Buttons */
//        $section_meta_service = qed_di( 'focus_button_section' );
//        $section_meta 		  = $section_meta_service ? $section_meta_service->get_section_meta() : array();
//
//        $focus_buttons = $section_meta['focus_button_group'];
//        $fb_contents   = array();
//        $fb_count 	   = 0;
//
//        $focus_buttons_id = 'focus_buttons_' . $post_id;
//
//        if ( !empty($focus_buttons) ) { ?>
<!--            <section class="home_focus_button__content-wrap">-->
<!--                <div class="container">-->
<!--                    <div class="focus-buttons">-->
<!--                        <div class="focus-buttons__wrap focus-buttons__home-inner-wrap">-->
<!--                            <section class="row focus-button__items">-->
<!--                                --><?php //foreach ( $focus_buttons as $focus_button ) {
//                                    $fb_count++;
//                                    $class_focus_button = '';
//
//                                    if ( $fb_count == 1 || $fb_count == 4 ) {
//                                        $class_focus_button = ' focus-button__sides';
//                                    }
//
//                                    if ( $fb_count == 2 || $fb_count == 3 ) {
//                                        $class_focus_button = ' focus-button__middle';
//                                    }
//
//                                    // Use list to wrap focus buttons.
//                                    $default_image = ! empty( $focus_button['focus_button_image'] ) ? $focus_button['focus_button_image']:'';
//                                    $mobile_image = ! empty( $focus_button['focus_button_image_mobile'] ) ? $focus_button['focus_button_image_mobile']:'';
//                                    $mobile_image = ( $mobile_image != '' ) ? $mobile_image : $default_image;
//
//                                    // Sides
//                                    $class_sides_column = ( $fb_count == 1 || $fb_count == 4 ) ? 'col-md-4 focus-button__col ' : '';
//
//                                    if ( $fb_count == 2 ) {
//                                        echo '<div class="col-md-4 col-xs-12 focus-button__col">';
//                                    }
//
//                                    switch ( true ) {
//                                        case 'external' === $focus_button['link_type']:
//                                            printf( '<div class="%scol-xs-12 focus-button focus-button__item%s">
//															<div class="focus-button">
//																<div class="focus-button__image hidden-sm hidden-xs" style="background-image: url(%s)"></div>
//																<div class="focus-button__image visible-block-sm visible-block-xs" style="background-image: url(%s)"></div>
//																<div class="focus-button__overlay"></div>
//
//																<div class="focus-button__content focus-button__inactive">
//																	<div class="middle-table">
//																		<div class="middle-table-cell">
//																			<h2 class="focus-button__title">%s</h2>
//																		</div>
//																	</div>
//																</div>
//
//																<div class="focus-button__active">
//																	<div class="focus-button__shape">
//																		<div class="focus-button__curve"></div>
//																	</div>
//																	<div class="focus-button__content">
//																		<div class="middle-table">
//																			<div class="middle-table-cell">
//																				<h2 class="focus-button__title"><span>%s<i></i></span></h2>
//																			</div>
//																		</div>
//																	</div>
//																</div>
//
//																<a class="focus-button__link" href="%s" target="_blank"></a>
//															</div>
//														</div>',
//                                                $class_sides_column,
//                                                $class_focus_button,
//                                                $default_image,
//                                                $mobile_image,
//                                                $focus_button['focus_button_title'],
//                                                $focus_button['focus_button_title'],
//                                                esc_url( qed_vp_focus_button_link( $focus_button ) )
//                                            );
//                                            break;
//                                        case 'page' === $focus_button['link_type']:
//                                        case 'post' === $focus_button['link_type']:
//                                        default:
//                                            printf( '<div class="%scol-xs-12 focus-button focus-button__item%s">
//															<div class="focus-button">
//																<div class="focus-button__image hidden-sm hidden-xs" style="background-image: url(%s)"></div>
//																<div class="focus-button__image visible-block-sm visible-block-xs" style="background-image: url(%s)"></div>
//																<div class="focus-button__overlay"></div>
//
//																<div class="focus-button__content focus-button__inactive">
//																	<div class="middle-table">
//																		<div class="middle-table-cell">
//																			<h2 class="focus-button__title">%s</h2>
//																		</div>
//																	</div>
//																</div>
//
//																<div class="focus-button__active">
//																	<div class="focus-button__shape">
//																		<div class="focus-button__curve"></div>
//																	</div>
//																	<div class="focus-button__content">
//																		<div class="middle-table">
//																			<div class="middle-table-cell">
//																				<h2 class="focus-button__title"><span>%s<i></i></span></h2>
//																			</div>
//																		</div>
//																	</div>
//																</div>
//
//																<a class="focus-button__link" href="%s"></a>
//															</div>
//														</div>',
//                                                $class_sides_column,
//                                                $class_focus_button,
//                                                $default_image,
//                                                $mobile_image,
//                                                $focus_button['focus_button_title'],
//                                                $focus_button['focus_button_title'],
//                                                esc_url( qed_vp_focus_button_link( $focus_button ) )
//                                            );
//                                    }
//
//                                    if ( $fb_count == 3 ) {
//                                        echo '</div>';
//                                    }
//                                } ?>
<!--                            </section>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </section>-->
<!--        --><?php //}
//    }
//}

get_footer();