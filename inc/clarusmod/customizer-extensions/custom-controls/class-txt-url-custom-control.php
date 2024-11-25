<?php

/**
 * Custom Text Link Control
 *
 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

class Clarusmod_Txt_Url_Custom_Control extends Clarusmod_Customize_Control
{

    public $type = 'text_url';

    // Enqueue custom styles if necessary
    public function enqueue() {
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    public function render_content() {
        $value = $this->value();
        $text_value = isset($this->settings['text']) ? esc_html($this->settings['text']->value()) : '';
        $url_value = isset($this->settings['url']) ? esc_url_raw($this->settings['url']->value()) : '';

        $text = esc_attr($value['text'] ?? '');
        $url = esc_url_raw($value['url'] ?? '');
        ?>

        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <?php if (!empty($this->description)) : ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>

            <input type="text" class="customize-txt-url-t-input" placeholder="Link Text" <?php $this->link('text'); ?> value="<?php echo esc_attr($text_value); ?>" />
            <input type="url" class="customize-txt-url-u-input" placeholder="https://" <?php $this->link('url'); ?> value="<?php echo esc_attr($url_value); ?>" />

            <p class="input-msg">Enter a text and a valid URL</p>
        </label>
        <?php
    }
}
