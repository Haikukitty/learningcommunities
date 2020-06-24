<?php
/**
 * Main functions.
 *
 * @package Ethority
 * @since   1.2.0
 */

// Define theme version constant.
define( 'THEME_VER', wp_get_theme()->get( 'Version' ) );

/**
 * Include Option Tree plugin.
 *
 * @since  1.0.0
 */
add_filter( 'ot_theme_mode', '__return_true' );
require( 'option-tree-master/ot-loader.php' );

if ( ! function_exists( 'eth_theme_options' ) ) :
/**
 * Load custom Option Tree settings.
 *
 * @since 1.0.0
 */
function eth_theme_options() {
  // load custom theme options
  require( 'inc/theme-options/admin.php' );
  require( 'inc/theme-options/options.php' );
}
add_action( 'after_setup_theme', 'eth_theme_options' );
endif;

if ( ! function_exists( 'eth_theme_setup' ) ) :
/**
 * Theme setup.
 *
 * @since  1.0.0
 */
function eth_theme_setup() {

  /**
   * Include files placed in 'after_setup_theme' hook
   * because Option Tree functions are only only available
   * after.
   */

  /**
   * Load custom theme functions
   *
   * @since  1.0.0
   */
  require( 'inc/eth-functions.php' );

  /**
   * Deprecated and replaced by eth-css.php.
   *
   * @since 1.1.3
   */
  // require( 'inc/eth-color.php' );

  /**
   * Include theme option css.
   *
   * @since  1.1.3
   */
  require( 'inc/eth-css.php' );

  /**
   * Include theme option css.
   *
   * @since  1.1.3
   */
  require( 'inc/eth-js.php' );

  /**
   * Deprecated. Code moved to eth-css.php and
   * eth-js.php.
   *
   * @since 1.1.3
   */
  // require( 'inc/eth-print-options.php' );

  /**
   * Include shortcodes.
   *
   * @since  1.0.0
   */
  require( 'inc/shortcodes/shortcodes.php' );

  // Translation
  load_theme_textdomain('eth-theme' , get_template_directory() . '/languages');

  if ( ! isset( $content_width ) ) $content_width = 960;

  // Menu
  register_nav_menus( array(
    'top-menu' => __( 'Top primary menu', 'eth-theme' )
  ) );

  // Add theme (support) features
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );

  // Post thumbnail size
  set_post_thumbnail_size( 640, 250, true );

}
add_action( 'after_setup_theme', 'eth_theme_setup' );
endif;

if ( ! function_exists( 'eth_widgets_init' ) ) :
/**
 * Include widgets.
 *
 * @since 1.2.0
 */
