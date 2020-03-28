<?php
/**
 * Header template part.
 *
 * @author    Tomo Zaidem
 * @package   Gloss_Dev_Test
 * @version   1.0.0
 */

get_template_part( 'templates/header/header', 'clean' );
?>
<header id="masthead" class="site-header header">
    <div class="header__content-mobile-menu"></div>
    <div class="header__content-wrap">
        <div class="header__content">
            <div class="header__content-logo">
                <a class="header__content-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php get_template_part( 'templates/header/logo' ); ?>
                </a>
            </div>
            <div class="header__content-details">
                <div class="header__content-details-top">
                    <ul class="social-icons">
                        <li class="social-icons__item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="social-icons__item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
                <div class="header__content-details-bottom">
                    <div class="header__content-details-nav">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'container' => 'ul',
                            'menu_class' => 'main-menu',
                            'menu_id' => 'navigation',
                            'depth' => 3,
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
<?php
get_template_part( 'templates/header/header', 'section' );
