<?php

/**
 * Pure Commerce Theme supports
 *
 * @author Emmanuel Olowu 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package pure-commerce
 */

if (!function_exists('pure_commerce_setup')) {
    /*--------------------------------------------------------------------------------
	pure_commerce_setup - sets up theme
	- adds theme support for post formats, post thumbnails, HTML5 and automatic feed links
	- registers a translation file
	- registers navigation menus
	---------------------------------------------------------------------------------*/

    function pure_commerce_setup()
    {
        // Load TextDomain.
        load_theme_textdomain('pure-commerce');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // post formats
        add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));

        // use wp_nav_menu() in one location.
        register_nav_menu('primary', __('Primary Menu', 'pure-commerce'));

        // HTML5
        add_theme_support('html5');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails', array('post', 'page', 'events', 'gallery', 'portfolios'));

        // Set up the WordPress core custom background feature.
        $defaults = array(
            'default-color'          => '',
            'default-image'          => '',
            'default-repeat'         => '',
            'default-position-x'     => '',
            'default-attachment'     => '',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => '',
            'admin-preview-callback' => ''
        );
        add_theme_support('custom-background', $defaults);

        // Enable widget sidebars to use selective refresh in the Customizer.
        add_theme_support('customize-selective-refresh-widgets');

        // Create and set the front page and blog page.
        create_and_set_pages();
    }
}
add_action('after_setup_theme', 'pure_commerce_setup');

// REMOVE WP-EMOJI JAVASCRIPT & CSS
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');