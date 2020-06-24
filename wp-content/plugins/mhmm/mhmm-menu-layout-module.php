<?php
class Mhmm_Menu_Layout_Module extends ET_Builder_Module {
    function init() {
        $this->name            = esc_html__( 'Mhmm - Mega Menu', 'et_builder' );
        $this->slug            = 'et_pb_mhmm_menu_layout';
        $this->fb_support      = true;
        $this->use_row_content = true;
        $this->decode_entities = true;
        $this->main_css_element = '%%order_class%%';

        $this->whitelisted_fields = array(
            'raw_content',
            'admin_label',
            'module_id',
            'module_class',
            'max_width',
            'max_width_tablet',
            'max_width_phone',
            'max_width_last_edited',
        );

        $this->custom_css_options = array(
            'nav' => array(
                'label'    => esc_html__( 'Navigation Container', 'et_builder' ),
                'selector' => '%%order_class%% nav',
            ),
            'menu_button' => array(
                'label'    => esc_html__( 'Menu Button', 'et_builder' ),
                'selector' => '%%order_class%% .menu-button',
            ),
            'menu_button_hover' => array(
                'label'    => esc_html__( 'Menu Button Hover', 'et_builder' ),
                'selector' => '%%order_class%% .menu-button:hover',
            ),
            'menu_button_text' => array(
                'label'    => esc_html__( 'Menu Button Text', 'et_builder' ),
                'selector' => '%%order_class%% .menu-button span',
            ),
            'menu_button_close' => array(
                'label'    => esc_html__( 'Close Menu Button', 'et_builder' ),
                'selector' => '%%order_class%% .menu-button-close',
            ),
            'menu_button_close_hover' => array(
                'label'    => esc_html__( 'Close Menu Button Hover', 'et_builder' ),
                'selector' => '%%order_class%% .menu-button-close:hover',
            )
        );

        // wptexturize is often incorrectly parsed single and double quotes
        // This disables wptexturize on this module
        add_filter( 'no_texturize_shortcodes', array( $this, 'disable_wptexturize' ) );
    }

    public function get_settings_modal_toggles() {
        return array(            
            'general'  => array(
                'toggles' => array(
                    'menu' => array(
                        'title' => esc_html__( 'Menu', 'et_builder' ),
                    )
                ),
            ),
            'advanced' => array(
                'toggles' => array(
                    'menu_button'   => array(
                        'title'    => esc_html__( 'Menu Button', 'et_builder' ),
                    ),
                    'background'   => array(
                        'title'    => esc_html__( 'Menu Background', 'et_builder' ),
                    )
                ),
            ),
            'custom_css' => array(
                'toggles' => array(
                    'visibility' => array(
                        'title' => esc_html__( 'Visibility', 'et_builder' )
                    )
                )
            )
        );
    }

