<?php
/**
 * Page header view for the default mode (mode without any specific settings).
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

global $post;
if ( is_home() ) {
	return;
}

/**
 * Page header view for the default mode (mode without any specific settings).
 *
 * @var string $title
 * @var string $section_mode
 * @var string $slider_alias
 * @var string $banner_subtitle
 * @var string $banner_image
 * @var string $is_banner_image_parallax
 * @var string $banner_image_repeat
 * @var string $banner_mask
 */

$breadcrumbs_html = gt_render_template_part( 'templates/header/breadcrumbs', '', array(), true );

?>

<div id="header-title-block" class="container block-after-indent margin-top-large margin-bottom-large">
	<div class="row">
		<div class="col-md-12">
			<div class="header-section padding-left padding-right">
				<div class="header-section__content<?php echo ( $breadcrumbs_html ? ' header-section__content--breadcrumbs' : ' header-section__content--title' ); ?>">
				<?php
					if ( is_page( 'login' ) ) {
						if ( isset($_GET['user']) && $_GET['user'] == 'staff' ) {
							$title = 'Staff ' . $title;
						} elseif ( isset($_GET['user']) && $_GET['user'] == 'member' ) {
							$title = 'Member ' . $title;
						} elseif ( isset($_GET['user']) && $_GET['user'] == 'administrator' ) {
							$title = 'Administrator ' . $title;
						} else {
							wp_redirect( '?user=member' );
						}
					}

					if ( is_archive() ) {
						$title = get_the_archive_title();
					}

					if ( is_author() ) {
						$title = 'Author: ' . get_the_author();
					}

					if ( is_search() ) {
						$title = 'Search results for: ' . $_GET['s'];
					}

					if ( is_404() ) {
						if ( is_home() && current_user_can( 'publish_posts' ) ) {
							$title = get_the_title( get_current_blog_id() );
						} elseif ( is_search() ) {
							$title = 'Page not found!';
						} else {
							$title = 'Page not found!';
						}
					}

					printf( '<div class="%s"><h1 class="header-section__title">%s</h1></div>',
						$breadcrumbs_html ? 'header-section__title-wrap--breadcrumbs' : 'header-section__title-wrap',
						gt_split_title( $title )
					);

					if ( $breadcrumbs_html ) {
						printf( '<div class="breadcrumbs-wrap">%s</div>', $breadcrumbs_html );
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>