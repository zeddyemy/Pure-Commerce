<?php

// add no-hero class to body tag
function add_no_hero_body_class($classes)
{
    if (!is_front_page() && !is_home() && !is_page() && !is_singular('portfolios')) {
        $classes[] = 'no-hero';
    }
    return $classes;
}
add_filter('body_class', 'add_no_hero_body_class');

// global variable for body classes
global $pure_commerce_body_classes;
$pure_commerce_body_classes = array();