    function get_fields() {
        $menuLayouts = get_posts(array(
            'post_type' => 'et_pb_layout',
            'tax_query' => array(
                array(
                    'taxonomy' => 'layout_category',
                    'field' => 'slug',
                    'terms' => 'mhmm_menus'
                )
            )
        ));
        $menuLayoutOptions = array();
        foreach($menuLayouts as $layout) {
            $menuLayoutOptions[$layout->ID] = $layout->post_title;
        }
        if(empty($menuLayoutOptions)) {
            $menuLayoutOptions[] = 'None available -- see below.';
        }
        
        $fields = array(
            'menu_layout' => array(
                'label'                 => esc_html__( 'Menu Layout', 'et_builder' ),
                'type'                  => 'select',
                'options'               => $menuLayoutOptions,
                'description'           => 'Choose which menu layout to use. You can add and update menu layouts <a href="/wp-admin/edit.php?s&post_status=all&post_type=et_pb_layout&layout_category=mhmm_menus" target="_blank">here</a>.',
                'toggle_slug'           => 'menu',
            ),
            'menu_button_color' => array(
                'label'             => esc_html__( 'Menu Button Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#333333',
                'description'       => esc_html__( 'Set a custom color for the menu button (hamburger icon).', 'et_builder' ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'menu_button'
            ),
            'menu_button_hover_color' => array(
                'label'             => esc_html__( 'Menu Button Hover Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#777777',
                'description'       => esc_html__( 'Set a custom color for the menu button (hamburger icon) when hovered.', 'et_builder' ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'menu_button'
            ),
            'menu_close_button_color' => array(
                'label'             => esc_html__( 'Menu Close Button Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#333333',
                'description'       => esc_html__( 'Set a custom color for the menu close button.', 'et_builder' ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'menu_button'
            ),
            'menu_close_button_hover_color' => array(
                'label'             => esc_html__( 'Menu Close Button Hover Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#777777',
                'description'       => esc_html__( 'Set a custom color for the menu close button when hovered.', 'et_builder' ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'menu_button'
            ),
            'menu_button_style' => array(
                'label'             => esc_html__( 'Menu Button Style', 'et_builder' ),
                'type'              => 'select',
                'options'         => array(
                    'rounded' => esc_html__( 'Rounded', 'et_builder' ),
                    'square'  => esc_html__( 'Square', 'et_builder' ),
                ),
                'description'       => esc_html__( 'Choose a style for the menu button (hamburger icon).', 'et_builder' ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'menu_button'
            ),
            'menu_button_alignment' => array(
                'label'             => esc_html__( 'Menu Button Alignment', 'et_builder' ),
                'type'              => 'select',
                'options'           => array(
                    'right' => 'Right',
                    'left' => 'Left',
                    'center' => 'Center',                    
                ),
                'description'       => esc_html__( 'Choose how the menu button should align within your column.', 'et_builder' ),
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'menu_button',
            ),
            'vertically_center_menu_button' => array(
                'label'             => esc_html__( 'Vertically Center Menu Button', 'et_builder' ),
                'type'              => 'yes_no_button',
                'option_category'   => 'configuration',
                'description'     => esc_html__( 'Enable to vertically center the menu button within this row on desktop (above 980px). Note: For best results, ensure that a second column exists within this row.', 'et_builder' ),
                'options'           => array(
                    'on'  => esc_html__( 'Yes', 'et_builder' ),
                    'off' => esc_html__( 'No', 'et_builder' ),
                ),
                'default'           => 'off',
                'tab_slug'          => 'advanced',
                'toggle_slug'       => 'menu_button'
            ),
            'menu_button_text' => array(
                'label'           => esc_html__( 'Menu Button Text', 'et_builder' ),
                'description'     => esc_html__( 'Add text to the side of the menu button.', 'et_builder' ),
                'type'            => 'text',
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'menu_button'
            ),
            'advanced_media_query' => array(
                'label'             => esc_html__( 'Use Advanced Media Query', 'et_builder' ),
                'type'              => 'yes_no_button',
                'option_category'   => 'configuration',
                'description'     => esc_html__( 'Enable to specify an exact pixel value at which to disable this module.', 'et_builder' ),
                'options'           => array(
                    'on'  => esc_html__( 'On', 'et_builder' ),
                    'off' => esc_html__( 'Off', 'et_builder' ),
                ),
                'default'           => 'off',
                'tab_slug'          => 'custom_css',
                'toggle_slug'       => 'visibility',
                'affects'           => array('advanced_media_query_direction', 'advanced_media_query_width')
            ),
            'advanced_media_query_direction' => array(
                'label'             => esc_html__( 'Disable Direction', 'et_builder' ),
                'type'              => 'select',
                'options'           => array(
                    'above' => 'Above',
                    'below' => 'Below',
                ),
                'tab_slug'          => 'custom_css',
                'toggle_slug'       => 'visibility',
                'depends_show_if'   => 'on'
            ),
            'advanced_media_query_width' => array(
                'label'           => esc_html__( 'Width', 'et_builder' ),
                'type'            => 'range',
                //'default'         => '5',
                'range_settings'  => array(
                    'min'  => '1',
                    'max'  => '2000',
                    'step' => '1',
                ),
                'default'           => '980px',
                'description'     => esc_html__( 'At what screen width should this module be disabled?', 'et_builder' ),
                'tab_slug'          => 'custom_css',
                'toggle_slug'       => 'visibility',
                'depends_show_if'   => 'on'
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

    function shortcode_callback($atts, $content = null, $function_name) {
        $module_order_class = ET_Builder_Element::add_module_order_class( '', $function_name );
        $module_order_class = trim($module_order_class);

        // Options
        $menu_layout                        = isset($atts['menu_layout']) ? $atts['menu_layout'] : '';
        $menu_button_color                  = isset($atts['menu_button_color']) ? $atts['menu_button_color'] : '';
        $menu_button_hover_color            = isset($atts['menu_button_hover_color']) ? $atts['menu_button_hover_color'] : '';
        $menu_close_button_color            = isset($atts['menu_close_button_color']) ? $atts['menu_close_button_color'] : '';
        $menu_close_button_hover_color      = isset($atts['menu_close_button_hover_color']) ? $atts['menu_close_button_hover_color'] : '';
        $menu_button_style                  = isset($atts['menu_button_style']) ? $atts['menu_button_style'] : '';
        $menu_button_alignment              = isset($atts['menu_button_alignment']) ? $atts['menu_button_alignment'] : '';
        $vertically_center_menu_button      = isset($atts['vertically_center_menu_button']) && $atts['vertically_center_menu_button'] == 'on' ? true : false;
        $menu_button_text                   = isset($atts['menu_button_text']) ? $atts['menu_button_text'] : false;
        $advanced_media_query               = isset($atts['advanced_media_query']) ? $atts['advanced_media_query'] : 'off';
        $advanced_media_query_direction     = isset($atts['advanced_media_query_direction']) ? $atts['advanced_media_query_direction'] : '';
        $advanced_media_query_width         = isset($atts['advanced_media_query_width']) ? $atts['advanced_media_query_width'] : '980px';
        $module_id                          = $this->shortcode_atts['module_id'];
        $module_class                       = $this->shortcode_atts['module_class'];

        if ( '' !== $menu_button_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% .menu-button:before, %%order_class%% .menu-button div, %%order_class%% .menu-button:after',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $menu_button_color
                ),
            ));
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% .menu-button span',
                'declaration' => sprintf(
                    'color: %1$s;',
                    $menu_button_color
                ),
            ));
        }

        if ( '' !== $menu_button_hover_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% .menu-button:hover:before, %%order_class%% .menu-button:hover div, %%order_class%% .menu-button:hover:after',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $menu_button_hover_color
                ),
            ));
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% .menu-button:hover span',
                'declaration' => sprintf(
                    'color: %1$s;',
                    $menu_button_hover_color
                ),
            ));
        }

        if ( '' !== $menu_close_button_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% .menu-button-close:before, %%order_class%% .menu-button-close:after, %%order_class%% .menu-button-close div',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $menu_close_button_color
                ),
            ));
        }

