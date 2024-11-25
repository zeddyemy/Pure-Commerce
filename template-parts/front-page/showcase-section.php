<?php

global $all_theme_mods;
?>

<section id="showcase" class="showcase">
    <div class="parent-container">
        <div class="main col-9">
            <?php
            if (function_exists('wc_get_products')) :
                // WooCommerce is installed and active -->

                // Define your product categories
                $product_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'orderby' => 'name',
                ));

                foreach ($product_categories as $category) :
                    // Fetch products for the current category
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 5,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => $category->slug,
                            ),
                        ),
                    );
                    $products = new WP_Query($args)

                    ?>

                    <section class="product-cat-section">
                        <h2><?php echo $category->name; ?></h2>

                        <div class="product grid">
                            <?php if ($products->have_posts()) : ?>
                                <?php while ($products->have_posts()) : $products->the_post(); ?>
                                    <div class="product">
                                        <?php wc_get_template_part('content', 'product'); ?>
                                    </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p>No products found in this category.</p>
                            <?php endif; ?>
                        </div>
                        <a class="view-more" href="<?php echo get_term_link($category); ?>">View More</a>
                    </section>

                <?php endforeach; ?>

            <?php endif; ?>



        </div>

        <div class="side col-3">

            <?php

            // sidebar template part
            get_sidebar();

            ?>
        </div>
    </div>
</section>