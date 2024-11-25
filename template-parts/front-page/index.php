<?php
/*
    Template part : Front Page
    Description : This Template Part Is Made Specifically For The Front Page.
    It Also Consists Of Other Template Parts That Brings About The Design And Looks Of The FrontPage.

    Template Parts :    1) hero Header template part
                        2) blog section template part

*/

global $all_theme_mods;

?>

<section class="wrapper col-12">
    <?php
        if ($all_theme_mods['toggle_hero_header_sec'] == true) {
            get_template_part('template-parts/front-page/hero-header', get_post_format());
        }

        get_template_part('template-parts/front-page/showcase-section', get_post_format());
    ?>
</section>