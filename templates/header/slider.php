<?php
/**
 * Page header view for the slider mode.
 *
 * @author    Tomo Zaidem
 * @version   1.0.0
 */

/**
 * Page header view for the slider mode.
 *
 * @var string $title
 * @var string $section_mode
 * @var string $slider_mask
 * @var string $slider_timeout
 * @var string $slider_fadespeed
 * @var array|object slider_group
 * @var key slide_title
 * @var key slide_subtitle
 * @var key slide_image
 */

$is_home = ( 'home' === gt_check_if_home() || 'default' === gt_check_if_home() ) ? true : false;
$script_id = ( $is_home ) ? 'homeSliderInit' : 'innerSliderInit';
$slide_main_class = 'slick-slide';
$slide_class = ( $is_home ) ? $slide_main_class . ' slick-slide-home' : $slide_main_class . ' slick-slide-inner';
$slider_id = 'desktop' . get_the_ID();

$banner_default_mask_html = '';

$mask_html = ! empty( $banner_default_mask )
		? sprintf(
			'<div class="header-section-mask %s">' .
				'<div class="header-section-mask__outer hidden-sm hidden-xs"></div>' .
				'<div class="container header-section-mask__inner-wrap">' . 
					'<div class="header-section-mask__inner hidden-sm hidden-xs">' .
						'<div class="header-section-mask__curve"></div>' .
					'</div>' . 
					'<div class="header-section-mask__shape"></div>' .
				'</div>' .
			'</div>',
			esc_attr( 'header-section-mask--' . $banner_default_mask )
		  )
		: '';

$slider_order = get_field( 'slider_order', get_the_ID() );
if ( 'random' === $slider_order ) {
	shuffle( $slider_group );
}

$slide_index = 0;
$slide_timeouts = array();
$slide_timeouts_set = false;

foreach ( $slider_group as $slide ) {
	if ( $slide['slide_timeout'] != 0 ) {
		$slide_timeouts_set = true;
		break;
	}
}

if ( $slide_timeouts_set ) {
	foreach ( $slider_group as $slide ) {
		if ( $slide['slide_timeout'] != 0 ) {
			$slide_timeouts[$slide_index] = $slide['slide_timeout'];
		} else {
			$slide_timeouts[$slide_index] = ( $slider_timeout > 0 ) ? intval( $slider_timeout ) : 0;
		}
		$slide_index++;
	}
}

$js_config = array(
	'sliderSelector' => '#' . $slider_id,
	'slideTransitionType' => $slide_transition_type,
	'nextSelector' => '.' . $slide_main_class,
	'slideTimeouts'=> $slide_timeouts
);
$slick_options = array();
$slick_options['speed'] = intval( $slider_fadespeed );

if ( $is_home ) {
	$slick_options['arrows'] = true;
} else {
	$slick_options['arrows'] = false;
}

switch ($slide_transition_type) {
	case 'autoplay':
		$slick_options['autoplay'] = true;
		$slick_options['autoplaySpeed'] = ( $slider_timeout > 0 ) ? intval( $slider_timeout ) : 0;
		break;
	case 'static':
	case 'click':
		$slick_options['autoplay'] = false;
		break;
}

if ( $is_home ) {
	$slick_options['responsive'] = array(
		array(
			'breakpoint' => 991,
			'settings' => array(
				'autoplay' => false
			)
		)
	);

	$js_config['slideTransitionTypeMobile'] = 'click';
}

if ( $slick_options ) {
	$js_config['sliderOptions'] = $slick_options;
}

$slick_prev_arrow = ( $is_home && $slick_options['arrows'] == true ) ? '<span class="slick-prev slick-arrow custom">Prev</span>' : '';
$slick_next_arrow = ( $is_home && $slick_options['arrows'] == true ) ? '<span class="slick-next slick-arrow custom">Next</span>' : '';

