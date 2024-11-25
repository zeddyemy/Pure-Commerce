<?php

class Clarusmod_Category_Select_Custom_Control extends Clarusmod_Customize_Control {
    public $type = 'category_select';

    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    public function render_content() {

        $selected_category = $this->value();
        $args = array(
            'option_none_value' => '0',
            'show_option_none'  => __('&mdash; Select &mdash;'),
            'name'              => '_customize-dropdown-categories-' . $this->id,
            'id'                => '_customize-dropdown-categories-' . $this->id,
            'taxonomy'          => 'category',
            'orderby'           => 'name',
            'selected'          => $selected_category,
            'echo'              => 0,
        );
        $dropdown = wp_dropdown_categories($args);

        // Add in the data link parameter.
        $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown);
        
        $categories = get_categories();
        if (empty($categories)) {
            echo '<p>' . esc_html__('No categories found.', 'clarusmod') . '</p>';
            return;
        } 
        ?>
        
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) { ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php } ?>
            <?php echo $dropdown; ?>
        </label>
        <?php
    }
}
