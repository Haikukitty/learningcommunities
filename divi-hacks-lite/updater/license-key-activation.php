<?php
/* This file contains code from the Software Licensing addon by Easy Digital Downloads - GPLv2.0 or higher */
if (!defined('ABSPATH')) exit;

function Divi_Hacks_activate_license() {
	// retrieve the license from the database
	$license = trim( get_option( 'Divi_Hacks_license_key' ) );

	// data to send in our API request
/*	$api_params = array(
		'edd_action' => 'activate_license',
		'license'    => $license,
		'item_name'  => urlencode( Divi_Hacks_ITEM_NAME ), // the name of our product in EDD
		'url'        => home_url()
	);
*/
	// Call the custom API.
	//$response = wp_remote_post( DIVI_HACKS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
//$response = wp_remote_post('https://divihacks.com/?wc-api=validate_serial_key', array( 'timeout' => 15, 'sslverify' => false, 'body'=>array('serial'=>$license,'uuid'=>'divi-hack-v-1', 'sku'=>'divihack30032018')));
	// make sure the response came back okay
$qry_str = '?wc-api=validate_serial_key&serial='.$license.'&uuid=divi-hacks-plugin&sku=dh2018';
$ch = curl_init();

// Set query data here with the URL
curl_setopt($ch, CURLOPT_URL, 'https://divihacks.com/' . $qry_str); 

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
$response = trim(curl_exec($ch));
curl_close($ch);
$response1 = json_decode($response);
$state = strcmp($response1->{'success'},"false");
if($state == false) {
    $message = $response1->{'message'};
}
else if($state == true) {
    //$message = $response1->{'message'};
    update_option( 'Divi_Hacks_license_status', 'valid' );
	update_option('Divi_Hacks_license_key', $license);
}
	// Check if anything passed on a message constituting a failure
	if ( ! empty( $message ) ) {
		delete_option('Divi_Hacks_license_key');
	
		$base_url = admin_url( DIVI_HACKS_PLUGIN_PAGE );
		$redirect = add_query_arg( array( 'sl_activation' => 'false', 'sl_message' => urlencode( $message ), 'license_key' => $license ), $base_url );
		
		wp_redirect( $redirect );
		exit();
	}

	// $license_data->license will be either "valid" or "invalid"

	//update_option( 'Divi_Hacks_license_status', 'valid' );
	//update_option('Divi_Hacks_license_key', $license);
	wp_redirect( admin_url( DIVI_HACKS_PLUGIN_PAGE ) );
	exit();
}

function Divi_Hacks_deactivate_license() {

	// run a quick security check
	//if( ! check_admin_referer( 'Divi_Hacks_license_key_deactivate', 'Divi_Hacks_license_key_deactivate' ) )
	//	return; // get out if we didn't click the Activate button

	// retrieve the license from the database
	$license = trim( get_option( 'Divi_Hacks_license_key' ) );

	// data to send in our API request
/*	$api_params = array(
		'edd_action' => 'deactivate_license',
		'license'    => $license,
		'item_name'  => urlencode( Divi_Hacks_ITEM_NAME ), // the name of our product in EDD
		'url'        => home_url()
	);

	// Call the custom API.
	$response = wp_remote_post( DIVI_HACKS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

	// make sure the response came back okay
	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

		if ( is_wp_error( $response ) ) {
			$message = $response->get_error_message();
		} else {
			$message = __( 'An error occurred, please try again.', 'aspengrove-updater' );
		}

		$base_url = admin_url( DIVI_HACKS_PLUGIN_PAGE );
		$redirect = add_query_arg( array( 'sl_activation' => 'false', 'sl_message' => urlencode( $message ) ), $base_url );

		wp_redirect( $redirect );
		exit();
	}

	// decode the license data
	$license_data = json_decode( wp_remote_retrieve_body( $response ) );
	
	// $license_data->license will be either "deactivated" or "failed"
	if ($license_data->license == 'deactivated') {
		delete_option('Divi_Hacks_license_status');
		delete_option('Divi_Hacks_license_key');
	} else {
		$base_url = admin_url( DIVI_HACKS_PLUGIN_PAGE );
		$redirect = add_query_arg( array( 'sl_activation' => 'false', 'sl_message' => urlencode(__('An error occurred during license key deactivation. Please try again or contact support.', 'aspengrove-updater')) ), $base_url );

		wp_redirect( $redirect );
		exit();
	}
*/
delete_option( 'Divi_Hacks_license_status', 'valid' );
	delete_option('Divi_Hacks_license_key', $license);
	wp_redirect( admin_url( DIVI_HACKS_PLUGIN_PAGE ) );
	exit();
}
?>