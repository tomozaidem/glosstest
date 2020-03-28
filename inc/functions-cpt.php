<?php
/**
 * Custom post types.
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

register_post_type('gt_header_section', array(
    'labels' => array(
        'name' => __('Header Sections', 'glosstest'),
        'add_new' => esc_html__( 'Add New Header Section', 'glosstest' ),
        'edit_item' => esc_html__( 'Edit Header Section', 'glosstest' ),
        'singular_name' => __('Header Section', 'glosstest'),
        'all_items' => __('All Header Sections', 'glosstest'),
        'add_new_item' => __('Add New Header Section', 'glosstest'),
        'edit' => __('Edit', 'glosstest'),
        'new_item' => __('New Header Section', 'glosstest'),
        'view' => __('View Header Section', 'glosstest'),
        'view_item' => __('View Header Section', 'glosstest'),
        'search_items' => __('Search Header Sections', 'glosstest'),
        'not_found' => __('No Header Sections found', 'glosstest'),
        'not_found_in_trash' => __('No Header Sections found in trash', 'glosstest'),
        'parent' => __('Parent Header Section', 'glosstest')
    ),
    'public' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'has_archive' => false,
    'query_var' => false,
    'rewrite' => false,
    'show_ui' => true,
    'show_in_nav_menus' => false,
    'menu_icon' => 'dashicons-slides',
    'menu_position' => 10,
    'supports' => array(
        'title',
    ),
));

function register_header_sections_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['gt_header_section'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Header section updated. <a href="%s">View Header Section</a>', 'glosstest'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.', 'glosstest'),
        3 => __('Custom field deleted.', 'glosstest'),
        4 => __('Header section updated.', 'glosstest'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Header section restored to revision from %s', 'glosstest'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Header section published. <a href="%s">View Header Section</a>', 'glosstest'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Header section saved.', 'glosstest'),
        8 => sprintf( __('Header section submitted. <a target="_blank" href="%s">Preview Header Section</a>', 'glosstest'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Header section scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Header Section</a>', 'glosstest'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __('M j, Y @ G:i', 'glosstest'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Header section draft updated. <a target="_blank" href="%s">Preview Header Section</a>', 'glosstest'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}
add_filter( 'post_updated_messages', 'register_header_sections_updated_messages' );

register_post_type('gt_team_section', array(
    'labels' => array(
        'name' => __('Team Members', 'glosstest'),
        'add_new' => esc_html__( 'Add New Team Member', 'glosstest' ),
        'edit_item' => esc_html__( 'Edit Team Member', 'glosstest' ),
        'singular_name' => __('Team Member', 'glosstest'),
        'all_items' => __('All Team Members', 'glosstest'),
        'add_new_item' => __('Add New Team Member', 'glosstest'),
        'edit' => __('Edit', 'glosstest'),
        'new_item' => __('New Team Member', 'glosstest'),
        'view' => __('View Team Member', 'glosstest'),
        'view_item' => __('View Team Member', 'glosstest'),
        'search_items' => __('Search Team Members', 'glosstest'),
        'not_found' => __('No Team Members found', 'glosstest'),
        'not_found_in_trash' => __('No Team Members found in trash', 'glosstest'),
        'parent' => __('Parent Team Member', 'glosstest')
    ),
    'public' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'has_archive' => false,
    'query_var' => false,
    'rewrite' => false,
    'show_ui' => true,
    'show_in_nav_menus' => false,
    'menu_icon' => 'dashicons-groups',
    'menu_position' => 30,
    'supports' => array(
        'title',
    ),
));

function register_team_members_default_title( $title ){
    $screen = get_current_screen();
    if ( 'gt_team_section' === $screen->post_type ) {
        $title = 'Enter name here';
    }
    return $title;
}
add_filter( 'enter_title_here', 'register_team_members_default_title' );

function register_team_members_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['gt_team_section'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Team member updated. <a href="%s">View Team Member</a>', 'glosstest'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.', 'glosstest'),
        3 => __('Custom field deleted.', 'glosstest'),
        4 => __('Team member updated.', 'glosstest'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Team member restored to revision from %s', 'glosstest'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Team member published. <a href="%s">View Team Member</a>', 'glosstest'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Team member saved.', 'glosstest'),
        8 => sprintf( __('Team member submitted. <a target="_blank" href="%s">Preview Team Member</a>', 'glosstest'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Team member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Team Member</a>', 'glosstest'),
            // translators: Publish box date format, see http://php.net/date
            date_i18n( __('M j, Y @ G:i', 'glosstest'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Team member draft updated. <a target="_blank" href="%s">Preview Team Member</a>', 'glosstest'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}
add_filter( 'post_updated_messages', 'register_team_members_updated_messages' );