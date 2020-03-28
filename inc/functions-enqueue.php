<?php
/**
 * Functions enqueue.
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

if ( ! function_exists( 'glosstest_scripts' ) ) {
    function glosstest_scripts() {
        wp_enqueue_style( 'glosstest-fontawesome', get_template_directory_uri() . '/fontawesome/css/all.css' );

        wp_enqueue_style( 'glosstest-style', get_template_directory_uri() . '/css/main.css' );

        wp_enqueue_script( 'glosstest-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

        wp_enqueue_script( 'glosstest-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        wp_enqueue_script( 'glosstest-bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '4.4.1', true );

        wp_enqueue_script( 'glosstest-fontawesome', get_template_directory_uri() . '/fontawesome/js/all.js', array(), '4.4.1', true );
    }
    add_action( 'wp_enqueue_scripts', 'glosstest_scripts' );
}