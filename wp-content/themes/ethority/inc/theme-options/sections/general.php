<?php
// Fields for typography
function filter_typography_fields( $array, $field_id ) {

   if ( $field_id == "demo_typography" ) {
      $array = array( 'font-family', 'font-size', 'font-weight', 'letter-spacing', 'line-height');
   }

   return $array;

}
add_filter( 'ot_recognized_typography_fields', 'filter_typography_fields', 10, 2 );


/**
 * Initialize the custom Theme Options.
 */
add_action( 'admin_init', 'ethority_theme_options' );
/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.0
 */
function ethority_theme_options() {
  /**
  *  Animation options through animate.css
  */
  $animate_css = array(
    array('value'   => 'none',              'label' => 'none'),
    array('value'   => 'bounce',            'label' => 'bounce'),
    array('value'   => 'flash',             'label' => 'flash'),
    array('value'   => 'pulse',             'label' => 'pulse'),
    array('value'   => 'shake',             'label' => 'shake'),
    array('value'   => 'swing',             'label' => 'swing'),
    array('value'   => 'tada',              'label' => 'tada'),
    array('value'   => 'wobble',            'label' => 'wobble'),

    array('value'   => 'bounceIn',          'label' => 'bounceIn'),
    array('value'   => 'bounceInDown',      'label' => 'bounceInDown'),
    array('value'   => 'bounceInUp',        'label' => 'bounceInUp'),
    array('value'   => 'bounceInLeft',      'label' => 'bounceInLeft'),
    array('value'   => 'bounceInRight',     'label' => 'bounceInRight'),


    array('value'   => 'fadeIn',            'label' => 'fadeIn'),
    array('value'   => 'fadeInUp',          'label' => 'fadeInUp'),
    array('value'   => 'fadeInDown',        'label' => 'fadeInDown'),
    array('value'   => 'fadeInLeft',        'label' => 'fadeInLeft'),
    array('value'   => 'fadeInRight',       'label' => 'fadeInRight'),
    array('value'   => 'fadeInUpBig',       'label' => 'fadeInUpBig'),
    array('value'   => 'fadeInDownBig',     'label' => 'fadeInDownBig'),
    array('value'   => 'fadeInLeftBig',     'label' => 'fadeInLeftBig'),
    array('value'   => 'fadeInRightBig',    'label' => 'fadeInRightBig'),

    array('value'   => 'flip',              'label' => 'flip'),
    array('value'   => 'flipInX',           'label' => 'flipInX'),
    array('value'   => 'flipInY',           'label' => 'flipInY'),

    array('value'   => 'lightSpeedin',      'label' => 'lightSpeedin'),

    array('value'   => 'rotateIn',          'label' => 'rotateIn'),
    array('value'   => 'rotateInDownLeft',  'label' => 'rotateInDownLeft'),
    array('value'   => 'rotateInDownRight', 'label' => 'rotateInDownRight'),
    array('value'   => 'rotateInUpLeft',    'label' => 'rotateInUpLeft'),
    array('value'   => 'rotateInUpRight',   'label' => 'rotateInUpRight'),

    array('value'   => 'slideInUp',         'label' => 'slideInUp'),
    array('value'   => 'slideInDown',       'label' => 'slideInDown'),
    array('value'   => 'slideInLeft',       'label' => 'slideInLeft'),
    array('value'   => 'slideInRight',      'label' => 'slideInRight'),

    array('value'   => 'rollIn',            'label' => 'rollIn')
  );


  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( ot_settings_id(), array() );

  /**
   * Custom settings array that will eventually be
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array(
  /**


    ======================
    Ethority Main Settings
    ======================


  */

    /**

      'Help' (button at the top right) Admin Toolbar

    */
    'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'option_types_help',
          'title'     => __( 'Option Types', 'eth-theme' ),
          'content'   => '<p>' . __( 'Help content goes here!', 'eth-theme' ) . '</p>'
        )
      ),
      'sidebar'       => '<p>' . __( 'Sidebar content goes here!', 'eth-theme' ) . '</p>'
    ),


    /**


      Settings Sections


    */
    'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => __( 'General', 'eth-theme' )
      ),
      array(
        'id'          => 'home',
        'title'       => __( 'Home', 'eth-theme' )
      ),
      array(
        'id'          => 'reviews',
        'title'       => __( 'Reviews', 'eth-theme' )
      ),
      array(
        'id'          => 'features',
        'title'       => __( 'Features', 'eth-theme' )
      ),
      array(
        'id'          => 'overview',
        'title'       => __( 'Overview', 'eth-theme' )
      ),
      array(
        'id'          => 'cta',
        'title'       => __( 'Call to Action', 'eth-theme' )
      ),
      array(
        'id'          => 'testimonials',
        'title'       => __( 'Testimonials', 'eth-theme' )
      ),
      array(
        'id'          => 'author',
        'title'       => __( 'Author', 'eth-theme' )
      ),
      array(
        'id'          => 'pricetable',
        'title'       => __( 'Price Table', 'eth-theme' )
      ),
      array(
        'id'          => 'contact',
        'title'       => __( 'Contact', 'eth-theme' )
      ),
      array(
        'id'          => 'footer',
        'title'       => __( 'Footer', 'eth-theme' )
      ),
    ),
    /**


      Settings


    */
    'settings'        => array(
      /**

      General Settings

      */
      array(
        'id'          => 'eth_logo',
        'label'       => __( 'Site Logo', 'eth-theme' ),
        'desc'        => __( 'Upload your logo. (<strong>Recommended: 140x60</strong>)', 'eth-theme' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_favicon',
        'label'       => __( 'Site Favicon', 'eth-theme' ),
        'desc'        => __( 'Upload your favicon. (<strong>16x16</strong>)', 'eth-theme' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_accent_color',
        'label'       => __( 'Accent Color', 'eth-theme' ),
        'desc'        => __( 'Choose the accent color for this theme', 'eth-theme' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_disable_animation_mobile',
        'label'       => __( 'Disable animations on when viewed on mobile.', 'eth-theme' ),
        'desc'        => __( '', 'eth-theme' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'disable',
            'label'       => __( 'disable', 'eth-theme' ),
            'src'         => ''
          ),
          array(
            'value'       => 'enable',
            'label'       => __( 'enable', 'eth-theme' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'eth_google_analytics',
        'label'       => __( 'Google Analytics', 'eth-theme' ),
        'desc'        => __( 'Copy and paste your tracking code here.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_google_analytics_insert',
        'label'       => __( '', 'eth-theme' ),
        'desc'        => __( 'Insert google anayltics code in <code>header</code> or <code>footer</code>.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'header',
            'label'       => __( 'Header', 'eth-theme' ),
            'src'         => ''
          ),
          array(
            'value'       => 'footer',
            'label'       => __( 'Footer', 'eth-theme' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'eth_custom_css',
        'label'       => __( 'Custom CSS and JS', 'eth-theme' ),
        'desc'        => __( 'You can add your own custom CSS styling here.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_custom_js',
        'label'       => '',
        'desc'        => __( 'You can add your own custom JS script here.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_lp_layout',
        'label'       => __( 'Landing Page Sections', 'appster' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_lp_section',
            'label'       => __( 'Section', 'appster' ),
            'desc'        => __( 'Select a section', 'appster'),
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => array(
              array(
              'value'       => 'section-home',
              'label'       => __( 'Home Section', 'appster' )
              ),
              array(
              'value'       => 'section-reviews',
              'label'       => __( 'Reviews Section', 'appster' )
              ),
              array(
              'value'       => 'section-author',
              'label'       => __( 'Author Section', 'appster' )
              ),
              array(
              'value'       => 'section-features',
              'label'       => __( 'Features Section', 'appster' )
              ),
              array(
              'value'       => 'section-overview',
              'label'       => __( 'Overview Section', 'appster' )
              ),
              array(
              'value'       => 'section-cta',
              'label'       => __( 'Call to Action Section', 'appster' )
              ),
              array(
              'value'       => 'section-testimonials',
              'label'       => __( 'Testimonials Section', 'appster' )
              ),
              array(
              'value'       => 'section-purchase',
              'label'       => __( 'Purchase Section', 'appster' )
              ),
              array(
              'value'       => 'section-contact',
              'label'       => __( 'Contact Section', 'appster' )
              ),
              array(
              'value'       => 'section-footer',
              'label'       => __( 'Footer Section', 'appster' )
              )
            )
          ),
        )
      ),
      /**

      Home Settings

      */
      array(
        'id'          => 'eth_home',
        'label'       => __( 'Landing Page Home Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'home',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_button_href',
        'label'       => __( 'Home Purchase Button', 'eth-theme' ),
        'desc'        => __( 'Button anchor link (<code>href</code> attribute).', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_button_text',
        'label'       => '',
        'desc'        => __( 'Button text', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),

      array(
        'id'          => 'eth_home_media_type',
        'label'       => __( 'Select Media Type.', 'eth' ),
        'desc'        => __( 'Is the media an image or a video?', 'eth' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'image',
            'label'       => __( 'Image', 'eth' ),
            'src'         => ''
          ),
          array(
            'value'       => 'embed',
            'label'       => __( 'Video Embed', 'eth' ),
            'src'         => ''
          )
        )
      ),


      array(
        'id'          => 'eth_home_embed',
        'label'       => __( 'Embed Media', 'eth-theme' ),
        'desc'        => __( 'Embed third party services like Youtube, vimeo, etc.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'home',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'eth_home_media_type:is(embed)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_image',
        'label'       => __( 'Upload Image', 'eth-theme' ),
        'desc'        => __( '', 'eth-theme' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'eth_home_media_type:is(image)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_home_image_anim',
        'label'       => '',
        'desc'        => __( 'Choose animation for media.', 'eth-theme'),
        'std'         => '',
        'section'     => 'home',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $animate_css
      ),
      array(
        'id'          => 'eth_home_media_pos',
        'label'       => __( '', 'eth-theme' ),
        'desc'        => __( 'Choose media position.', 'eth-theme' ),
        'std'         => 'right',
        'type'        => 'select',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'left',
            'label'       => __( 'Left', 'eth-theme' ),
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => __( 'Right', 'eth-theme' ),
            'src'         => ''
          )
        )
      ),
      /**

      Reviews Settings

      */
      array(
        'id'          => 'eth_reviews',
        'label'       => __( 'Landing Page Reviews Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'reviews',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_reviews_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'reviews',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_reviews_list',
        'label'       => __( 'Reviews List', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'reviews',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_review_quote',
            'label'       => __( 'Quote', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_review_source',
            'label'       => __( 'Source of Quote', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
        )
      ),
      /**

      Features Settings

      */
      array(
        'id'          => 'eth_features',
        'label'       => __( 'Landing Page Features Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'features',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_features_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'features',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_features_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'features',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_features_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'features',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_features_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'features',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_features_list',
        'label'       => __( 'Features List', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'features',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_feature_icon',
            'label'       => __( 'Feature Icon', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_feature_title',
            'label'       => __( 'Feature Title', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_feature_desc',
            'label'       => __( 'Feature Description', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '6',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'eth_features_list_anim',
        'label'       => '',
        'desc'        => __( 'Choose animation for the list of features.', 'eth-theme'),
        'std'         => '',
        'section'     => 'features',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $animate_css
      ),
      /**

      Overview Settings

      */
      array(
        'id'          => 'eth_overview',
        'label'       => __( 'Landing Page Overview Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_overview_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_overview_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_overview_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_overview_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'overview',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_overview_list',
        'label'       => __( 'Overview Content List', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_overview_content',
            'label'       => __( 'Overview Content', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_overview_content_image',
            'label'       => __( 'Upload Image', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_overview_content_image_link',
            'label'       => __( 'Image Link', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_overview_content_title',
            'label'       => __( 'Overview Content Title', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_overview_content_desc',
            'label'       => __( 'Overview Content Description', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '6',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'eth_overview_list_anim',
        'label'       => '',
        'desc'        => __( 'Choose animation for the overview list.', 'eth-theme'),
        'std'         => '',
        'section'     => 'overview',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $animate_css
      ),
      array(
        'id'          => 'eth_overview_product_image',
        'label'       => __( 'Upload Product Sample Image', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_overview_product_image_anim',
        'label'       => '',
        'desc'        => __( 'Choose animation for the product image.', 'eth-theme'),
        'std'         => '',
        'section'     => 'overview',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $animate_css
      ),
      array(
        'id'          => 'eth_overview_dl_link',
        'label'       => __( 'Download Sample Button', 'eth-theme' ),
        'desc'        => __( 'Link', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_overview_dl_text',
        'label'       => '',
        'desc'        => __( 'Text', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_testing',
        'label'       => __( '', 'eth-theme' ),
        'desc'        => __( 'Insert google anayltics code in <code>header</code> or <code>footer</code>.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'overview',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'same_window',
            'label'       => __( 'Same Window', 'eth-theme' ),
            'src'         => ''
          ),
          array(
            'value'       => 'new_tab',
            'label'       => __( 'New Tab', 'eth-theme' ),
            'src'         => ''
          )
        )
      ),
      /**

      CTA Settings

      */
      array(
        'id'          => 'eth_cta',
        'label'       => __( 'Landing Page Call to Action Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'cta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_cta_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_cta_text',
        'label'       => __( 'Call to Action Text', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_cta_button_href',
        'label'       => __( 'Call to Action Button', 'eth-theme' ),
        'desc'        => __( 'Button anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_cta_button_text',
        'label'       => '',
        'desc'        => __( 'Button text.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cta',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_cta_button_anim',
        'label'       => '',
        'desc'        => __( 'Choose animation for the button.', 'eth-theme'),
        'std'         => '',
        'section'     => 'cta',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $animate_css
      ),
      /**

      Testimonials Settings

      */
      array(
        'id'          => 'eth_testimonials',
        'label'       => __( 'Landing Page Testimonials Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_testimonials_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_testimonials_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_testimonials_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_testimonials_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'testimonials',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_testimonials_list',
        'label'       => __( 'Testimonials List', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_testimonial_avatar',
            'label'       => __( 'Avatar', 'eth-theme' ),
            'desc'        => __( 'Upload your avatar image. (<strong>Recommended: 128x128</strong>)', 'eth-theme' ),
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_testimonial_name',
            'label'       => __( 'Name', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_testimonial_rating',
            'label'       => __( 'Product Rating', 'eth-theme' ),
            'desc'        => __( 'Give a score of 0 ~ 5 for the product. For example, a score of 3.5 will display 3 full stars, 1 half star and 1 empty star. Use decimals', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_testimonial_message',
            'label'       => __( 'Message', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '6',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
        )
      ),
      array(
        'id'          => 'eth_testimonials_anim_odd',
        'label'       => '',
        'desc'        => __( 'Choose animation for <strong>odd</strong> numbered testimonial blocks.', 'eth-theme'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $animate_css
      ),
      array(
        'id'          => 'eth_testimonials_anim_even',
        'label'       => '',
        'desc'        => __( 'Choose animation for <strong>even</strong> numbered testimonial blocks.', 'eth-theme'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'testimonials',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => $animate_css
      ),
      /**

      Author Settings

      */
      array(
        'id'          => 'eth_author',
        'label'       => __( 'Landing Page Author Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'author',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_avatar',
        'label'       => __( 'Author Avatar', 'eth-theme' ),
        'desc'        => __( 'Upload the author\'s profile image. (<strong>Recommended: 200x200</strong>).', 'eth-theme' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_name',
        'label'       => __( 'Author Name', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_social_list',
        'label'       => __( 'Social Links', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_author_social_icon',
            'label'       => __( 'Icon', 'eth-theme' ),
            'desc'        => __( 'Enter the FontAwesome class of the icon. List of icons can be found <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/">here</a>.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_author_social_link',
            'label'       => __( 'Link', 'eth-theme' ),
            'desc'        => __( 'Enter the link to the author\'s social profile.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'eth_author_sig',
        'label'       => __( 'Signature', 'eth-theme' ),
        'desc'        => __( 'Upload an image of the author signature.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'author',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_author_desc',
        'label'       => __( 'Author Description', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'author',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      /**

      Price Table Settings

      */
      array(
        'id'          => 'eth_pricetable',
        'label'       => __( 'Landing Page Pricetable Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'pricetable',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_pricetable_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'pricetable',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_pricetable_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'pricetable',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_pricetable_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'pricetable',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_pricetable_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'pricetable',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_pricetable_list',
        'label'       => __( 'Price Tables', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'pricetable',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_pricetable_recommended',
            'label'       => __( 'Recommended Product?', 'eth-theme' ),
            'desc'        => '',
            'std'         => 'off',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_pricetable_title',
            'label'       => __( 'Price Table Title', 'eth-theme' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_pricetable_price',
            'label'       => __( 'Price', 'eth-theme' ),
            'desc'        => __( 'Enter price of product.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_pricetable_desc',
            'label'       => __( 'Description', 'eth-theme' ),
            'desc'        => __( 'Enter description of product that the user will get.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '6',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_pricetable_button_link',
            'label'       => __( 'Button', 'eth-theme' ),
            'desc'        => __( 'Button link.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_pricetable_button_text',
            'label'       => __( 'Button', 'eth-theme' ),
            'desc'        => __( 'Button text.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_pricetable_anim',
            'label'       => __( 'Animation', 'eth-theme'),
            'desc'        => __( 'Choose animation for this price table.', 'eth-theme'),
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => $animate_css
          ),
        )
      ),
      /**

      Contact Settings

      */
      array(
        'id'          => 'eth_contact',
        'label'       => __( 'Landing Page Contact Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_contact_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_contact_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_contact_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_contact_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'contact',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_contact_form',
        'label'       => __( 'Contact Form', 'eth-theme' ),
        'desc'        => __( 'This theme uses <a href="http://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> plugin.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_contact_shortcode',
        'label'       => '',
        'desc'        => __( 'Enter your Contact Form 7 shortcode.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'contact',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      /**

      Footer Settings

      */
      array(
        'id'          => 'eth_footer',
        'label'       => __( 'Landing Page Footer Section', 'eth-theme' ),
        'desc'        => __( 'This is the settings used for the landing page template.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textblock-titled',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_footer_id',
        'label'       => __( 'Section ID', 'eth-theme' ),
        'desc'        => __( 'Give this section an ID which will be used as the anchor link.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_footer_title',
        'label'       => __( 'Title', 'eth-theme' ),
        'desc'        => __( 'Text which appears at the top of this section.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_footer_title_highlight',
        'label'       => '',
        'desc'        => __( 'Text to highlight.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_footer_subtitle',
        'label'       => __( 'Subtitle', 'eth-theme' ),
        'desc'        => __( 'Additional text which appears below the title.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'eth_social_list',
        'label'       => __( 'Social Links', 'eth-theme' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'eth_social_icon',
            'label'       => __( 'Icon', 'eth-theme' ),
            'desc'        => __( 'Enter the FontAwesome class of the icon. List of icons can be found <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/">here</a>.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'eth_social_link',
            'label'       => __( 'Link', 'eth-theme' ),
            'desc'        => __( 'Enter the link to the social profile.', 'eth-theme' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'eth_social_link_new_tab',
        'label'       => __( 'Open social links in new tab?', 'eth-theme' ),
        'desc'        => __( '', 'eth-theme' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array(
          array(
            'value'       => 'same_window',
            'label'       => __( 'Same window', 'eth-theme' ),
            'src'         => ''
          ),
          array(
            'value'       => 'new_tab',
            'label'       => __( 'New tab', 'eth-theme' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'eth_footer_text',
        'label'       => __( 'Footer', 'eth-theme' ),
        'desc'        => __( 'Text at the bottom of the site. Usually the copyright text.', 'eth-theme' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '4',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );

  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings );
  }

}