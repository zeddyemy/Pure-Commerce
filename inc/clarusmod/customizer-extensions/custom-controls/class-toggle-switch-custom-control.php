<?php

/**
 * Custom Toggle Switch Control
 *
 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

class Clarusmod_Toggle_Switch_Custom_control extends Clarusmod_Customize_Control {
    
    // The control type being rendered/
    public $type = 'toggle_switch';

    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    // Render the control in the customizer
    public function render_content()
    { ?>

        <div class="toggle-switch-control">
            <div class="toggle-switch">
                <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); checked($this->value()); ?>>
                <label class="toggle-switch-label" for="<?php echo esc_attr($this->id); ?>">
                    <span class="toggle-switch-inner"></span>
                    <span class="toggle-switch-switch"></span>
                </label>
            </div>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) : ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
        </div>
<?php
    }
}
