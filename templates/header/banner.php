<?php
/**
 * Banner mode template part.
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
 * @var string $title
 * @var string $section_mode
 * @var string $hero_banner_title
 * @var string $hero_banner_subtitle
 * @var string $hero_banner_image
 * @var string $hero_banner_image_mobile
 * @var string $hero_banner_button_enabled
 * @var string $hero_banner_button_text
 * @var string $hero_banner_button_type
 * @var string $hero_banner_page_link
 * @var string $hero_banner_post_link
 * @var string $hero_banner_attachment_link
 * @var string $hero_banner_external_url
 * @var string $hero_banner_new_tab
 */

$button_link = null;
$button_new_tab = ($hero_banner_new_tab)? 'target="_blank"':false;

if ( $hero_banner_button_enabled ) {
	switch ($hero_banner_button_type) {
		case 'page':
			$button_link = esc_url( get_permalink( $hero_banner_page_link ) );
			break;
		case 'post':
			$button_link = esc_url (get_permalink( $hero_banner_post_link ) );
			break;
		case 'attachment':
			$button_link = esc_url( $hero_banner_attachment_link );
			break;
		case 'external':
			$button_link = esc_url( $hero_banner_external_url );
			break;
	}
}
?>

<div class="header-section header-section--with-hero-banner">
	<div class="header-section__content-wrap">
		<div class="header-section--with-hero-banner-wrap">
			<div class="header-section__content header-section--with-hero-banner-content">
				<?php
				printf( '<h1 class="header-section__title">%s</h1>', $hero_banner_title );

				if ( $hero_banner_subtitle ) {
					printf( '<p class="header-section__description">%s</p>', $hero_banner_subtitle );
				}

				if ( $hero_banner_button_enabled ) {
					printf( '<a class="btn btn-primary btn-lg btn-block font-weight-bold" href="%s" role="button" %s>%s</a>',
						$button_link,
						$button_new_tab,
						$hero_banner_button_text
					);
				}
				?>
			</div>
		</div>
	</div>
	<?php
	if ( $hero_banner_image ) {
		printf( '<div class="header-section__simple-image" %s></div>',
			"style='background-image: url(" . $hero_banner_image . ")'"
		);
	} // End if().
	?>
</div>
