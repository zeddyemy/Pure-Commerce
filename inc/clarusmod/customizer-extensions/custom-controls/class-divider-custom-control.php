<?php

/**
 * Custom Divider Control
 *
 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

class Clarusmod_Divider_Custom_Control extends Clarusmod_Customize_Control
{

    // The type of control being rendered
    public $type = 'simple_divider';


    // Define the available widths for the divider
    private $available_divider_widths = array("default", "full", "half");
    
    // Define the available types of divider
    private $available_divider_types = array(
        "solid",
        "dashed",
        "dotted",
        "double"
    );
    
    //Define the width of the divider. Either 'default', 'full', or 'half'. Default = 'default'
    private $dividerwidth = 'default';
    
    // Define the type of divider line. Either 'solid', 'dashed' or 'dotted'. Default = 'solid'
    private $dividertype = 'solid';
    
    //Define size of the top margin in px. Default = 20
    private $margintop = 20;
    
    //Define size of the top margin in px. Default = 20
    private $marginbottom = 20;

    
    // Constructor
    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct($manager, $id, $args);
        // Check the width of the divider
        if (isset($this->input_attrs['width'])) {
            if (in_array(strtolower($this->input_attrs['width']), $this->available_divider_widths, true) ) {
                $this->dividerwidth = strtolower($this->input_attrs['width']);
            }
        }
        // Check the type of divider
        if (isset($this->input_attrs['type'])) {
            if (in_array(strtolower($this->input_attrs['type']), $this->available_divider_types, true)) {
                $this->dividertype = strtolower($this->input_attrs['type']);
            }
        }
        // Check if the top margin is specified and valid. Will accept int and string values. i.e. 42 or '42'
        if (isset($this->input_attrs['margintop']) &&  is_numeric($this->input_attrs['margintop'])) {
            $this->margintop = abs((int)$this->input_attrs['margintop']);
        }
        // Check if the bottom margin is specified and valid. Will accept int and string values. i.e. 42 or '42'
        if (isset($this->input_attrs['marginbottom']) &&  is_numeric($this->input_attrs['marginbottom'])) {
            $this->marginbottom = abs((int)$this->input_attrs['marginbottom']);
        }
    }


    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    // Render the control in the customizer
    public function render_content() {
		?>
			<div class="simple-divider-custom-control simple-divider-type-<?php echo $this->dividertype; ?> simple-divider-width-<?php echo $this->dividerwidth; ?>" style="margin-top:<?php echo $this->margintop; ?>px;margin-bottom:<?php echo $this->marginbottom; ?>px"></div>
		<?php
	}
}
