<?php

class Clarusmod_Boxicon_Select_Custom_Control extends Clarusmod_Customize_Control {
    
    public $type = 'boxicon_select';

    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    public function render_content() {
        $selected_icon = $this->value();
        $icon_choices = get_boxicons_choices( true ); // true to include the "-- Select Icon --" option

        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php if ( ! empty( $this->description ) ) { ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>
            <select <?php $this->link(); ?>>
                <?php foreach ( $icon_choices as $value => $name ) { ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $selected_icon, $value ); ?>>
                        <?php echo esc_html( $name ); ?>
                    </option>
                <?php } ?>
            </select>
        </label>
        <?php
    }
}