        if ( '' !== $menu_close_button_hover_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% .menu-button-close:hover:before, %%order_class%% .menu-button-close:hover:after, %%order_class%% .menu-button-close:hover div',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $menu_close_button_hover_color
                ),
            ));
        }

        if ( '' !== $menu_button_style && $menu_button_style == 'rounded' ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% .menu-button:before, %%order_class%% .menu-button:after, %%order_class%% .menu-button div, %%order_class%% .menu-button-close:before, %%order_class%% .menu-button-close:after, %%order_class%% .menu-button-close div',
                'declaration' => 'border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px;',
            ));
        }

        // Output
        $content = '';

        // Advanced media query
        if ( 'off' !== $advanced_media_query && '' !== $advanced_media_query_direction && '' !== $advanced_media_query_width ) {
            $advanced_media_query_width = (int) preg_replace("/[^0-9,.]/", "", $advanced_media_query_width);
            if($advanced_media_query_direction == 'above') {
                $advanced_media_query_width++;
            }
            else {
                $advanced_media_query_width--;
            }
            $advanced_media_query_width .= 'px';
            $content .= '<style>';
                $content .= '@media only screen and ( ' . ($advanced_media_query_direction == 'above' ? 'min-width: ' : 'max-width: ') . $advanced_media_query_width . ' ) {';
                    $content .= '.' . $module_order_class . ' {display: none;}';
                $content .= '}';
            $content .= '</style>';
        }

        $classes = array();
        $classes[] = 'menu-button-align-' . $menu_button_alignment;
        if($vertically_center_menu_button) {
            $classes[] = 'vertically-centered'; 
        }
        if($module_class != '') {
            $classes = array_merge($classes, explode(' ', $module_class));
        }
        if($menu_layout) {
            $menu_post = get_post($menu_layout);
            if($module_id != '') {
                $content .= '<div id="' . $module_id . '" class="et_pb_mhmm_menu_layout ' . $module_order_class . ' ' . implode(' ', $classes) . '">'; 
            }
            else {
                $content .= '<div class="et_pb_mhmm_menu_layout mhmm-preload ' . $module_order_class . ' ' . implode(' ', $classes) . '">'; 
            }
                if($menu_button_text) {
                    $content .= '<a class="menu-button" href="#mhmm-' . $menu_post->ID . '"><div></div><span>' . __($menu_button_text) . '</a>';
                }
                else {
                    $content .= '<a class="menu-button" href="#mhmm-' . $menu_post->ID . '"><div></div></a>';
                }
            $content .= '</div>';
        }
        return $content;
    }

    // Include Background field, but do not include Borders or Box Shadow fields
    public function get_advanced_fields_config() {
        return array(
            'borders' => false,
            'box_shadow' => false,
            'background' => array(
                'css' => array(
                    'main' => "{$this->main_css_element} nav",
                ),
                'settings' => array(
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'background',
                ),                
                'use_background_video' => false,
            )
        );
    }
}
new Mhmm_Menu_Layout_Module;
?>