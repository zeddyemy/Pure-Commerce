<?php

// Customizer default values
if (!function_exists('clarusmod_customizer_default_vals')) {
    function clarusmod_customizer_default_vals() {
        // set the customizer values in here
        $default_vals = array(
            'toggle_switch'                 => 'true',
            'url_control'                   => 'myUrl.com',
            'raw_text_control'              => '',
            'tinymce_control'               => 'You can use this editor to add more rich text to your theme',
            'select_category_control'       => 0,
            'select_boxicon_control'        => 'none',
            'searchable_select_control'     => '',
            'btn_style_control'             => 'normal',
            'contact_sec_divider_ctrl1'     => '',
        );

        return apply_filters('clarusmod_customizer_default_vals', $default_vals);
    }
}

// Customizer assets url
if (!function_exists('clarusmod_customizer_assets')) {
    function clarusmod_customizer_assets($type = '') {
        $assetsPath = !empty($type) ? 'inc/clarusmod/assets/' . $type : 'inc/clarusmod/assets';

        $dirPath = wp_normalize_path(__DIR__);
        $pluginsDir = wp_normalize_path(WP_PLUGIN_DIR);

        if (strpos($dirPath, $pluginsDir) === 0) :
            // We're in a plugin directory and need to determine the url accordingly.
            $url = plugin_dir_url(__DIR__) . $assetsPath;
        else:
            $url = trailingslashit(get_template_directory_uri()) . $assetsPath;
        endif;

        return trailingslashit($url);
    }
}

// Get All Boxicons in form of an array
if (!function_exists('get_boxicons_choices')) {
    function get_boxicons_choices($include_none = false) {
        // Get the list of available icons
        $icon_path = clarusmod_customizer_assets('library/boxicons/css') . 'icon.classes.css';
        $icon_file = file_get_contents($icon_path);
        preg_match_all('/\.(bx[l|s]?)\-(.*?):before/', $icon_file, $matches);
        $prefixes = $matches[1];
        $icons = $matches[2];

        $icon_choices = array();
        if ($include_none) {
            $icon_choices['none'] = '&mdash; Select Icon &mdash;';
        }

        foreach ($icons as $index => $icon) {
            $prefix = $prefixes[$index];
            $name = ucwords(str_replace('-', ' ', $icon));
            if ($prefix === 'bxs') {
                $name .= ' Solid';
            } elseif ($prefix === 'bxl') {
                $name .= ' Logo';
            }
            $icon_choices['bx ' . $prefix . '-' . $icon] = $name;
        }
        // Sort the icon choices alphabetically while keeping "None" at the top
        uasort($icon_choices, function ($a, $b) {
            if ($a === '-- Select Icon --') {
                return -1;
            } elseif ($b === '-- Select Icon --') {
                return 1;
            } else {
                return strcasecmp($a, $b);
            }
        });

        return $icon_choices;
    }
    $select_icon_choices = get_boxicons_choices(true);
}