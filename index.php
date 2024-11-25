<?php

/**
 * The main template file
 *
 * @package pure-commerce
 */


get_header();

get_template_part('template-parts/blog-page/index', get_post_format());

get_footer();