<?php

class Btn_Style_Custom_Control extends Clarusmod_Customize_Control {

    // The type of control being rendered
    public $type = 'button_style';

    // Pre-built button styles
    private $prebuilt_styles = array(
        'normal'        => 'Normal',
        'ghost-normal'  => 'Ghost Normal',
        'rounded'       => 'Rounded',
        'ghost-rounded' => 'Ghost Rounded',
        'pill'          => 'Pill',
        'ghost-pill'    => 'Ghost Pill',
    );

    // Constructor with optional argument for allowed styles
    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);

        // Check if the 'allowed_styles' key exists in the $args array
        if (isset($args['allowed_styles']) && is_array($args['allowed_styles'])) {
            // Filter the pre-built styles based on the allowed_styles
            $this->prebuilt_styles = array_intersect_key($this->prebuilt_styles, array_flip($args['allowed_styles']));
        }

        $this->choices = $this->prebuilt_styles;
    }

    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    public function render_content() {
        $styles = $this->prebuilt_styles;
        $value = $this->value(); ?>

        <div class="btn_type_control">
            <label for="<?php echo esc_attr($this->id); ?>" class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </label>

            <?php if (!empty($this->description)) : ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>

            <div class="btn-style-options">
                <?php foreach ($styles as $style_value => $style_label) :
                    $selected = checked($value, $style_value, false); ?>
                    <label class="radio-button-label">
                        <input type="radio" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($style_value); ?>" <?php $this->link(); ?> <?php $selected; ?> />
                        <span class="btn-style-option <?php echo esc_html($style_value); ?>">
                            <?php echo esc_html($style_label); ?>
                        </span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    <?php
    }
}
