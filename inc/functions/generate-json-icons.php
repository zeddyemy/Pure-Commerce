<?php

/**
 * Generate JSON data of available icons and save it to a file.
 *
 * @return string JSON data of icon choices.
 */
function get_icons_choices_as_json() {
    // Get the list of available icons
    $icon_path = get_pure_commerce_assets('library/boxicons/css') . 'icon.classes.css';
    $icon_file = file_get_contents($icon_path);
    preg_match_all('/\.(bx[l|s]?)\-(.*?):before/', $icon_file, $matches);
    $prefixes = $matches[1];
    $icons = $matches[2];

    $icon_choices = array();

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

    // Sort the icon choices alphabetically
    uasort($icon_choices, function ($a, $b) {
        return strcasecmp($a, $b);
    });

    // JSON encode and return icon choices in JSON Format
    return json_encode($icon_choices, JSON_PRETTY_PRINT);
}


/**
 * Generate icons JSON file and save it.
 */
function generate_icons_jsonFile() {
    // Check if we are in the theme activation context
    if (isset($_GET['activated']) && $_GET['activated'] === 'true') {
        // Your JSON generation code here
        $json_data = get_icons_choices_as_json(true);
    
        // Define the file path where you want to save the JSON file
        $json_file_relative_path = '/assets/library/boxicons/json/icons.json';

        // Get the uploads directory path
        $theme_dir = get_theme_file_path();
    
        // Define the absolute server file path
        $json_file_path = $theme_dir . $json_file_relative_path;
    
        // Create the directory if it doesn't exist
        $json_dir = dirname($json_file_path);
        if (!file_exists($json_dir)) {
            mkdir($json_dir, 0755, true);
        }

        // Save the JSON data to the file
        $save_result = file_put_contents($json_file_path, $json_data);

        if ($save_result === false) {
            // Handle the error here, e.g., log it
            $error_message = error_get_last();
            error_log('Error saving JSON file: ==> '. $error_message['message']);
        }
    }
}

/**
 * Theme activation hook callback to generate icons JSON file.
 */
function theme_activation_hook() {
    generate_icons_jsonFile();
}
add_action('after_switch_theme', 'theme_activation_hook'); // Hook into the theme activation event