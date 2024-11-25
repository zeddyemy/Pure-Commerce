<?php
/*
    Template part : Blog Page
    Description : This Template Part Is Made Specifically To Display All Blog Post.
    It Also Consists Of Other Template Parts That Brings About The Design And Looks Of The FrontPage.

    Template Parts :    1) none template part
                        2) sidebar

*/

global $all_theme_mods;
$main_sec_width = ($all_theme_mods['toggle_blog_sidebar'] == true) ? 'col-8' : 'col-12';

?>

<section class="wrapper blog-page col-12 flex layout">
    <div class="parent-container">
        <section class=" <?php echo $main_sec_width; ?> main">
            <?php
            // blog template part
            get_template_part('template-parts/blog-page/blog-post', get_post_format());
            ?>
        </section>
    
        <?php if ($all_theme_mods['toggle_blog_sidebar']) { ?>
            <section class="col-4 side">
                <?php
                get_sidebar(); // The Side Bar. 
                ?>
            </section>
        <?php } ?>
    </div>
</section>