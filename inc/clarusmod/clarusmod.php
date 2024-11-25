<?php

/**
 * Clarusmod Customizer
 *
 * @author Emmanuel Zeddy <http://zeddyemy.github.io>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

class initialize_clarusmod_customizer_settings {

    private $defaults;
    private $panels_path;

    public function __construct($panels_path) {
        // Get our Customizer defaults
		$this->defaults = clarusmod_customizer_default_vals();
        $this->panels_path = $panels_path;

        add_action('customize_register', array($this, 'clarusmod_register_customizer'));
    }
    
    // register Customizer
    function clarusmod_register_customizer($wp_customize) {
        // Has to be at the top //
        $wp_customize->register_panel_type('Clarusmod_Customize_Panel');
        $wp_customize->register_section_type('Clarusmod_Customize_Section');

        // Theme Panel
        include_once $this->panels_path;
    }
}

include_once trailingslashit(dirname(__FILE__)) . 'customizer-extensions/clarusmod_functions.php';
include_once trailingslashit(dirname(__FILE__)) . 'customizer-extensions/custom-panels-sections.php';
include_once trailingslashit(dirname(__FILE__)) . 'customizer-extensions/custom-controls.php';