<?php
/**
* 	Add shortcodes buttons to the TinyMCE.
*/

class Eth_Shortcodes
{
	public $files;

	function __construct( $files)
	{
		$this->files = $files;

		// add buttons
		add_action('init' , array( &$this , 'add_buttons') );
	}

	function add_buttons()
	{
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) 
			return;

		// mce_button_x, where 'x' is the row number you want the button to display at
		add_filter('mce_buttons_3', array(&$this, 'reg_tinymce_buttons' ));
		// link to JS file
		add_filter("mce_external_plugins", array(&$this, 'add_tinymce_buttons' ));
	}

	// register
	function reg_tinymce_buttons( $buttons ) 
	{

		array_push( $buttons, 
			'eth_color',
			'eth_empty',
			'eth_divider',
			'eth_highlight',
			'eth_clearfix',
			'eth_col',
			'eth_accordion',
			'eth_accordion_item',
			'eth_toggle',
			'eth_tabsgroup',
			'eth_tabsitem'
		);

		return $buttons;
	}


	function add_tinymce_buttons( $plugin_array ) 
	{
		foreach ( $this->files as $name => $path) {
			$plugin_array[$name] =  $path;
		}
		
		return $plugin_array;
	}
}




// add files
$files = array(
		'eth_shortcodes' =>  get_template_directory_uri() . '/inc/shortcodes/tinymce/js/tinymce.js'
);


$Focus_Shortcodes = new Eth_Shortcodes( $files );