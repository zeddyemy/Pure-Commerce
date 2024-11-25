<?php

/**
 * Customizer Custom Controls
 *
 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

if (class_exists('WP_Customize_Control')) {

    // custom section and control base class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-base-custom-control.php';

    // Toggle Switch custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-toggle-switch-custom-control.php';

    // TinyMCE custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-tinymce-custom-control.php';

    // Raw Text custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-raw-text-custom-control.php';

    // Divider custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-divider-custom-control.php';

    // URL custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-url-custom-control.php';

    // Text URL custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-txt-url-custom-control.php';
    
    // Select Category custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-category-select-custom-control.php';

    // Select Boxicon custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-boxicon-select-custom-control.php';

    // Searchable Select custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-searchable-select-custom-control.php';

    // Button Style custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-btn-style-custom-control.php';

    // Repeater custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-repeater-custom-control.php';

    // Numeric Input custom control class
    require_once trailingslashit(dirname(__FILE__)) . 'custom-controls/class-numeric-input-custom-control.php';


    // CUSTOM SANITIZE CALLBACKS
    require_once trailingslashit(dirname(__FILE__)) . 'custom-sanitize-callbacks.php';
}
