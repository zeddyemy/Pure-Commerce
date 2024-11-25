<?php

class Clarusmod_Numeric_Input_Custom_Control extends Clarusmod_Customize_Control {
    public $type = 'numeric_input';


    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_script('clarusmod-custom-controls-js', $this->clarusmod_customizer_assets_url('js') . 'customizer-controls.js', array('jquery'), $this->clarusmodCustomCtrlsVersions['js'], true);
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    // render control
    public function render_content() {
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) : ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <input type="number" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->input_attrs(); ?> />
            
            <p class="input-msg"></p>
        </label>
        <?php
    }

}