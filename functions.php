<?php

/**
 * Pure Commerce functions and definitions
 *
 * @author Emmanuel Olowu 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package pure-commerce
 */


// Add Pure Commerce Theme Supports
require get_template_directory() . '/inc/functions/theme-setup.php';

// Generate Boxicons in JSON
require get_template_directory() . '/inc/functions/generate-json-icons.php';

// Helper Functions
require get_template_directory() . '/inc/functions/helper-functions.php';

// Utils Functions
require get_template_directory() . '/inc/functions/utils.php';

// Theme's Dynamic Internal CSS.
require get_template_directory() . '/inc/functions/internal-css.php';

// Enqueue Theme's CSS and JavaScripts.
require get_template_directory() . '/inc/functions/enqueues.php';

// LazyLoad Images.
require get_template_directory() . '/inc/functions/lazyload.php';

// Post Card Functions
require get_template_directory() . '/inc/functions/post-card-functions.php';

// Load Clarusmod Customizer
include_once get_template_directory() . '/inc/customizer/customizer.php';

// CUSTOM WP NAV
require get_template_directory() . '/inc/functions/custom-walker-nav.php';