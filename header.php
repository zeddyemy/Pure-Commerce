<?php

/**
 * The header for our theme
 *
 * @package pure-commerce
 */


global $all_theme_mods, $pure_commerce_body_classes;
$all_theme_mods = pure_commerce_theme_mods();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class( $pure_commerce_body_classes ); ?>>
    <header id="header">
        <div class="parent-container">
            <div class="header-box">
                <div class="logo">
                    <a href="<?php echo get_bloginfo('wpurl'); ?>">
                        <h1>
                            <?php echo "Commerce"; ?>
                        </h1>
                        <span class="tagline"><?php echo bloginfo('description'); ?></span>
                    </a>
                </div>

                <nav class=" nav nav-links">
                    <div class="nav-action-btns flex space-between">
                        <div class="action-btns flex flex-center">
                            <span class="search-btn ico-btn"> <i class='bx bx-search'></i> </span>
                            <span class="theme-btn ico-btn"> <i class='bx bxs-moon'></i> </span>
                        </div>
                        <span class="menu-close-btn ico-btn"> <i class='bx bx-x'></i> </span>
                    </div>
                    <?php
                    $menu_args = array(
                        'menu_class' => 'links',
                        'menu_id' => 'items',
                        'theme_location' => 'main-nav-menu',
                        'container' => 'div',
                        'container_class' => 'links',
                        'container_id' => 'items',
                    );
                    if (has_nav_menu('main-nav-menu')) {
                        $menu_args['menu_class'] = '';
                        $menu_args['menu_id'] = '';
                        $menu_args['walker'] = new Custom_Walker_Nav_Menu();
                    }
                    wp_nav_menu($menu_args);
                    ?>
                </nav>

                <div class="action-btns flex flex-center">
                    <span class="search-btn ico-btn"> <i class='bx bx-search'></i> </span>
                    <span class="theme-btn ico-btn"> <i class='bx bxs-moon'></i> </span>
                    <span class="menu-btn ico-btn btn"> <i class='bx bx-menu'></i> </span>
                </div>

                <div class="nav-overlay"></div>
            </div>
        </div>
    </header>