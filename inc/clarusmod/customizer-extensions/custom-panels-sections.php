<?php

/**
 * Clarusmod Extend Customizer panel and Customizer Section
 *
 * @author Emmanuel Zeddy <http://zeddyemy.github.io>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */


if (class_exists('WP_Customize_Panel')) {

    /**
     * Extend Customizer panel
     */

    class Clarusmod_Customize_Panel extends WP_Customize_Panel {
        public $panel;
        public $type = 'pe_panel';
        public function json() {
            $array = wp_array_slice_assoc((array) $this, array('id', 'description', 'priority', 'type', 'panel',));
            $array['title'] = html_entity_decode($this->title, ENT_QUOTES, get_bloginfo('charset'));
            $array['content'] = $this->get_content();
            $array['active'] = $this->active();
            $array['instanceNumber'] = $this->instance_number;

            return $array;
        }
    }
}

if (class_exists('WP_Customize_Section')) {
    // Extend Customizer Section

    class Clarusmod_Customize_Section extends WP_Customize_Section {
        public $section;
        public $type = 'pe_section';
        public function json() {
            $array = wp_array_slice_assoc((array) $this, array('id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section',));
            $array['title'] = html_entity_decode($this->title, ENT_QUOTES, get_bloginfo('charset'));
            $array['content'] = $this->get_content();
            $array['active'] = $this->active();
            $array['instanceNumber'] = $this->instance_number;

            if ($this->panel) {
                $array['customizeAction'] = sprintf('Customizing &#9656; %s', esc_html($this->manager->get_panel($this->panel)->title));
            } else {
                $array['customizeAction'] = 'Customizing';
            }

            return $array;
        }
    }
}

// ENQUEUE SCRIPTS TO EXTEND CUSTOMIZER PANEL AND SECTION
function clarusmod_customize_controls_scripts() {
    // Enqueue the customizer controls script
    wp_enqueue_script('customizer-panels', clarusmod_customizer_assets('js') . 'customizer-panels-sections.js', array('jquery'), '1.0', true);
}
add_action('customize_controls_enqueue_scripts', 'clarusmod_customize_controls_scripts');

// css for customizer
function clarusmod_customizer_styles() {
    wp_enqueue_style('clarusmod_customizer_css', clarusmod_customizer_assets('css') . 'customizer.css', array(), '1.0', 'all', 10);
}
add_action('customize_controls_print_styles', 'clarusmod_customizer_styles');