function eth_widgets_init() {
  // Content
  register_sidebar( array(
    'name'          => __( 'Content Sidebar', 'eth-theme' ),
    'id'            => 'eth-content-sidebar',
    'description'   => __( 'Main sidebar that appears beside the content.', 'eth-theme' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'eth_widgets_init' );
endif;

if ( ! function_exists( 'eth_styles_scripts' ) ) :
/**
 * Load CSS / JS.
 *
 * @since 1.2.0
 */
function eth_styles_scripts() {
  // CSS
  wp_enqueue_style('eth-skeleton' , get_template_directory_uri() . '/assets/css/skeleton.css');
  wp_enqueue_style('eth-font-awesome' , get_template_directory_uri() . '/assets/css/font-awesome.min.css', '', '4.5.0');
  wp_enqueue_style('eth-animate' , get_template_directory_uri() . '/assets/css/animate.css');
  wp_enqueue_style('eth-owl' , get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
  wp_enqueue_style('eth-owl-theme' , get_template_directory_uri() . '/assets/css/owl.theme.default.css');
  wp_enqueue_style('eth-css' , get_template_directory_uri() . '/assets/css/main.css');

  // Google Fonts
  wp_enqueue_style( 'eth-google-fonts', eth_get_google_fonts_url() );

  // JS
  wp_register_script('form-validation' , get_template_directory_uri() . '/assets/js/vendor/jquery.validate.min.js' , '' , false , true);
  wp_register_script('fitvids' , get_template_directory_uri() . '/assets/js/vendor/jquery.fitvids.js' , '' , false , true);
  wp_register_script('placeholder' , get_template_directory_uri() . '/assets/js/vendor/jquery.placeholder.js' , '' , false , true);
  wp_register_script('waypoints' , get_template_directory_uri() . '/assets/js/vendor/waypoints.min.js' , '' , false , true);
  wp_register_script('owl-carousel' , get_template_directory_uri() . '/assets/js/vendor/owl.carousel.min.js' , '' , false , true);
  wp_register_script('eth-js' , get_template_directory_uri() . '/assets/js/main.js' , '' , false , true);

  wp_enqueue_script('jquery');
  wp_enqueue_script('form-validation');
  wp_enqueue_script('fitvids');
  wp_enqueue_script('placeholder');
  wp_enqueue_script('waypoints');
  wp_enqueue_script('owl-carousel');
  wp_enqueue_script('eth-js');


  if ( is_single() && comments_open() ) {
    // Allows comment form to appear right below the comment the user wants to reply to
      wp_enqueue_script( 'comment-reply' );
      // Shows error if some required fields are not filled properly

  }
}
add_action( 'wp_enqueue_scripts', 'eth_styles_scripts' );
endif;

if ( ! function_exists( 'eth_get_google_fonts_url' ) ) :
/**
 * Register Google Fonts.
 *
 * @since 1.2.0
 */
function eth_get_google_fonts_url() {
  $fonts_url = '';

  $font_families = array();
  $font_families[] = 'Lato:300,400,700,300italic,400italic,700italic';
  $font_families[] = 'Roboto Slab:400,300,700';
  $font_families[] = 'Montserrat:400,700';
  $font_families[] = 'Pacifico';

  /**
   * Add filter to add more fonts easily.
   *
   * @since 1.2.0
   *
   * @param array $font_families List of google fonts to get.
   */
  $font_families = apply_filters( 'eth_google_fonts_list', $font_families );

  $query_args = array(
    'family' => urlencode( implode( '|', $font_families ) )
    // 'subset' => urlencode( 'latin,latin-ext' )
  );

  $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

  return $fonts_url;
}
endif;

/**
 * Include plugins requirement notice plugin.
 *
 * @since  1.0.0
 */
require_once 'inc/class-tgm-plugin-activation.php';

if ( ! function_exists( 'eth_required_plugins' ) ) :
/**
 * Include plugins required.
 *
 * @since  1.0.0
 */
function eth_required_plugins() {

  $plugins = array(
    array(
      'name'      => 'Contact Form 7',
      'slug'      => 'contact-form-7',
      'required'  => true,
    ),
  );

  $theme_text_domain = 'eth-theme';

  $config = array(
    'domain'          => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
    'default_path'    => '',                          // Default absolute path to pre-packaged plugins
    'parent_menu_slug'  => 'themes.php',        // Default parent menu slug
    'parent_url_slug'   => 'themes.php',        // Default parent URL slug
    'menu'            => 'install-required-plugins',  // Menu slug
    'has_notices'       => true,                        // Show admin notices or not
    'is_automatic'      => false,             // Automatically activate plugins after installation or not
    'message'       => '',              // Message to output right before the plugins table
    'strings'         => array(
      'page_title'                            => __( 'Install Required Plugins', $theme_text_domain ),
      'menu_title'                            => __( 'Install Plugins', $theme_text_domain ),
      'installing'                            => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
      'oops'                                  => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
      'notice_can_install_required'           => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_install_recommended'      => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
      'notice_can_activate_required'          => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_can_activate_recommended'     => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
      'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
      'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
      'install_link'                  => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
      'activate_link'                 => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
      'return'                                => __( 'Return to Required Plugins Installer', $theme_text_domain ),
      'plugin_activated'                      => __( 'Plugin activated successfully.', $theme_text_domain ),
      'complete'                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
      'nag_type'                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
    )
  );

  tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'eth_required_plugins' );
endif;