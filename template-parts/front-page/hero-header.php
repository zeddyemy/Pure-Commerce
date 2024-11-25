<?php

global $all_theme_mods;
?>

<section id="hero-header" class="hero-header no-pad fit-img" style="background-image: url('<?php echo $all_theme_mods['hero_header_sec_img']; ?>');">
    <div class="parent-container">
        <div class="slide flex flex-center">
            <div class="hero-header-content flex flex-center" data-aos="fade-up" data-aos-easing="ease-in-out-quart">
                <h1> <?php echo $all_theme_mods['hero_header_sec_title']; ?> </h1>

                <?php if (!empty($all_theme_mods['hero_header_sec_subtext'])) { ?>
                    <p> <?php echo $all_theme_mods['hero_header_sec_subtext']; ?> </p>
                <?php }

                if ($all_theme_mods['toggle_hero_header_sec_btn'] == true) {
                    pure_commerce_render_btn($all_theme_mods['hero_header_sec_btn_text'], $all_theme_mods['hero_header_sec_btn_url']);
                } ?>
            </div>
        </div>
    </div>
    <a href="#about" class="mouse smoothscroll" data-scrollto="about" aria-label="Explore our site">
        <span class="mouse-icon">
            <span class="mouse-wheel"></span>
        </span>
    </a>
</section>