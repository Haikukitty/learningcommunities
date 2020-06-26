<?php
/* This file contains code from the Software Licensing addon by Easy Digital Downloads - GPLv2.0 or higher */
if (!defined('ABSPATH')) exit;

define( 'DIVI_HACKS_FILE', realpath(dirname(__FILE__).'/../divi-hack.php') );
define( 'DIVI_HACKS_STORE_URL', 'https://divihacks.com/' );
define( 'DIVI_HACKS_ITEM_NAME', 'Divi Hacks Lite' ); // Needs to exactly match the download name in EDD
define( 'DIVI_HACKS_PLUGIN_PAGE', 'admin.php?page=divi-hacks-settings' );

if( !class_exists( 'Divi_Hacks_Plugin_Updater' ) ) {
	// load our custom updater
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

// Load translations
load_plugin_textdomain('aspengrove-updater', false, plugin_basename(dirname(__FILE__).'/lang'));

function Divi_Hacks_updater() {

	// retrieve our license key from the DB
	$license_key = trim( get_option( 'Divi_Hacks_license_key' ) );

	// setup the updater
	new Divi_Hacks_Plugin_Updater( 'https://divihacks.com/?wc-api=validate_serial_key', DIVI_HACKS_FILE, array(
			'version' 	=> DIVI_HACKS_VERSION, // current version number
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => DIVI_HACKS_ITEM_NAME, 	// name of this plugin
			'author' 	=> 'Divi Hacks',  // author of this plugin
			'beta'		=> false
		)
	);
}
add_action( 'admin_init', 'Divi_Hacks_updater', 0 );


function Divi_Hacks_has_license_key() {
	if (isset($_POST['Divi_Hacks_license_key_deactivate'])) {
		require_once(dirname(__FILE__).'/license-key-activation.php');
		Divi_Hacks_deactivate_license();
	}
	return (get_option('Divi_Hacks_license_status') === 'valid');
}

function Divi_Hacks_activate_page() {
	$license = get_option( 'Divi_Hacks_license_key' );
	$status  = get_option( 'Divi_Hacks_license_status' );
	?>
		<div class="wrap" id="Divi_Hacks_license_key_activation_page">
			<div class="container-fluid">
				<div class="row" style="display:flex; flex-direction:column; flex-wrap:wrap;">
					<div class="column" style="width:50%; padding:20px 10%; box-sizing:border-box; background:aquamarine;">
						<form method="post" action="options.php" id="Divi_Hacks_license_form">
							<div id="Divi_Hacks_license_form_body">
								<h3>
									<?php echo(esc_html(DIVI_HACKS_ITEM_NAME)); ?>
									<small>v<?php echo(DIVI_HACKS_VERSION); ?></small>
								</h3>
					
								<p>
									Thank you for purchasing Divi Hacks!
								</p>
					
								<?php settings_fields('Divi_Hacks_license'); ?>
								<?php if( false !== $license ) {
									// Need to activate license here, only if submitted
									require_once(dirname(__FILE__).'/license-key-activation.php');
									Divi_Hacks_activate_license();
								} ?>
					
								<label>
									<span><?php _e('License Key:', 'aspengrove-updater'); ?></span>
									<input name="Divi_Hacks_license_key" type="text" class="regular-text"<?php if (!empty($_GET['license_key'])) { ?> value="<?php echo(esc_attr($_GET['license_key'])); ?>"<?php } else if (!empty($license)) { ?> value="<?php echo(esc_attr($license)); ?>"<?php } ?> />
								</label>
					
								<?php
									if (isset($_GET['sl_activation']) && $_GET['sl_activation'] == 'false') {
										echo('<p id="Divi_Hacks_license_form_error">'.(empty($_GET['sl_message']) ? esc_html__('An unknown error has occurred. Please try again.', 'aspengrove-updater') : esc_html($_GET['sl_message'])).'</p>');
									}
						
									submit_button('Continue');
								?>
							</div>
						</form>
					</div>
					<div class="column" style="width:50%; padding:20px 10%; box-sizing:border-box;">
						<h2>About</h2>
						<p>We developed this plugin for our own web designing - to help speed up the process of designing pages. We hope you enjoy using it! If you have any questions, please don't hestitate to reach out via <a href="mailto:info@divihacks.com">email</a>. Support is currently only available for Divi Hacks Pro.
						<p><a class="button" href="https://divihacks.com/docs" target="_blank">Documentation</a></p>
						<p><a class="button" href="https://testdrive.divihacks.com/" target="_blank">Test Drive Divi Hacks Pro</a></p>
					</div>
				</div>
			</div>
		</div>
	<?php
}

function Divi_Hacks_license_key_box() {
	$status  = get_option( 'Divi_Hacks_license_status' );
	?>
		<div id="Divi_Hacks_license_key_box">
			<div class="container-fluid">
				<div class="row" style="display:flex; flex-direction:column; flex-wrap:wrap;">
					<div class="column" style="width:100%; padding:20px 10%; box-sizing:border-box; background:#eee;">
						<form method="post" id="Divi_Hacks_license_form">				
							<div id="Divi_Hacks_license_form_body">
								<h3>
									<?php echo(esc_html(DIVI_HACKS_ITEM_NAME)); ?>
									<small>v<?php echo(DIVI_HACKS_VERSION); ?></small>
								</h3>
					
								<label>
									<span><?php _e('License Key:', 'aspengrove-updater'); ?></span>
									<input type="text" readonly="readonly" value="<?php echo(esc_html(get_option('Divi_Hacks_license_key'))); ?>" />
								</label>
								<?php wp_nonce_field( 'Divi_Hacks_license_key_deactivate', 'Divi_Hacks_license_key_deactivate' ); ?>
								<?php
									if (isset($_GET['sl_activation']) && $_GET['sl_activation'] == 'false') {
										echo('<p id="Divi_Hacks_license_form_error">'.(empty($_GET['sl_message']) ? esc_html__('An unknown error has occurred. Please try again.', 'aspengrove-updater') : esc_html($_GET['sl_message'])).'</p>');
									}
						
									submit_button('Deactivate License Key', '');
								?>
							</div>
						</form>
					</div>
					<div class="column" style="width:100%; padding:20px 10%; box-sizing:border-box;">
						<h2>About</h2>
						<p>We developed this plugin for our own web designing - to help speed up the process of designing pages. We hope you enjoy using it! If you have any questions, please don't hestitate to reach out via <a href="mailto:info@divihacks.com">email</a>. Support is currently only available for Divi Hacks Pro.
						<p><a class="button" href="https://divihacks.com/docs" target="_blank">Documentation</a></p>
						<p><a class="button" href="https://testdrive.divihacks.com/" target="_blank">Test Drive Divi Hacks Pro</a></p>
					</div>
				</div>
			</div>

		</div>
	<?php
}

function Divi_Hacks_register_option() {
	// creates our settings in the options table
	register_setting('Divi_Hacks_license', 'Divi_Hacks_license_key', 'Divi_Hacks_sanitize_license' );
}
add_action('admin_init', 'Divi_Hacks_register_option');

function Divi_Hacks_sanitize_license( $new ) {
	$old = get_option( 'Divi_Hacks_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'Divi_Hacks_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}