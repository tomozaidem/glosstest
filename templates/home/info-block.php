<?php
/**
 * Info block template part.
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

/**
 * Page header view for the banner mode.
 *
 * @var string $info_title
 * @var string $info_content
 * @var string $info_image
 * @var string $info_button_enabled
 * @var string $info_button_text
 * @var string $info_button_type
 * @var string $info_page_link
 * @var string $info_post_link
 * @var string $info_attachment_link
 * @var string $info_external_url
 * @var string $info_new_tab
 * @var string $info_even
 */
$even_info = ( $info_even )? ' info-block__even':'';

$info_button = null;
$button_link = null;
$button_new_tab = ($info_new_tab)? 'target="_blank"':false;

if ( $info_button_enabled ) {
	switch ($info_button_type) {
		case 'page':
			$button_link = esc_url( get_permalink( $info_page_link ) );
			break;
		case 'post':
			$button_link = esc_url (get_permalink( $info_post_link ) );
			break;
		case 'attachment':
			$button_link = esc_url( $info_attachment_link );
			break;
		case 'external':
			$button_link = esc_url( $info_external_url );
			break;
	}

	$info_button = sprintf( '<a class="btn btn-primary" href="%s" role="button" %s>%s</a>',
		$button_link,
		$button_new_tab,
		$info_button_text
	);
}

$info_image_class = ( $info_even )? ' info-block__even-image-wrap':' info-block__odd-image-wrap';
$info_image_html = sprintf( '<div class="%s" %s></div>',
	$info_image_class,
	"style='background-image: url(" . $info_image . ")'"
);

switch($even_info) {
	case true:
		$info_content = sprintf('<div class="info-block__column">
											<div class="info-block__even-inner-wrap">
												<div class="info-block__even-inner">
													<h2 class="info-block__even-title">%s</h2>
													<div class="info-block__even-content">%s</div>
													%s
												</div>
											</div>
										</div>
										<div class="info-block__column">%s</div>',
			$info_title,
			$info_content,
			$info_button,
			$info_image_html
		);
		break;
	default:
		$info_content = sprintf('<div class="info-block__column">%s</div>
										<div class="info-block__column">
											<div class="info-block__odd-inner-wrap">
												<div class="info-block__odd-inner">
													<h2 class="info-block__odd-title">%s</h2>
													<div class="info-block__odd-content">%s</div>
													%s
												</div>
											</div>
										</div>',
			$info_image_html,
			$info_title,
			$info_content,
			$info_button
		);
		break;
}

printf( '<section class="info-block__content-wrap%s">
					<div class="container-fluid">
						<div class="info-block__row">
							%s
						</div>
					</div>
				</section>',
	$even_info,
	$info_content
);

