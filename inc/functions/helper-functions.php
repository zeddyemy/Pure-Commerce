<?php

/**
 * pure_commerce Helper functions
 *
 * @author Emmanuel Olowu
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package pure-commerce
 */


// FUNCTION TO FETCH POST THUMBNAIL
function theme_post_thumb($class = '') {
    
    global $all_theme_mods;
    $id = get_post_thumbnail_id(); // gets the id of the current post_thumbnail (in the loop)
    $alt = get_the_title($id); // gets the post thumbnail title
    $user_img_placeholder = $all_theme_mods['placeholder_img'];
    $default_img_placeholder = get_template_directory_uri() . '/assets/img/placeholder.jpg';

    if ( has_post_thumbnail() ) {
        the_post_thumbnail('small-thumbnail', array('class' => 'lazyload ' . $class));
    }
    else { 
        $src = $user_img_placeholder ? $user_img_placeholder : $default_img_placeholder;
        echo '<img class="lazyload" src="' . $src . '" data-src="' . $src . '" alt="' . $alt . '" />';
    }
}


// FUNCTION FOR COPYRIGHT DATE IN FOOTER
function pure_commerce_copyright()
{
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
		SELECT
		YEAR(min(post_date_gmt)) AS firstdate,
		YEAR(max(post_date_gmt)) AS lastdate
		FROM
		$wpdb->posts
		WHERE
		post_status = 'publish'
		");
    $output = '';

    if ($copyright_dates) {
        $copyright = "&copy; " . $copyright_dates[0]->firstdate;
        if ($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= '-' . $copyright_dates[0]->lastdate;
        }
        $output = '<p>' . $copyright . ' ' . get_bloginfo('name') . ' | All Rights Reserved. </p>';
    }
    return $output;
}

// Format URL To Make Sure It Has "https://"
function pure_commerce_format_url($url)
{
    // Check if the URL starts with "http://" or "https://"
    if (! empty($url) && ! preg_match('/^https?:\/\//i', $url)) :
        $url = 'https://' . $url;
    endif;

    return esc_url($url);
}

// FUNCTION TO DISPLAY A LINK TO THEME AUTHOR'S PAGE
function pure_commerce_author_url($url, $name)
{
    $url = pure_commerce_format_url($url);

    return '<div class="theme-author-link">' .
        sprintf(
            esc_html__('Designed by: %s', 'pure-commerce'),
            '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" title="' . esc_attr__($name, 'pure-commerce') . '">' . esc_html__($name, 'pure-commerce') . '</a>'
        ) . '</div>';
}

function the_wp_link()
{
    return '<div class="wp-link">' .
        sprintf(
            esc_html__('Proudly Powered by: %s', 'pure-commerce'),
            '<a href="' . esc_url('http://wordpress.org/') . '" target="_blank" rel="noopener noreferrer" title="' . esc_attr__('WordPress', 'pure-commerce') . '">' . esc_html__('WordPress', 'pure-commerce') . '</a>'
        ) . '</div>';
}

// Theme's assets url
function get_pure_commerce_assets($type = '')
{
    $assetsPath = !empty($type) ? 'assets/' . $type : 'assets';
    $url = trailingslashit(get_template_directory_uri()) . $assetsPath;

    return trailingslashit($url);
}

// Function to render a button
function pure_commerce_render_btn($btn_txt = 'Button', $url = '#', $class = '')
{
    global $all_theme_mods;
    $class = $all_theme_mods['button_style'] . ' ' . $class;
    echo '<a href="' . esc_url($url) . '">
            <span class="btn ' . esc_attr($class) . '">' . esc_html($btn_txt) . '</span>
        </a>';
}


function create_and_set_pages()
{
    // Check if the front page and blog page are already set
    $front_page_id = get_option('page_on_front');
    $blog_page_id = get_option('page_for_posts');

    // Create front page if it doesn't exist
    if (!$front_page_id) {
        $front_page = array(
            'post_title'    => 'Home',
            'post_content'  => 'This is your front page content. You can edit it in the page editor.',
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );
        $front_page_id = wp_insert_post($front_page);
        update_post_meta($front_page_id, '_wp_page_template', 'front-page.php');
    }

    // Create blog page if it doesn't exist
    if (!$blog_page_id) {
        $blog_page = array(
            'post_title'    => 'Blog',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );
        $blog_page_id = wp_insert_post($blog_page);
    }

    // Set the front page and blog page
    update_option('page_on_front', $front_page_id);
    update_option('page_for_posts', $blog_page_id);
    update_option('show_on_front', 'page');
}
