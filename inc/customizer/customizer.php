<?php

// Load Clarusmod Customizer
include_once get_template_directory() . '/inc/clarusmod/clarusmod.php';

// Initialize Customizer settings
$panels_path = trailingslashit(dirname(__FILE__)) . 'panels/panels.php';
$pure_commerce_settings = new initialize_clarusmod_customizer_settings($panels_path);


if (!function_exists('pure_commerce_theme_mods')) {
    function pure_commerce_theme_mods() {
        $pure_commerce_mods = array(
            'placeholder_img'               => get_theme_mod('placeholder_img'),
            'background_color'              => get_theme_mod('background_color', get_theme_support('custom-background', 'default-color')),

            'short_site_title'              => get_theme_mod('short_site_title', ''),
            'your_theme_logo'               => get_theme_mod('your_theme_logo'),
            'pureFolio_theme_color'         => get_theme_mod('pureFolio_theme_color', '#2869ff'),
            
            // mods for button style
            'button_style'                  => get_theme_mod('button_style', 'normal'),
        );

        $header_nav_mods = array(
            'header_text_color'             => get_theme_mod('header_text_color', ''),
            'header_bg_color'               => get_theme_mod('header_bg_color', ''),
            'header_bg_image'               => get_theme_mod('header_bg_image'),

            'nav_text_transform'            => get_theme_mod('nav_text_transform', 'capitalize'),
            'title_text_transform'          => get_theme_mod('title_text_transform', 'capitalize'),
        );

        $footer_mods = array(
            'footer_text_color'             => get_theme_mod('footer_text_color', ''),
            'footer_bg_color'               => get_theme_mod('footer_bg_color', ''),
            'footer_bg_image'               => get_theme_mod('footer_bg_image'),
            'toggle_footer_copyright'       => get_theme_mod('toggle_footer_copyright', true),
            'toggle_footer_dev_credits'     => get_theme_mod('toggle_footer_dev_credits', true),
            'toggle_footer_platform_info'   => get_theme_mod('toggle_footer_platform_info', true),
        );

        $blog_page_mods = array(
            'toggle_blog_sidebar'            => get_theme_mod('toggle_blog_sidebar', true),
            'toggle_blog_page_title'         => get_theme_mod('toggle_blog_page_title', true),
            'blog_page_title'                => get_theme_mod('blog_page_title', 'Blog Posts'),
        );

        $single_page_mods = array(
            // mods for single page
            'toggle_single_sidebar'         => get_theme_mod('toggle_single_sidebar', true),
            'toggle_single_featured_img'    => get_theme_mod('toggle_single_featured_img', true),
            'toggle_single_excerpt'         => get_theme_mod('toggle_single_excerpt', true),
            'toggle_excerpt_italics'        => get_theme_mod('toggle_excerpt_italics', false),
            'toggle_share_btns'             => get_theme_mod('toggle_share_btns', true),
            'toggle_facebook_btn'           => get_theme_mod('toggle_facebook_btn', true),
            'toggle_x_btn'                  => get_theme_mod('toggle_x_btn', true),
            'toggle_whatsapp_btn'           => get_theme_mod('toggle_whatsapp_btn', true),
            'toggle_telegram_btn'           => get_theme_mod('toggle_telegram_btn', false),
            'toggle_pinterest_btn'          => get_theme_mod('toggle_pinterest_btn', false),
            'toggle_linkedin_btn'           => get_theme_mod('toggle_linkedin_btn', false),
        );

        $front_page_mods = array(
            // mods for frontpage hero section
            'toggle_hero_header_sec'        => get_theme_mod('toggle_hero_header_sec', true),
            'hero_header_sec_img'           => get_theme_mod('hero_header_sec_img', get_pure_commerce_assets('img') . 'hands-1.jpg'),
            'hero_header_sec_title'         => get_theme_mod('hero_header_sec_title', 'Stay ahead of the curve with our forward thinking.'),
            'hero_header_sec_subtext'       => get_theme_mod('hero_header_sec_subtext', 'We take extreme pride at being the very best at what we do.'),
            'toggle_hero_header_sec_btn'    => get_theme_mod('toggle_hero_header_sec_btn', true),
            'hero_header_sec_btn_url'       => get_theme_mod('hero_header_sec_btn_url', '#'),
            'hero_header_sec_btn_text'      => get_theme_mod('hero_header_sec_btn_text', 'Get in touch'),
        );
        
        $page_mods = array(

        );

        $theme_mods = $pure_commerce_mods + $header_nav_mods + $footer_mods + $front_page_mods + $blog_page_mods + $single_page_mods + $page_mods;

        return apply_filters('pureFolio_theme_mods', $theme_mods);
    }
}

global $all_theme_mods;
global $pureFolioPageThemeMods;
$all_theme_mods = pure_commerce_theme_mods();
// $pureFolioPageThemeMods = pureFolio_page_theme_mods();