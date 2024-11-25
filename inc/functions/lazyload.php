<?php

/**
 * Enable lazy loading
 *
 * @author Emmanuel Olowu
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package pure-commerce
 */

// Modify Default HTML structure for post thumbnail
function modify_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    global $all_theme_mods;
    $id = get_post_thumbnail_id(); // gets the id of the current post_thumbnail (in the loop)
    $src = wp_get_attachment_image_src($id, $size); // gets the image url specific to the passed in size (aka. custom image size)
    $alt = get_the_title($id); // gets the post thumbnail title
    $class = $attr['class']; // gets classes passed to the post thumbnail, defined here for easier function access

    if($all_theme_mods['placeholder_img']) {
        $placeholder = $all_theme_mods['placeholder_img'];
    }else {
        $placeholder = get_pure_commerce_assets('img') . 'placeholder.jpg';
    }

    // Check to see if a 'lazyload' class exists in the array when calling "the_post_thumbnail()", if so output different <img/> html
    if (strpos($class, 'lazyload') !== false) {
        $html = '<img alt="' . $alt . '" src="'. $placeholder .'" class="' . $class . '" data-src="' . $src[0] . '" data-alt="' . $alt . '" />';
    } else {
        $html = '<img src="' . $src[0] . '" alt="' . $alt . '" class="' . $class . '" />';
    }

    return $html;
}
add_filter('post_thumbnail_html', 'modify_post_thumbnail_html', 99, 5);


function lazyload_scripts() {
	wp_enqueue_script('lazysizes', get_pure_commerce_assets('library/lazysizes').'lazysizes.min.5.3.0.js');
}
add_action( 'wp_enqueue_scripts', 'lazyload_scripts' );
