<?php

/**
 * Enqueue Pure Commerce Theme's Styles and Scripts
 * 
 * @author Emmanuel Olowu <http://eshomonu.com>
 */

if ( !is_admin() ) {
    // Add async or defer attributes to script enqueues
    function add_async_defer_attribute($tag, $handle)
    {
        // if script handle contains 'async' or 'defer
        if (strpos($handle, 'async') !== false) {
            $tag = str_replace('<script ', '<script async ', $tag);
        } else if (strpos($handle, 'defer') !== false) {
            $tag = str_replace('<script ', '<script defer ', $tag);
        }
        return $tag;
    }

    add_filter('script_loader_tag', 'add_async_defer_attribute', 10, 2);

    // Function to allow preloading of Styles
    function preload_style($tag, $handle)
    {
        if (strpos($handle, 'preload') !== false) {
            $preload_tag = str_replace('rel="stylesheet"', 'rel="preload"', $tag);
            return $preload_tag . $tag;
        }
        return $tag;
    }
    add_filter('style_loader_tag', 'preload_style', 10,
        2
    );
}

// Enqueue Pure Commerce Styles and Scripts
function pure_commerce_scripts() {
    global $all_theme_mods;

    // Box Icons.
    wp_enqueue_style('preload-box-icons', get_pure_commerce_assets('library/boxicons/css') . 'boxicons.min.css');

    // aos library
    wp_enqueue_style('aos', get_pure_commerce_assets('library/aos') . 'aos.css');
    wp_enqueue_script('aosJS', get_pure_commerce_assets('library/aos') . 'aos.js', '', '1.0', true);

    // Main stylesheet
    wp_enqueue_style('main', get_pure_commerce_assets('css') . 'main.css');
    wp_enqueue_style('esho', get_pure_commerce_assets('css/esho') . 'esho.css');
    
    // Header stylesheet
    wp_enqueue_style('header', get_pure_commerce_assets('css') . 'header.css');

    if (is_front_page() || is_home()) {
        if ($all_theme_mods['toggle_hero_header_sec'] == true) {
            wp_enqueue_style('hero-header',     get_pure_commerce_assets('css') . 'hero-header.css');
        }
    }

    if (is_single() || is_page()) {
        // enqueue stylesheet for single post.
        wp_enqueue_style('single-css', get_pure_commerce_assets('css') . 'single.css');
    }

    if (is_page()) {
        wp_enqueue_style('pages',     get_pure_commerce_assets('css') . 'pages.css');
    }

    if (is_404()) {
        // enqueue stylesheet for 404 page.
        wp_enqueue_style('404-css', get_pure_commerce_assets('css') . '404.css');
    }
}
add_action('wp_enqueue_scripts', 'pure_commerce_scripts');

