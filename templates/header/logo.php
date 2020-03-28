<?php
/**
 * Page header template part for the logo rendering.
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

if ( has_custom_logo() ) :
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    echo '<img width="'.$image[1].'" height="'.$image[2].'" src="'.$image[0].'" class="custom-logo" alt="Logo">';
else :
    ?>
    <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
<?php
endif;