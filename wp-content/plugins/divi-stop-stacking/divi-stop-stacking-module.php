<?php
class Divi_Stop_Stacking_Module extends ET_Builder_Module {
    function init() {
        $this->name            = esc_html__( 'Stop Stacking', 'et_builder' );
        $this->slug            = 'et_pb_stop_stacking';
        $this->fb_support      = true;
        $this->use_row_content = true;
        $this->decode_entities = true;

        $this->whitelisted_fields = array(
            'level',
            'admin_label',
            'module_id',
            'module_class',
        );

        /*

        $this->options_toggles = array(
            'general'  => array(
                'toggles' => array(
                    'layout'     => esc_html__( 'Layout', 'et_builder' ),
                ),
            )
        );

        $this->advanced_options = array(
            'background' => array(),
        );
        */
    }

/*
    function get_fields() {
        $fields = array(
            'level' => array(
                'label'             => esc_html__( 'Level', 'et_builder' ),
                'type'              => 'select',
                'options'           => array(
                    'section' => esc_html__( 'Section', 'et_builder' ),
                    'row' => esc_html__( 'Row', 'et_builder' ),
                    'column' => esc_html__( 'Column', 'et_builder' )
                ),
                'description'       => esc_html__( 'Choose what level to place the overlay.', 'et_builder' ),
                'toggle_slug'     => 'layout',
            ),
            'disabled_on' => array(
                'label'           => esc_html__( 'Disable on', 'et_builder' ),
                'type'            => 'multiple_checkboxes',
                'options'         => array(
                    'phone'   => esc_html__( 'Phone', 'et_builder' ),
                    'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
                    'desktop' => esc_html__( 'Desktop', 'et_builder' ),
                ),
                'additional_att'  => 'disable_on',
                'option_category' => 'configuration',
                'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
                'tab_slug'        => 'custom_css',
                'toggle_slug'     => 'visibility',
            ),
            'admin_label' => array(
                'label'       => esc_html__( 'Admin Label', 'et_builder' ),
                'type'        => 'text',
                'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
                'toggle_slug' => 'admin_label',
            ),
            'module_id' => array(
                'label'           => esc_html__( 'CSS ID', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'toggle_slug'     => 'classes',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
            'module_class' => array(
                'label'           => esc_html__( 'CSS Class', 'et_builder' ),
                'type'            => 'text',
                'option_category' => 'configuration',
                'tab_slug'        => 'custom_css',
                'toggle_slug'     => 'classes',
                'option_class'    => 'et_pb_custom_css_regular',
            ),
        );
        return $fields;
    }
    */

    function shortcode_callback($atts, $content = null, $function_name) {
        $module_class = ET_Builder_Element::add_module_order_class( '', $function_name );
        $module_class = trim($module_class);
        return '<div class="divi-stop-stacking ' . $module_class . '"></div>';
    }
}
new Divi_Stop_Stacking_Module;
?>