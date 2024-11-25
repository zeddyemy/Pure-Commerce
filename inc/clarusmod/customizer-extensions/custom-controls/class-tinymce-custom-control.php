<?php

/**
 * Custom TinyMCE Control Class
 *
 * @author Zeddy Emmanuel <https://zeddyemy.github.io/>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

class Clarusmod_TinyMCE_Custom_control extends Clarusmod_Customize_Control
{
    // The type of control being rendered
    public $type = 'tinymce_editor';

    // Enqueue our scripts and styles
    public function enqueue()
    {
        wp_enqueue_script('clarusmod-custom-controls-js', $this->clarusmod_customizer_assets_url('js') . 'customizer-controls.js', array('jquery'), $this->clarusmodCustomCtrlsVersions['js'], true);
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
        wp_enqueue_editor();
    }

    // Pass our TinyMCE toolbar string to JavaScript
    public function to_json()
    {
        parent::to_json();
        $this->json['clarusmodtinymcetoolbar1'] = isset($this->input_attrs['toolbar1']) ? esc_attr($this->input_attrs['toolbar1']) : 'bold italic bullist numlist alignleft aligncenter alignright link';
        $this->json['clarusmodtinymcetoolbar2'] = isset($this->input_attrs['toolbar2']) ? esc_attr($this->input_attrs['toolbar2']) : '';
        $this->json['clarusmodmediabuttons'] = isset($this->input_attrs['mediaButtons']) && ($this->input_attrs['mediaButtons'] === true) ? true : false;
    }

    // Render the control in the customizer
    public function render_content()
    { ?>

        <div class="tinymce-control">
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) { ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php } ?>
            <textarea id="<?php echo esc_attr($this->id); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_html($this->value()); ?></textarea>
        </div>

<?php }
}
