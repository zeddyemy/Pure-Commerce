<?php

class Clarusmod_Repeater_Custom_Control extends Clarusmod_Customize_Control
{

    // The type of control being rendered
    public $type = 'repeater';
    public $default_values = array();
    public $button_labels = array(); // Button labels
    public $input_type = 'text'; // Input Type
    public $placeholder = 'new'; // Input Placeholder
    public $is_sortable = false; // sortable flag

    // Constructor
    public function __construct($manager, $id, $args = array(), $options = array())
    {
        parent::__construct($manager, $id, $args);
        // Merge the passed button labels with our default labels
        $this->button_labels = wp_parse_args(
            $this->button_labels,
            array(
                'add' => __('Add', 'clarusmod'),
            )
        );
    }


    // Enqueue our scripts and styles
    public function enqueue()
    {
        wp_enqueue_script('clarusmod-custom-controls-js', $this->clarusmod_customizer_assets_url('js') . 'customizer-controls.js', array('jquery'), $this->clarusmodCustomCtrlsVersions['js'], true);
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    // render control
    public function render_content()
    {
        $default_values = explode(',', $this->value());
        $input_type = isset($this->input_type) ? esc_attr($this->input_type) : '';
        $placeholder = isset($this->placeholder) ? esc_attr($this->placeholder) : '';
        $sortable_class = $this->is_sortable ? 'sortable' : ''; ?>

        <div class="repeater-control">
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <?php if (!empty($this->description)) { ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php } ?>

            <input type="hidden" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($this->value()); ?>" class="customize-control-repeater" <?php $this->link(); ?> />
            <div class="theRepeater <?php echo esc_attr($sortable_class); ?>" data-input-type="<?php echo $input_type; ?>">
                <?php if (empty($default_values)) { ?>
                    <div class="repeater">
                        <input type="text" value="" class="repeater-input" placeholder="<?php echo $placeholder; ?>" />
                        <?php if ($this->is_sortable) : ?>
                            <span class="dashicons dashicons-sort"></span>
                        <?php endif; ?>
                        <a class="customize-control-repeater-delete" href="#"><span class="dashicons dashicons-trash-alt"></span></a>
                    </div>
                <?php } else {
                    foreach ($default_values as $value) { ?>
                        <div class="repeater">
                            <input type="text" value="<?php echo esc_attr($value); ?>" class="repeater-input" placeholder="<?php echo $placeholder; ?>" />
                            <?php if ($this->is_sortable) : ?>
                                <span class="dashicons dashicons-sort"></span>
                            <?php endif; ?>
                            <a class="customize-control-repeater-delete" href="#"><span class="dashicons dashicons-trash-alt"></span></a>
                        </div>
                    <?php } 
                } ?>
            </div>
            <p class="input-msg">Please type in a valid Url</p>
            <button class="button customize-control-repeater-add" type="button"><?php echo $this->button_labels['add']; ?></button>
        </div>
<?php }
}
