<?php
/**
 * Shortcodes setup.
 *
 * @package Ethority
 * @since   1.2.0
 */

// Add scripts and styles
if ( !function_exists( 'eth_shortcodes_scripts_styles' ) ) {
  add_action( 'wp_enqueue_scripts', 'eth_shortcodes_scripts_styles' );
  function eth_shortcodes_scripts_styles() {
    // CSS
    wp_enqueue_style( 'eth-shortcodes' , get_template_directory_uri() . '/inc/shortcodes/css/shortcodes.css' );


    // JS
    wp_enqueue_script( 'jquery-ui-accordion' );
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_script( 'eth-shortcodes' , get_template_directory_uri() . '/inc/shortcodes/js/shortcodes.js' , '' , false, true );

  }
}

// the shortcodes
require_once( get_template_directory() . '/inc/shortcodes/shortcodes-functions.php' );

// TinyMCE
require_once( get_template_directory() . '/inc/shortcodes/tinymce/tinymce.php' );

add_action( 'admin_enqueue_scripts', 'tinymce_scripts_styles' );
function tinymce_scripts_styles() {
  // add custom css for shortcode buttons
  wp_enqueue_style( 'eth-shortcodes' , get_template_directory_uri() . '/inc/shortcodes/tinymce/css/tinymce.css' );
}