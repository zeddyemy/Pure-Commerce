<?php

// sanitization for radio
if (!function_exists('clarusmod_radio_sanitization')) {
    function clarusmod_radio_sanitization($input, $setting)
    {
        //get the list of possible radio box or select options
        $choices = $setting->manager->get_control($setting->id)->choices;

        if (array_key_exists($input, $choices)) {
            return $input;
        } else {
            return $setting->default;
        }
    }
}

// sanitization for URL
if (!function_exists('clarusmod_url_sanitization')) {
    function clarusmod_url_sanitization($input) {
        if (strpos($input, ',') !== false) {
            $input = explode(',', $input);
        }
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = esc_url_raw($value);
            }
            $input = implode(',', $input);
        } else {
            $input = esc_url_raw($input);
        }
        return $input;
    }
}

// sanitization for Toggle Switch
if (!function_exists('clarusmod_toggle_switch_sanitization')) {
    function clarusmod_toggle_switch_sanitization($input)
    {
        if (true === $input) {
            return 1;
        } else {
            return 0;
        }
    }
}

// sanitization for Text
if (!function_exists('clarusmod_text_sanitization')) {
    function clarusmod_text_sanitization($input)
    {
        if (strpos($input, ',') !== false) {
            $input = explode(',', $input);
        }
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = sanitize_text_field($value);
            }
            $input = implode(',', $input);
        } else {
            $input = sanitize_text_field($input);
        }
        return $input;
    }
}

// sanitization for Array
if (!function_exists('clarusmod_array_sanitization')) {
    function clarusmod_array_sanitization($input)
    {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = sanitize_text_field($value);
            }
        } else {
            $input = '';
        }
        return $input;
    }
}

// sanitization for Integer
if (!function_exists('clarusmod_integer_sanitization')) {
    function clarusmod_sanitize_integer($input)
    {
        return (int) $input;
    }
}

// sanitization for text and link
if (!function_exists('clarusmod_txt_url_sanitization')) {
    function clarusmod_txt_url_sanitization($value) {
        return array(
            'text' => sanitize_text_field($value['text']),
            'url'  => esc_url_raw($value['url']),
        );
    }
}