<?php

global $all_theme_mods;

$posts_per_page = get_option('posts_per_page'); // get the number from wordpress settings
$paged = get_query_var('paged') ? get_query_var('paged') : 1; // get the current page number
$offset = ($paged - 1) * $posts_per_page;

$blog_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'offset' => $offset, // set the offset based on the current pages
));
?>

<section class="all-post">
    <?php if ($blog_query->have_posts()) : ?>

        <?php if ($all_theme_mods['toggle_blog_page_title']) : ?>
            <div class="all-post-title">
                <div class="title"> <?php echo $all_theme_mods['blog_page_title']; ?> </div>
            </div>
        <?php endif; ?>

        <article class="grid blog-cards">
            <?php

            while ($blog_query->have_posts()) : $blog_query->the_post();

                echo get_default_card();

            endwhile;
            ?>
        </article>

        <div class="pagination row flex-center">
            <?php echo paginate_links(array('total' => $blog_query->max_num_pages)); ?>
        </div>

    <?php else :

        get_template_part('template-parts/none', get_post_format()); // None template part

    endif;
    wp_reset_postdata(); ?>
</section>