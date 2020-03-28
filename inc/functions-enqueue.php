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
        wp_enqueue_style( 'glosstest-fontawesome', PARENT_URL . '/fontawesome/css/all.css' );

	    wp_enqueue_style( 'glosstest-slicknav', PARENT_URL . '/css/slicknav.css' );

        wp_enqueue_style( 'glosstest-style', PARENT_URL . '/css/main.css', array(), rand() );

        wp_enqueue_script( 'glosstest-navigation', PARENT_URL . '/js/navigation.js', array(), '20151215', true );

        wp_enqueue_script( 'glosstest-skip-link-focus-fix', PARENT_URL . '/js/skip-link-focus-fix.js', array(), '20151215', true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        wp_enqueue_script( 'glosstest-bootstrap', PARENT_URL . '/js/bootstrap.bundle.min.js', array('jquery'), '4.4.1', true );

        wp_enqueue_script( 'glosstest-fontawesome', PARENT_URL . '/fontawesome/js/all.js', array(), '4.4.1', true );

	    wp_enqueue_script( 'glosstest-slicknav', PARENT_URL . '/js/jquery.slicknav.js',array( 'jquery' ), '1.0.10',true );

	    wp_enqueue_script( 'glosstest-js', PARENT_URL . '/js/main.js',array( 'jquery' ), '1.0.0',true );
    }
    add_action( 'wp_enqueue_scripts', 'glosstest_scripts' );
}