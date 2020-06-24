<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
/*
* Plugin Name: Divi Stop Stacking
* Plugin URI: https://besuperfly.com/product/divi-stop-stacking/
* Description: Prevent columns from stacking on tablet and mobile.
* Version: 1.2.2
* Author: BeSuperfly
* Author URI: https://besuperfly.com/
* License: GPL3
*/

function divi_stop_stacking_enqueue() {
    wp_enqueue_style('divi-stop-stacking', plugins_url( '/css/divi-stop-stacking.css', __FILE__ ));
    wp_enqueue_script('divi-stop-stacking', plugins_url( '/js/divi-stop-stacking.min.js', __FILE__ ), array('jquery'), false, true);
}
add_action( 'wp_enqueue_scripts', 'divi_stop_stacking_enqueue' );

function divi_stop_stacking_admin_enqueue() {
    wp_enqueue_style('divi-stop-stacking-admin', plugins_url( '/css/divi-stop-stacking-admin.css', __FILE__ ));
}
add_action( 'admin_enqueue_scripts', 'divi_stop_stacking_admin_enqueue', 100 );

// Intialize these custom modules if the Builder is being used
add_action( 'et_builder_ready', 'Divi_Stop_Stacking_Custom_Module');

function Divi_Stop_Stacking_Custom_Module(){
    if(class_exists("ET_Builder_Module")){
       include("divi-stop-stacking-module.php");
    }
}

// Make it harder to find latest version. Keeps the honest people honest.
$updater = base64_decode('aHR0cHM6Ly9iZXN1cGVyZmx5LmNvbS90aGVtZXMtcGx1Z2lucy11cGRhdGVyL3BhY2thZ2VzL2Rpdmktc3RvcC1zdGFja2luZy9kaXZpLXN0b3Atc3RhY2tpbmcuanNvbg==');

require 'plugin-update-checker/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    $updater,
    __FILE__,
    'divi-stop-stacking'
);

?>