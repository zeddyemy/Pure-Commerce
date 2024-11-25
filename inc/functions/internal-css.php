<?php

function internal_css()
{
    global $all_theme_mods;
    $all_theme_mods = pure_commerce_theme_mods();

    $header_txt_color = !empty($all_theme_mods['header_text_color']) ? $all_theme_mods['header_text_color'] : 'var(--body-txt-clr)';
    $header_bg_color = !empty($all_theme_mods['header_bg_color']) ? $all_theme_mods['header_bg_color'] : 'var(--box-bg-clr-solid)';

    // To check If Uppercase is set for the nav items
    $navbar_case_mod  = $all_theme_mods['nav_text_transform'];
    $navbar_case = ($navbar_case_mod == 'capitalize') ? 'capitalize' : (($navbar_case_mod == 'uppercase') ? 'uppercase' : 'lowercase');

    $title_case_mod  = $all_theme_mods['title_text_transform'];
    $title_case = ($title_case_mod == 'capitalize') ? 'capitalize' : (($title_case_mod == 'uppercase') ? 'uppercase' : 'lowercase');

    $footer_txt_color = !empty($all_theme_mods['footer_text_color']) ? $all_theme_mods['footer_text_color'] : 'var(--body-txt-clr)';
    $footer_bg_color = !empty($all_theme_mods['footer_bg_color']) ? $all_theme_mods['footer_bg_color'] : 'var(--box-bg-clr-solid)';

    $admin_bar = is_admin_bar_showing();

    echo '<style>
        #header {
            --navbar-background-color: ' . $header_bg_color . ' !important;
        }
        @media screen and (max-width: 1024px) {
            .nav {
                --header-text-color: ' . $header_txt_color . ' !important;
            }
        }
        .no-hero #header, .headerBg {
            --header-text-color: ' . $header_txt_color . ' !important;
            --header-background-color: ' . $header_bg_color . ' !important;
            --header-background-image: url(' . $all_theme_mods['header_bg_image'] . ');
        }
        body {
            --theme-clr: ' . $all_theme_mods['pureFolio_theme_color'] . ';
            --theme-clr-trans: ' . $all_theme_mods['pureFolio_theme_color'] . '4f;
            --footer-txt-clr: ' . $footer_txt_color . ' !important;
            --footer-bg-clr: ' . $footer_bg_color . ' !important;
            --footer-bg-image: url(' . $all_theme_mods['footer_bg_image'] . ');
            --title-text-transform: ' . $title_case . ';
            --navbar-text-transform: ' . $navbar_case . ';
        }';
    
    // If custom background color is not set
    if ( !$all_theme_mods['background_color'] ) { 
        echo 'body { background-color: var(--body-bg-clr); }';
    }

    if (is_search()) {
        echo '.post-type {
            z-index: 1;
            position: absolute;
            background: var(--theme-clr);
            padding: 5px 10px;
            border-radius: calc(var(--round-conners) - 10px);
            left: 10px; top: 10px;
        }';
    }

    echo '</style>';
}
add_action('wp_head', 'internal_css');



// Internal CSS for sing page, and wp page
function single_page_internal_css()
{
    if (is_single() || is_page()) {
        global $all_theme_mods;

        $toggle_excerpt_italics  = $all_theme_mods['toggle_excerpt_italics']; // check if excerpt on single page is set to italics
        $excerpt_font_style = ($toggle_excerpt_italics == true) ? 'italic' : 'normal';

        $toggle_share_btns = $all_theme_mods['toggle_share_btns']; // Value to check if share button is enabled
        $pinterest = $all_theme_mods['toggle_pinterest_btn']; // Value to check if pinterest button is enabled
        $facebook = $all_theme_mods['toggle_facebook_btn']; // Value to check if facebook button is enabled
        $whatsapp = $all_theme_mods['toggle_whatsapp_btn']; // Value to check if whatsapp button is enabled
        $telegram = $all_theme_mods['toggle_telegram_btn']; // Value to check if telegram button is enabled
        $linkedin = $all_theme_mods['toggle_linkedin_btn']; // Value to check if linkedin button is enabled
        $x = $all_theme_mods['toggle_x_btn']; // Value to check if twitter button is enabled

        echo '<style>
            :root {
                --excerpt-font-style: ' . $excerpt_font_style . ';
            }';

        if ($toggle_share_btns == true) {
            echo '.social-share {
                gap: 10px;
                display: flex;
                flex-wrap: wrap;
                margin: 5px auto;
            }
            .social-share a {
                color: #fff;
                line-height: 0;
                border-radius: 5px;
                padding: 10px 15px;
                box-shadow: var(--shadow-large);
            }
            @media screen and (min-width:580px) {
                .social-share a {
                    padding: 10px 20px;
                } 
            }';

            if ($facebook == true) {
                echo '.facebook { background-color: #4267b2; }';
            }
            if ($x == true) {
                echo '.twitter { background-color: #1da1f2; }';
            }
            if ($whatsapp == true) {
                echo '.whatsapp { background-color: #25d366; }';
            }
            if ($pinterest == true) {
                echo '.pinterest { background-color: #e60023; }';
            }
            if ($telegram == true) {
                echo '.telegram { background-color: #0088cc; }';
            }
            if ($linkedin == true) {
                echo '.linkedin { background-color: #0072b1; }';
            }
        }

        echo '</style>';
    }
}
add_action('wp_head', 'single_page_internal_css');