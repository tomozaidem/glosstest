<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gloss_Dev_Test
 */

?>

<footer id="colophon" class="site-footer">
    <div class="site-info">
	    <?php
	    printf( esc_html__( '© Copyright %d. %s.', 'glosstest' ), date('Y'), get_bloginfo('name') );
	    ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
