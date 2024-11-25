<?php

/**
 * Custom Control Base Class
 *
 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

class Clarusmod_Url_Custom_Control extends Clarusmod_Customize_Control
{

    // The type of control being rendered
    public $type = 'url';

    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    // Render the control in the customizer
    public function render_content() {
        $url_value = esc_url_raw($this->value());
        $url_value = !empty($url_value) ? $url_value : 'https://';

    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) : ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            <div class="prefix-input">
                <span class="prefix-input-addon">https://</span>
                <input type="url" class="prefixed" <?php $this->link(); ?> value="<?php echo esc_attr($url_value); ?>" <?php $this->input_attrs(); ?> />
            </div>
            <p class="input-msg">Please type in a valid Url</p>
        </label>
    <?php
    }

    // Add additional validation for the input value
    public function validate( $value ) {
        $url = esc_url_raw( $value );
        if ( ! empty( $url ) ) :
            return $url;
        else :
            return '';
        endif;
    }

    // Helper function to check if the URL is invalid
    private function is_url_invalid( $url ) {
        return ( ! empty( $url ) && ! wp_http_validate_url( $url ) );
    }
}
