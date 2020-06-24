<?php
/**
*  Custom OptionTree UI.
*/
add_action( 'admin_enqueue_scripts', 'eth_admin_styles_scripts', 999 );
if ( ! function_exists( 'eth_admin_styles_scripts' ) ) :
function eth_admin_styles_scripts() {
  // Custom CSS for Option Tree options
  wp_enqueue_style('eth-admin-css' , get_template_directory_uri() . '/inc/theme-options/css/admin.css');
  // Custom JS for Option Tree options
  wp_register_script('eth-admin-js' , get_template_directory_uri() . '/inc/theme-options/js/admin.js' , '' , false , true);

  // dynamically update theme version's number with PHP CONSTANT
  wp_localize_script('eth-admin-js', 'eth_theme', array( 'ver' => THEME_VER ) );

  wp_enqueue_script('eth-admin-js');
}
endif; // ( ! function_exists( 'eth_admin_styles_scripts' ) ) :



/**

  Cancel register 'OptionTree' Page 

*/
add_filter( 'ot_register_pages_array', 'remove_ot_page' ); // @ot-functions-admin.php
function remove_ot_page( $array ) {
  $array = '';
  return $array;
}

/**
  
  Move 'Theme Options' page position to appear below 'Settings'

*/
add_filter( 'ot_theme_options_parent_slug', 'ot_change_parent_slug'); // @ot-functions-admin.php
function ot_change_parent_slug( $slug ) {
  $slug = '';

  return $slug;
}

add_filter( 'ot_theme_options_position', 'ot_change_menu_pos'); // @ot-functions-admin.php
function ot_change_menu_pos( $pos ) {
  $pos = '81';

  return $pos;
}
/**

  Add custom Theme Options Import/Export page

*/
add_action( 'init', 'register_options_pages' );

function register_options_pages() {


  if ( is_admin() && function_exists( 'ot_register_settings' ) ) {

    ot_register_settings( 
      array(
        array( 
          'id'              => 'import_export',
          'pages'           => array(
            array(
              'id'              => 'import_export',
              'parent_slug'     => '',
              'page_title'      => 'Theme Options Import/Export',
              'menu_title'      => 'Theme Options Import/Export',
              'capability'      => 'edit_theme_options',
              'menu_slug'       => 'theme-options-import-export',
              'icon_url'        => null,
              'position'        => 82,
              'updated_message' => 'Options updated.',
              'reset_message'   => 'Options resetted.',
              'button_text'     => 'Save Changes',
              'show_buttons'    => false,
              'screen_icon'     => 'themes',
              'contextual_help' => null,
              'sections'        => array(
                array(
                  'id'          => 'toie_import_export',
                  'title'       => __( 'Import/Export', 'yourtextdomain' )
                )
              ),
              'settings'        => array(
                array(
                    'id'          => 'import_data_text',
                    'label'       => 'Import Theme Options',
                    'desc'        => __( 'Theme Options', 'yourtextdomain' ),
                    'std'         => '',
                    'type'        => 'import-data',
                    'section'     => 'toie_import_export',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  ),
                  array(
                    'id'          => 'export_data_text',
                    'label'       => 'Export Theme Options',
                    'desc'        => __( 'Theme Options', 'yourtextdomain' ),
                    'std'         => '',
                    'type'        => 'export-data',
                    'section'     => 'toie_import_export',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  )
              )
            )
          )
        )
      )
    );
  }
}

if ( ! function_exists( 'ot_type_import_data' ) ) {

  function ot_type_import_data() {

    echo '<form method="post" id="import-data-form">';


      wp_nonce_field( 'import_data_form', 'import_data_nonce' );


      echo '<div class="format-setting type-textarea has-desc">';


        echo '<div class="description">';

          if ( OT_SHOW_SETTINGS_IMPORT ) echo '<p>' . __( 'Only after you\'ve imported the Settings should you try and update your Theme Options.', 'option-tree' ) . '</p>';

          echo '<p>' . __( 'To import your Theme Options copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Import Theme Options" button.', 'option-tree' ) . '</p>';
 
          echo '<button class="option-tree-ui-button blue right hug-right">' . __( 'Import Theme Options', 'option-tree' ) . '</button>';
        echo '</div>';

 
        echo '<div class="format-setting-inner">';
          echo '<textarea rows="10" cols="40" name="import_data" id="import_data" class="textarea"></textarea>';
        echo '</div>';
      echo '</div>';
    echo '</form>';

  }

}

if ( ! function_exists( 'ot_type_export_data' ) ) {

  function ot_type_export_data() {


    echo '<div class="format-setting type-textarea simple has-desc">';


      echo '<div class="description">';
        echo '<p>' . __( 'Export your Theme Options data by highlighting this text and doing a copy/paste into a blank .txt file. Then save the file for importing into another install of WordPress later. Alternatively, you could just paste it into the <code>OptionTree->Settings->Import</code> <strong>Theme Options</strong> textarea on another web site.', 'option-tree' ) . '</p>';
      echo '</div>';


      $data = get_option( 'option_tree' );
      $data = ! empty( $data ) ? ot_encode( serialize( $data ) ) : '';

      echo '<div class="format-setting-inner">';
        echo '<textarea rows="10" cols="40" name="export_data" id="export_data" class="textarea">' . $data . '</textarea>';
      echo '</div>';
    echo '</div>';
  }
}
?>