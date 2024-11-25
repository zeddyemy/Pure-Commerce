<?php

/**
 * function that sets card structure of each Post Types such as,
 * service, portfolio or default post type. (POST CARD)
 * 
 * @author Emmanuel Olowu
 * @package pure-commerce
 */



// POST CARD FOR EACH DEFAULT POST TYPE
function get_default_card()
{ ?>

    <article class="card blog-card" data-aos="fade-up" data-aos-easing="ease-in-out-quart">
        <?php if (is_search()) {
            $post_type = (get_post_type() === 'portfolios') ? 'Portfolio' : ((get_post_type() === 'post') ? 'Blog' : '');
            if (!empty($post_type)) { ?>
                <span class="post-type"> <?php echo $post_type; ?> </span>
        <?php }
        }
        ?>
        <div class="fit-img card-img">
            <a href="<?php the_permalink() ?>" aria-label="<?php the_title() ?>" title="<?php the_title() ?>">
                <?php theme_post_thumb(); ?>
            </a>
        </div>
        <div class="overlay">
            <div class="card-body txt-shadow-drk">
                <h3 class="title">
                    <a href="<?php the_permalink() ?>" aria-label="<?php the_title() ?>" title="<?php the_title() ?>" rel="bookmark"><?php the_title(); ?> </a>
                </h3>
            </div>
        </div>
    </article>
<?php }
