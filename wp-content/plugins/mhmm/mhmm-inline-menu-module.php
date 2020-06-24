<?php
class Mhmm_Inline_Menu_Module extends ET_Builder_Module {
    function init() {
        $this->name            = esc_html__( 'Mhmm - Inline', 'et_builder' );
        $this->slug            = 'et_pb_mhmm_inline_menu';
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
            'menu_item_wrap' => array(
                'label'    => esc_html__( 'Menu Item Wrap', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li',
            ),
            'menu_item_anchor' => array(
                'label'    => esc_html__( 'Menu Item Anchor', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > a',
            ),
            'menu_item_anchor_hover' => array(
                'label'    => esc_html__( 'Menu Item Anchor Hover', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > a:hover, %%order_class%% nav > ul > li > a.mhmm-active-trigger',
            ),
            'menu_item_anchor_active' => array(
                'label'    => esc_html__( 'Active Menu Item Anchor', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li.current-menu-item > a',
            ),
            'submenu' => array(
                'label'    => esc_html__( 'Submenu', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul',
            ),
            'submenu_item_wrap' => array(
                'label'    => esc_html__( '2nd Tier Item Wrap', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li',
            ),
            'submenu_item_anchor' => array(
                'label'    => esc_html__( '2nd Tier Item Anchor', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li > a',
            ),
            'submenu_item_anchor_hover' => array(
                'label'    => esc_html__( '2nd Tier Item Anchor Hover', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li > a:hover, %%order_class%% nav > ul > li > ul > li > a.mhmm-active-trigger',
            ),
            'submenu_item_anchor_active' => array(
                'label'    => esc_html__( '2nd Tier Active Menu Item Anchor', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li.current-menu-item > a',
            ),
            'subsubmenu_item_wrap' => array(
                'label'    => esc_html__( '3rd Tier Item Wrap', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li > ul > li',
            ),
            'subsubmenu_item_anchor' => array(
                'label'    => esc_html__( '3rd Tier Item Anchor', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li > ul > li > a',
            ),
            'subsubmenu_item_anchor_hover' => array(
                'label'    => esc_html__( '3rd Tier Item Anchor Hover', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li > ul > li > a:hover, %%order_class%% nav > ul > li > ul > li > ul > li > a.mhmm-active-trigger'
            ),
            'subsubmenu_item_anchor_active' => array(
                'label'    => esc_html__( '3rd Tier Active Menu Item Anchor', 'et_builder' ),
                'selector' => '%%order_class%% nav > ul > li > ul > li > ul > li.current-menu-item',
            ),
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
                    'menu_item_color' => array(
                        'title' => esc_html__( 'Menu Item Color', 'et_builder' ),
                    ),
                    'submenu_item_color' => array(
                        'title' => esc_html__( 'Submenu Item Color', 'et_builder' ),
                    ),
                    'submenu_shadows' => array(
                        'title' => esc_html__( 'Submenu Shadows', 'et_builder' ),
                    ),
                    'custom_margin_padding'  => array(
                        'title'    => esc_html__( 'Menu Item Spacing', 'et_builder' ),
                    ),
                ),                
            ),
            'custom_css' => array(
                'toggles' => array(
                    'visibility' => esc_html__( 'Visibility', 'et_builder' )
                )
            )
        );
    }

    function get_fields() {
        $menuOptions = array();
        foreach(get_terms( 'nav_menu', array( 'hide_empty' => true )) as $menu) {
            $menuOptions[$menu->slug] = $menu->name;
        }
        
        $fields = array(
            'menu' => array(
                'label'                 => esc_html__( 'Menu', 'et_builder' ),
                'type'                  => 'select',
                'options'               => $menuOptions,
                'description'           => 'Choose which menu to use. You can add and update menus <a href="/wp-admin/nav-menus.php">here</a>.',
                'toggle_slug'           => 'menu',
            ),
            'menu_item_alignment' => array(
                'label'             => esc_html__( 'Menu Item Alignment', 'et_builder' ),
                'type'              => 'select',
                'options'           => array(
                    'right' => 'Right',
                    'left' => 'Left',
                    'center' => 'Center',                    
                ),
                'description'       => esc_html__( 'Choose how the menu items should align within your column.', 'et_builder' ),
                'toggle_slug'       => 'menu',
            ),
            'parent_icon' => array(
                'label'             => esc_html__( 'Show Icon on Parent Menu Items', 'et_builder' ),
                'type'              => 'yes_no_button',
                'description'     => esc_html__( 'Enable to show a down arrow icon next to menu items with child pages.', 'et_builder' ),
                'options'           => array(
                    'on'  => esc_html__( 'Yes', 'et_builder' ),
                    'off' => esc_html__( 'No', 'et_builder' ),
                ),
                'default'           => 'on',
                'toggle_slug'       => 'menu',
            ),
            'submenu_transition' => array(
                'label'             => esc_html__( 'Submenu Transition', 'et_builder' ),
                'type'              => 'select',
                'options'           => array(
                    'fade' => 'Fade',
                    'grow' => 'Grow',
                    'instant' => 'Instant',                    
                ),
                'description'       => esc_html__( 'Choose how the submenu should appear when parent items are hovered.', 'et_builder' ),
                'toggle_slug'       => 'menu',
            ),
            'menu_item_color' => array(
                'label'             => esc_html__( 'Menu Item Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#333333',
                'description'       => esc_html__( 'Set a custom color for menu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'menu_item_color',
            ),
            'menu_item_background_color' => array(
                'label'             => esc_html__( 'Menu Item Background Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => 'rgba(255,255,255,0)',
                'description'       => esc_html__( 'Set a custom background color for menu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'menu_item_color',
            ),
            'menu_item_hover_color' => array(
                'label'             => esc_html__( 'Menu Item Hover Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#777777',
                'description'       => esc_html__( 'Set a custom color for menu items on hover.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'menu_item_color',
            ),
            'menu_item_hover_background_color' => array(
                'label'             => esc_html__( 'Menu Item Hover Background Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => 'rgba(255,255,255,0)',
                'description'       => esc_html__( 'Set a custom background color for menu items on hover.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'menu_item_color',
            ),
            'menu_item_active_color' => array(
                'label'             => esc_html__( 'Active Menu Item Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#333333',
                'description'       => esc_html__( 'Set a custom color for active menu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'menu_item_color',
            ),
            'menu_item_active_background_color' => array(
                'label'             => esc_html__( 'Active Menu Item Background Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => 'rgba(255,255,255,0)',
                'description'       => esc_html__( 'Set a custom background color for active menu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'menu_item_color',
            ),
            'submenu_item_color' => array(
                'label'             => esc_html__( 'Submenu Item Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#333333',
                'description'       => esc_html__( 'Set a custom color for submenu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'submenu_item_color',
            ),
            'submenu_item_background_color' => array(
                'label'             => esc_html__( 'Submenu Item Background Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => 'rgba(255,255,255,0)',
                'description'       => esc_html__( 'Set a custom background color for submenu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'submenu_item_color',
            ),
            'submenu_item_hover_color' => array(
                'label'             => esc_html__( 'Submenu Item Hover Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#777777',
                'description'       => esc_html__( 'Set a custom color for submenu items on hover.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'submenu_item_color',
            ),
            'submenu_item_hover_background_color' => array(
                'label'             => esc_html__( 'Submenu Item Hover Background Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => 'rgba(255,255,255,0)',
                'description'       => esc_html__( 'Set a custom background color for submenu items on hover.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'submenu_item_color',
            ),
            'submenu_item_active_color' => array(
                'label'             => esc_html__( 'Active Submenu Item Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => '#333333',
                'description'       => esc_html__( 'Set a custom color for active submenu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'submenu_item_color',
            ),
            'submenu_item_active_background_color' => array(
                'label'             => esc_html__( 'Active Submenu Item Background Color', 'et_builder' ),
                'type'              => 'color-alpha',
                'custom_color'      => true,
                'default'           => 'rgba(255,255,255,0)',
                'description'       => esc_html__( 'Set a custom background color for active submenu items.', 'et_builder' ),
                'tab_slug'        => 'advanced',
                'toggle_slug'       => 'submenu_item_color',
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
        $menu                                   = $atts['menu'];
        $parent_icon                            = isset($atts['parent_icon']) ? $atts['parent_icon'] : 'on';
        $submenu_transition                     = isset($atts['submenu_transition']) ? $atts['submenu_transition'] : '';
        $menu_item_alignment                    = isset($atts['menu_item_alignment']) ? $atts['menu_item_alignment'] : '';
        $menu_item_color                        = isset($atts['menu_item_color']) ? $atts['menu_item_color'] : '';
        $menu_item_hover_color                  = isset($atts['menu_item_hover_color']) ? $atts['menu_item_hover_color'] : '';
        $menu_item_background_color             = isset($atts['menu_item_background_color']) ? $atts['menu_item_background_color'] : '';
        $menu_item_hover_background_color       = isset($atts['menu_item_hover_background_color']) ? $atts['menu_item_hover_background_color'] : '';
        $menu_item_active_color                 = isset($atts['menu_item_active_color']) ? $atts['menu_item_active_color'] : '';
        $menu_item_active_background_color		= isset($atts['menu_item_active_background_color']) ? $atts['menu_item_active_background_color'] : '';
        $submenu_item_color                     = isset($atts['submenu_item_color']) ? $atts['submenu_item_color'] : '';
        $submenu_item_hover_color               = isset($atts['submenu_item_hover_color']) ? $atts['submenu_item_hover_color'] : '';
        $submenu_item_background_color          = isset($atts['submenu_item_background_color']) ? $atts['submenu_item_background_color'] : '';
        $submenu_item_hover_background_color    = isset($atts['submenu_item_hover_background_color']) ? $atts['submenu_item_hover_background_color'] : '';
        $submenu_item_active_color              = isset($atts['submenu_item_active_color']) ? $atts['submenu_item_active_color'] : '';
        $submenu_item_active_background_color	= isset($atts['submenu_item_active_background_color']) ? $atts['submenu_item_active_background_color'] : '';
        $advanced_media_query                   = isset($atts['advanced_media_query']) ? $atts['advanced_media_query'] : 'off';
        $advanced_media_query_direction         = isset($atts['advanced_media_query_direction']) ? $atts['advanced_media_query_direction'] : '';
        $advanced_media_query_width             = isset($atts['advanced_media_query_width']) ? $atts['advanced_media_query_width'] : '980px';
        $module_id                              = $this->shortcode_atts['module_id'];
        $module_class                           = $this->shortcode_atts['module_class'];

        if ( '' !== $menu_item_alignment ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav > ul',
                'declaration' => sprintf(
                    'text-align: %1$s;',
                    $menu_item_alignment
                ),
            ));
        }

        if ( '' !== $menu_item_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav > ul > li > a',
                'declaration' => sprintf(
                    'color: %1$s;',
                    $menu_item_color
                ),
            ));
        }

        if ( '' !== $menu_item_background_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav > ul > li > a',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $menu_item_background_color
                ),
            ));
        }

        if ( '' !== $menu_item_hover_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav > ul > li > a:hover, %%order_class%% nav > ul > li > a.mhmm-active-trigger',
                'declaration' => sprintf(
                    'color: %1$s;',
                    $menu_item_hover_color
                ),
            ));
        }

        if ( '' !== $menu_item_hover_background_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav > ul > li > a:hover, %%order_class%% nav > ul > li > a.mhmm-active-trigger',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $menu_item_hover_background_color
                ),
            ));
        }

        if ( '' !== $menu_item_active_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav > ul > li.current-menu-item > a',
                'declaration' => sprintf(
                    'color: %1$s;',
                    $menu_item_active_color
                ),
            ));
        }

        if ( '' !== $menu_item_active_background_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav > ul > li.current-menu-item > a',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $menu_item_active_background_color
                ),
            ));
        }

        if ( '' !== $submenu_item_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav ul li ul li a',
                'declaration' => sprintf(
                    'color: %1$s !important;',
                    $submenu_item_color
                ),
            ));
        }

        if ( '' !== $submenu_item_background_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav ul li ul li a',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $submenu_item_background_color
                ),
            ));
        }

        if ( '' !== $submenu_item_hover_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav ul li ul li a:hover, %%order_class%% nav ul li ul li a.mhmm-active-trigger',
                'declaration' => sprintf(
                    'color: %1$s !important;',
                    $submenu_item_hover_color
                ),
            ));
        }

        if ( '' !== $submenu_item_hover_background_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav ul li ul li a:hover, %%order_class%% nav ul li ul li a.mhmm-active-trigger',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $submenu_item_hover_background_color
                ),
            ));
        }

        if ( '' !== $submenu_item_active_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav ul li ul li.current-menu-item a',
                'declaration' => sprintf(
                    'color: %1$s !important;',
                    $submenu_item_active_color
                ),
            ));
        }

        if ( '' !== $submenu_item_active_background_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector' => '%%order_class%% nav ul li ul li.current-menu-item a',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    $submenu_item_active_background_color
                ),
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
        if($module_class != '') {
            $classes = explode(' ', $module_class);
        }

        // WooCommerce Cart
        if(class_exists('WooCommerce') && WC()->cart) {
            $wc_data = 'data-cart-count="' . WC()->cart->get_cart_contents_count() . '"';
        }
        else {
            $wc_data = '';
        }
        
        if($module_id != '') {
            $content .= '<div id="' . $module_id . '" class="et_pb_mhmm_inline_menu ' . $module_order_class . ' ' . implode(' ', $classes) . '" ' . $wc_data . '>';
        }
        else {
            $content .= '<div class="et_pb_mhmm_inline_menu ' . $module_order_class . ' ' . implode(' ', $classes) . '" ' . $wc_data . '>';
        }
            $menu_args = array(
                'menu'            => $menu,
                'container'       => 'nav',
                'menu_class'      => 'menu',
                'menu_id'         => '',
                'echo'            => false,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => '',
            );
            if($parent_icon == 'on') {
                $menu_args['container_class'] = 'mhmm-inline-menu show-parent-icon transition-' . $submenu_transition;
            }
            else {
                $menu_args['container_class'] = 'mhmm-inline-menu transition-' . $submenu_transition;
            }
            $content .= wp_nav_menu($menu_args);
        $content .= '</div>';
        return $content;
    }

    // Include Fonts, Custom Margin/Padding and Box Shadow fields, but do do not include Background or Borders fields
    public function get_advanced_fields_config() {
        return array(
            'borders' => false,
            'background' => false,
            'fonts' => array(
                'menu_item' => array(
                    'label'    => esc_html__( 'Menu Item', 'et_builder' ),
                    'css'      => array(
                        'main' => "{$this->main_css_element} nav ul li a",
                    ),
                ),
                'sub_menu_item' => array(
                    'label'    => esc_html__( 'Submenu Item', 'et_builder' ),
                    'css'      => array(
                        'main' => "{$this->main_css_element} nav ul li ul li a",
                    ),
                )
            ),
            'custom_margin_padding' => array(
                'css' => array(
                    'padding' => '%%order_class%% nav > ul > li > a',
                    'margin' => '%%order_class%% nav > ul > li',
                ),
                'tab_slug' => 'advanced',
                'toggle_slug' => 'custom_margin_padding'
            ),
            'box_shadow' => array(
                'default' => array(
                    'css' => array(
                        'main' => '{$this->main_css_element} nav > ul > li > ul',
                    ),
                    'tab_slug' => 'advanced',
                    'toggle_slug' => 'submenu_shadows'
                ),
            ),
        );
    }
}
new Mhmm_Inline_Menu_Module;
?>