SD_Js_Client_Script::add_script( $script_id . $slider_id, 'Theme.makeSlider(' . wp_json_encode( $js_config ) . ');' );
?>
<div id="<?php echo esc_attr( $slider_id ); ?>" class="slider<?php echo ( $is_home ) ? ' slider-home' : ' slider-inner'; ?>">
	<!-- Slides -->
	<?php
	$index = 1;
	foreach ( $slider_group as $slide ) {
		$class_title = $class_subtitle = $class_button = '';

		// TODO: Add slides param.
		$title = $slide['slide_title'];
		$subtitle = $slide['slide_subtitle'];
		$image = "background-image: url('" . $slide['slide_image'] . "')";

		$image_switcher  = " data-desktop='" . $slide['slide_image'] . "'";
		$image_switcher .= ( $slide['slide_image_mobile'] ) ?
			" data-mobile='" . $slide['slide_image_mobile'] . "'" :
			" data-mobile='" . $slide['slide_image'] . "'";
		$video_id = $slide['slide_video_id'];

		if ( $slide['slide_video_id'] != '' && $slide['slide_image'] == false && $slide['slide_image_mobile'] ) {
			$image = "background-image: url('" . $slide['slide_image_mobile'] . "')";
		}

		$button = '';
		$button_enabled = $slide['slide_button_enabled'];

		if ( $subtitle != '' ) {
			$class_title = ' has-slide-subtitle';
		}

		if ( $button_enabled ) {
			$button_text 	= $slide['slide_button_text'];
			$button_type 	= $slide['slide_button_type'];
			$class_subtitle = ' has-slide-button';

			switch ( $button_type ) {
				case 'page':
					$button_link = get_permalink( $slide['slide_page_link'] );
					$button_new_tab = ($slide['slide_new_tab']) ? ' target="_blank"' : '';
					$button = sprintf('<a class="button button--default" href="%s"%s>%s</a>',
						$button_link,
						$button_new_tab,
						$button_text
					);
					break;
				case 'post':
					$button_link = get_permalink( $slide['slide_post_link'] );
					$button_new_tab = ($slide['slide_new_tab']) ? ' target="_blank"' : '';
					$button = sprintf('<a class="button button--default" href="%s"%s>%s</a>',
						$button_link,
						$button_new_tab,
						$button_text
					);
					break;
				case 'attachment':
					$button_link = $slide['slide_attachment_link'];
					$button_new_tab = ($slide['slide_new_tab']) ? ' target="_blank"' : '';
					$button = sprintf('<a class="button button--default" href="%s"%s>%s</a>',
						$button_link,
						$button_new_tab,
						$button_text
					);
					break;
				case 'external':
					$button_link = $slide['slide_external_url'];
					$button_new_tab = ($slide['slide_new_tab']) ? ' target="_blank"' : '';
					$button = sprintf('<a class="button button--default" href="%s"%s>%s</a>',
						$button_link,
						$button_new_tab,
						$button_text
					);
					break;
			}
		}

		$text_section = sprintf('<div class="container slick-slide__title-wrap hidden-sm hidden-xs">%s<div class="slick-slide__title-inner-wrap"><div class="slick-slide__title' . $class_title . '">%s</div><div class="slick-slide__subtitle' . $class_subtitle . '">%s</div><div class="slick-slide__button">%s</div></div>%s</div>',
				$slick_prev_arrow,
				$title,
				$subtitle,
				$button,
				$slick_next_arrow
		);

		if ( $slide['slide_video_id'] != '' ) {
			$video = swishcli_youtube_embed_script( $index, $video_id );
			$video_html = sprintf('%s', $video);
		} else {
			$video_html = '';
		}

		if( $is_home ) {
			printf('<div class="%s" style="%s"%s>%s%s%s</div>',
					$slide_class,
					$image,
					$image_switcher,
					$video_html,
					$mask_html,
					$text_section
			);
		} else {
			printf('<div class="%s" style="%s"%s>%s</div>',
					$slide_class,
					$image,
					$image_switcher,
					$mask_html
			);
		}

		$index++;
	}
	?>
</div>