<?php

class Searchable_Select_Custom_Control extends Clarusmod_Customize_Control {

    // The type of control being rendered
    public $type = 'searchable_select';


    // Boolean for Type of Searchable select. If True the multiple select will be enabled. Default is false.
    private $multiselect = false;

    // Placeholder. Default value is "- Select -"
    private $placeholder = '&mdash; Select &mdash;';

    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct( $manager, $id, $args );
		// enable multiple select if multiselect attribute is passed
		if ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) :
			$this->multiselect = true;
        endif;
		// use specified placeholder if included
		if ( isset( $this->input_attrs['placeholder'] ) && $this->input_attrs['placeholder'] ) :
			$this->placeholder = $this->input_attrs['placeholder'];
        endif;
	}

    // Enqueue our scripts and styles
    public function enqueue() {
        wp_enqueue_script('clarusmod-select2-js', $this->clarusmod_customizer_assets_url('library') . 'select2/select2.min.js', array('jquery'), '4.0.13', true);
        wp_enqueue_style('clarusmod-select2-css', $this->clarusmod_customizer_assets_url('library') . 'select2/select2.min.css', array(), '4.0.13', 'all');

        wp_enqueue_script('clarusmod-custom-controls-js', $this->clarusmod_customizer_assets_url('js') . 'customizer-controls.js', array('jquery'), $this->clarusmodCustomCtrlsVersions['js'], true);
        wp_enqueue_style('clarusmod-custom-controls-css', $this->clarusmod_customizer_assets_url('css') . 'customizer-controls.css', array('clarusmod_customizer_css'), $this->clarusmodCustomCtrlsVersions['css'], 'all');
    }

    // render control
    public function render_content() {
        $defaultValue = $this->multiselect ? explode(',', $this->value()) : $this->value();
        $choices = $this->choices;
        ?>
        <div class="clarusmod_searchable_select_control">
            <label for="<?php echo esc_attr( $this->id ); ?>" class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
			</label>

            <?php if (!empty($this->description)) : ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" class="customize-ctrl-searchable-select" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> />
            
            <select name="select2-list-<?php echo ( $this->multiselect ? 'multi[]' : 'single' ); ?>" class="custom-searchable-select" data-placeholder="<?php echo $this->placeholder; ?>" <?php echo ( $this->multiselect ? 'multiple="multiple" ' : '' ); ?>>
                <?php
                if ( !$this->multiselect ) :
                    echo '<option></option>';
                endif;
                foreach ($choices as $option_value => $option_label ) :
                    if ( is_array( $option_label ) ) :
                        echo '<optgroup label="' . esc_attr($option_value) . '">';
                        foreach ( $option_label as $optgroupVal => $optgroupLabel ) {
                            if ($this->multiselect) :
                                echo '<option value="' . esc_attr($optgroupVal) . '" ' . (in_array(esc_attr($optgroupVal), $defaultValue) ? 'selected="selected"' : '') . '>' . esc_attr($optgroupLabel) . '</option>';
                            else :
                                echo '<option value="' . esc_attr($optgroupVal) . '" ' . selected(esc_attr($optgroupVal), $defaultValue, false)  . '>' . esc_attr($optgroupLabel) . '</option>';
                            endif;
                        }
                        echo '</optgroup>';
                    else:
                        if ($this->multiselect) :
                            echo '<option value="' . esc_attr($option_value) . '" ' . (in_array(esc_attr($option_value), $defaultValue) ? 'selected="selected"' : '') . '>' . esc_attr($option_label) . '</option>';
                        else :
                            echo '<option value="' . esc_attr($option_value) . '" ' . selected(esc_attr($option_value), $defaultValue, false)  . '>' . esc_attr($option_label) . '</option>';
                        endif;
                    endif;
                endforeach;
                ?>
            </select>
        </div>
        <?php
    }
}