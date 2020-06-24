<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
/*
Plugin Name: Mhmm - Mighty Header & Menu Maker
Plugin URI:  https://besuperfly.com/
Description: Build custom header and menu layouts using Divi. Includes three new Divi modules: Hamburger Menu, Inline Menu and Layout (Mega) Menu.
Version:     2.1.18
Author:      BeSuperfly
Author URI:  https://besuperfly.com/
*/

global $mhmmVersion;
$mhmmVersion = '2.1.18';

function get_mhmm_styles() {
	return array(
		'mhmm-basic' => 'Basic',
		'mhmm-sticky-top' => 'Stick to Top',
		'mhmm-sticky-top-hide' => 'Stick to Top, Hide on Scroll',
		'mhmm-sticky-top-show' => 'Stick to Top, Show on Scroll',
		'mhmm-sticky-bottom' => 'Stick to Bottom',
		'mhmm-sticky-bottom-scroll' => 'Stick to Bottom and Scroll',
	);
}

function registered_layout_category_taxonomy( $taxonomy, $object_type, $array_taxonomy_object ) { 
	if($taxonomy == 'layout_category') {
		if(!term_exists('mhmm_headers', 'layout_category')) {
			wp_insert_term('Header Layouts', 'layout_category', array('slug' => 'mhmm_headers'));
		}
		if(!term_exists('mhmm_menus', 'layout_category')) {
			wp_insert_term('Menu Layouts', 'layout_category', array('slug' => 'mhmm_menus'));
		}
	}
};
add_action( 'registered_taxonomy', 'registered_layout_category_taxonomy', 10, 3 ); 

// Add Mhmm Menu Layout Loader page on plugin activation and plugin update if it doesn't exist
function mhmm_add_layout_loader_page() {
    if(!get_page_by_title( 'Mhmm Menu Layout Loader' )) {
        $mhmm_menu_layout_loader = array(
	        'post_title'    => wp_strip_all_tags( 'Mhmm Menu Layout Loader' ),
	        'post_content'  => 'This page is part of the Mhmm plugin. DO NOT EDIT OR DELETE THIS PAGE.',
	        'post_status'   => 'publish',
	        'post_author'   => 1,
	        'post_type'     => 'page',
	    );

	    // Insert the post into the database
	    wp_insert_post($mhmm_menu_layout_loader);

	    // Soft flush permalink cache
	    global $wp_rewrite; 
	    $wp_rewrite->flush_rules(false);
    }
}
//register_activation_hook(__FILE__, 'mhmm_add_layout_loader_page');
add_action( 'admin_init', 'mhmm_add_layout_loader_page' );
//add_action( 'upgrader_process_complete', 'mhmm_add_layout_loader_page', 10, 2 );

// Prevent indexing of Mhmm Menu Layout Loader page
function mhmm_header_metadata() {
	global $post;
	if ($post->post_title == 'Mhmm Menu Layout Loader'): ?>
		<meta name="robots" content="noindex,nofollow">
	<?php endif;
}
add_action( 'wp_head', 'mhmm_header_metadata' );




add_filter( 'page_template', 'mhmm_page_template' );
function mhmm_page_template( $page_template ) {
    $mhmm_menu_layout_loader = get_page_by_title('Mhmm Menu Layout Loader');
    if (is_page($mhmm_menu_layout_loader->ID)) {
        $page_template = dirname( __FILE__ ) . '/mhmm-menu-layout-loader.php';
    }
    return $page_template;
}

function mhmm_register_theme_customizer( $wp_customize ) {
	$header_options = array(
		'divi_default' => 'Divi Default',
		'disabled' => 'Disabled',
	);

	$headers = new WP_Query(array(
		'post_type' => 'et_pb_layout',
		'tax_query' => array(
			array(
				'taxonomy' => 'layout_category',
				'field' => 'slug',
				'terms' => 'mhmm_headers'
			)
		),
		'posts_per_page' => -1
	));
	if($headers->have_posts()) {
		while($headers->have_posts()) {
			$headers->the_post();
			$header_options[get_the_id()] = get_the_title();
		}
	}
	wp_reset_query(); 
	$wp_customize->add_section('mhmm_customizer_section', array(
		'title' => 'Mhmm',
		'panel' => 'et_divi_header_panel',
		'priority' => 1
	));
	$wp_customize->add_setting('mhmm_layout');
	$wp_customize->add_control(
		'header_layout', 
		array(
			'label'    => 'Mhmm Header Layout',
			'section'  => 'mhmm_customizer_section',
			'settings' => 'mhmm_layout',
			'type'     => 'select',
			'choices'  => $header_options,
			'description' => 'Create header layouts <a href="' . get_admin_url(null, 'edit.php?s&post_status=all&post_type=et_pb_layout&layout_category=mhmm_headers') . '">here</a>.'
		)
	);
	$wp_customize->add_setting('mhmm_style');
	$wp_customize->add_control(
		'header_style', 
		array(
			'label'    => 'Mhmm Header Style',
			'section'  => 'mhmm_customizer_section',
			'settings' => 'mhmm_style',
			'type'     => 'select',
			'choices'  => get_mhmm_styles(),
			'description' => 'Choose how your layout should be displayed.'
		)
	);
}
add_action( 'customize_register', 'mhmm_register_theme_customizer' , 9999);

/* Add Mhmm menus only if allowed for current user */
function mhmm_add_divi_menu() {	
	global $superfly_mhmm_license;
	if(class_exists( 'superfly_mhmm_license' )) {
		$license_status = $superfly_mhmm_license->license_key_status();
		$license_status_check = ( ! empty( $license_status[ 'status_check' ] ) && $license_status[ 'status_check' ] == 'active' ) ? 'Activated' : 'Deactivated';
	}
	else {
		$license_status_check = 'Activated';
	}
	if ( function_exists('et_pb_is_allowed') && et_pb_is_allowed( 'divi_library') && $license_status_check == 'Activated') {
		add_submenu_page( 'et_divi_options', esc_html__( 'Mhmm - Headers', 'Divi' ), esc_html__( 'Mhmm - Headers', 'Divi' ), 'manage_options', 'edit.php?s&post_status=all&post_type=et_pb_layout&layout_category=mhmm_headers' );
		add_submenu_page( 'et_divi_options', esc_html__( 'Mhmm - Mega Menus', 'Divi' ), esc_html__( 'Mhmm - Mega Menus', 'Divi' ), 'manage_options', 'edit.php?s&post_status=all&post_type=et_pb_layout&layout_category=mhmm_menus' );
	}
}
add_action('admin_menu', 'mhmm_add_divi_menu', 100);

/* Mhmm Override Meta Box */
function mhmm_override_meta_box_markup($object) {
	require_once get_template_directory() . '/includes/builder/feature/Library.php';
    wp_nonce_field(basename(__FILE__), "mhmm-override-nonce"); ?>
	<p>Apply a custom header or disable the header on this specific page.</p>
	<p class="post-attributes-label-wrapper">
		<label class="post-attributes-label" for="meta-mhmm-header">Header</label>
	</p>	
	<select name="meta-mhmm-header">
		<?php
		$header_options = array();
		$headers = get_posts(array(
			'post_type' => 'et_pb_layout',
			'tax_query' => array(
				array(
					'taxonomy' => 'layout_category',
					'field' => 'slug',
					'terms' => 'mhmm_headers'
				)
			),
			'posts_per_page' => -1
		));
		foreach($headers as $header) {
			$header_options[$header->ID] = $header->post_title;
		}

		$defaults = array();
		if($mhmm_layout = get_theme_mod('mhmm_layout')) {
			if(is_numeric($mhmm_layout)) {
				$defaults['default'] = 'Default (' . get_the_title($mhmm_layout) . ')';	
			}
			else {
				$mhmm_layout = str_replace('_', ' ', $mhmm_layout);
				$defaults['default'] = 'Default (' . ucwords($mhmm_layout) . ')';		
			}
		}
		else {
			$defaults['default'] = 'Default';
		}
		$defaults['disabled'] = 'Disabled';
		$defaults['divi_default'] = 'Divi Default';
		$meta_header_option_values = $defaults + $header_options;
        foreach($meta_header_option_values as $value => $text) {
            if($value == get_post_meta($object->ID, "meta-mhmm-header", true)) { ?>
                <option value="<?php echo $value;?>" selected><?php echo $text; ?></option>
            <?php }
            else { ?>
                <option value="<?php echo $value;?>" ><?php echo $text; ?></option>
			<?php }
        }
        ?>
	</select>
	<div id="meta-mhmm-style">
		<p class="post-attributes-label-wrapper">
			<label class="post-attributes-label" for="meta-mhmm-style">Style</label>
		</p>
		<?php $mhmm_styles = get_mhmm_styles(); ?>
		<?php if(get_theme_mod('mhmm_style')) {
			$default_style = $mhmm_styles[get_theme_mod('mhmm_style')];
			$style_options = array_merge(array('default' => 'Default (' . $default_style . ')'), $mhmm_styles);		
		}
		else {
			$style_options = array_merge(array('default' => 'Default'), $mhmm_styles);
		} ?>
		<select name="meta-mhmm-style">				
			<?php foreach($style_options as $value => $text) {
		        if($value == get_post_meta($object->ID, "meta-mhmm-style", true)) { ?>
		            <option value="<?php echo $value;?>" selected><?php echo $text; ?></option>
		        <?php }
		        else { ?>
		            <option value="<?php echo $value;?>" ><?php echo $text; ?></option>
				<?php }
		   	} ?>
	   	</select>
   	</div>
    <?php
}

function add_mhmm_override_meta_box() {
	if ( function_exists('et_pb_is_allowed') && et_pb_is_allowed( 'divi_library' ) ) {
		add_meta_box('mhmm-override-meta-box', 'Mhmm', 'mhmm_override_meta_box_markup', '', 'side', 'low', null);
    }
}
add_action('add_meta_boxes', 'add_mhmm_override_meta_box');

function save_mhmm_override_meta_box($post_id, $post, $update) {
    if (!isset($_POST["mhmm-override-nonce"]) || !wp_verify_nonce($_POST["mhmm-override-nonce"], basename(__FILE__))) {
        return $post_id;
    }

    if(!current_user_can("edit_post", $post_id)) {
        return $post_id;
    }

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    // Update meta
    if(isset($_POST["meta-mhmm-header"])) {
        $meta_mhmm_header = $_POST["meta-mhmm-header"];
        update_post_meta($post_id, "meta-mhmm-header", $meta_mhmm_header);
    }   

    if(isset($_POST["meta-mhmm-style"])) {
        $meta_mhmm_style = $_POST["meta-mhmm-style"];
        update_post_meta($post_id, "meta-mhmm-style", $meta_mhmm_style);
    }    
}
add_action("save_post", "save_mhmm_override_meta_box", 10, 3);

/* Menu Layout Meta Box */

function mhmm_menu_layout_meta_box_markup($object) {
    wp_nonce_field(basename(__FILE__), "mhmm-menu-layout-nonce"); ?>
	<p class="post-attributes-label-wrapper">
		<label class="post-attributes-label" for="meta-mhmm-menu-layout-id">Trigger this megamenu by setting the URL of any link to:</label>
	</p>
	<input type="text" name="meta-mhmm-menu-layout-id" value="#mhmm-<?php echo $object->ID; ?>">
    <button class="button button-secondary" id="mhmm-menu-layout-copy-id">Copy</button>
    <hr>
    <p class="post-attributes-label-wrapper">
        <label class="post-attributes-label" for="meta-mhmm-menu-layout-transition">Transition</label>
    </p>
    <select name="meta-mhmm-menu-layout-transition">
        <option value="fade" <?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-transition", true) == 'fade' ? 'selected' : ''; ?>>Fade</option>
        <option value="slide" <?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-transition", true) == 'slide' ? 'selected' : ''; ?>>Slide</option>
        <option value="none" <?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-transition", true) == 'none' ? 'selected' : ''; ?>>None</option>
    </select>
    <hr>
    <p class="post-attributes-label-wrapper">
        <label class="post-attributes-label" for="meta-mhmm-menu-layout-background">Background</label>
    </p>
    <select name="meta-mhmm-menu-layout-background">
        <option value="dark" <?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-background", true) == 'dark' ? 'selected' : ''; ?>>Dark</option>
        <option value="light" <?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-background", true) == 'light' ? 'selected' : ''; ?>>Light</option>
        <option value="none" <?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-background", true) == 'none' ? 'selected' : ''; ?>>None</option>
    </select>
    <hr>
    <p class="post-attributes-label-wrapper">
        <label class="post-attributes-label" for="meta-mhmm-menu-layout-close">Show Close Button <input type="checkbox" name="meta-mhmm-menu-layout-close" value="1" <?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-close", true) == true ? 'checked' : ''; ?>></label>
    </p>
    <div id="mhmm-menu-layout-close-color" style="display: none;">
        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="meta-mhmm-menu-layout-close-color">Close Button Color</label>
        </p>
        <input type="text" name="meta-mhmm-menu-layout-close-color" data-alpha="true" value="<?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-close-color", true) ? get_post_meta($object->ID, "meta-mhmm-menu-layout-close-color", true) : '#000000'; ?>">
        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="meta-mhmm-menu-layout-close-background-color">Close Button Background Color</label>
        </p>
        <input type="text" name="meta-mhmm-menu-layout-close-background-color" data-alpha="true" value="<?php echo get_post_meta($object->ID, "meta-mhmm-menu-layout-close-background-color", true) ? get_post_meta($object->ID, "meta-mhmm-menu-layout-close-background-color", true) : ''; ?>">
    </div>    
	<?php 
}

function add_menu_layout_meta_box() {
    if( isset($_GET['post']) && get_post($_GET['post']) && isset($_GET['action']) && 'edit' == $_GET['action'] ) {
        $post = get_post($_GET['post']);
        if($post->post_type == 'et_pb_layout' && has_term('mhmm_menus', 'layout_category', $post)) {
            if ( function_exists('et_pb_is_allowed') && et_pb_is_allowed( 'divi_library' ) ) {
                add_meta_box('mhmm-menu-layout-meta-box', 'Mhmm - Menu Layout Settings', 'mhmm_menu_layout_meta_box_markup', array('et_pb_layout'), 'side', 'high', null);
            }        
        }
    }	
}
add_action('add_meta_boxes', 'add_menu_layout_meta_box');

function mhmm_menu_layout_save_meta_box($post_id, $post, $update) {
    if (!isset($_POST["mhmm-menu-layout-nonce"]) || !wp_verify_nonce($_POST["mhmm-menu-layout-nonce"], basename(__FILE__))) {
        return $post_id;
    }

    if(!current_user_can("edit_post", $post_id)) {
        return $post_id;
    }

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return $post_id;
    }

    $slugs = array('et_pb_layout', 'post');
    if(!in_array($post->post_type, $slugs)) {
        return $post_id;
    }

    $mhmm_menu_layout_id = '';
    $mhmm_menu_layout_transition = '';
    $mhmm_menu_layout_background = '';
    $mhmm_menu_layout_close = false;
    $mhmm_menu_layout_close_color = '';
    $mhmm_menu_layout_close_background_color = '';
    
    if(isset($_POST["meta-mhmm-menu-layout-id"])) {
        $mhmm_menu_layout_id = $_POST["meta-mhmm-menu-layout-id"];
    }
    update_post_meta($post_id, "meta-mhmm-menu-layout-id", $mhmm_menu_layout_id);

    if(isset($_POST["meta-mhmm-menu-layout-transition"])) {
        $mhmm_menu_layout_transition = $_POST["meta-mhmm-menu-layout-transition"];
    }
    update_post_meta($post_id, "meta-mhmm-menu-layout-transition", $mhmm_menu_layout_transition);

    if(isset($_POST["meta-mhmm-menu-layout-background"])) {
        $mhmm_menu_layout_background = $_POST["meta-mhmm-menu-layout-background"];
    }
    update_post_meta($post_id, "meta-mhmm-menu-layout-background", $mhmm_menu_layout_background);

    if(isset($_POST["meta-mhmm-menu-layout-close"])) {
        if($_POST["meta-mhmm-menu-layout-close"]) {
            $mhmm_menu_layout_close = true;
        }
    }
    update_post_meta($post_id, "meta-mhmm-menu-layout-close", $mhmm_menu_layout_close);

    if(isset($_POST["meta-mhmm-menu-layout-close-color"])) {
        $mhmm_menu_layout_close_color = $_POST["meta-mhmm-menu-layout-close-color"];
    }
    update_post_meta($post_id, "meta-mhmm-menu-layout-close-color", $mhmm_menu_layout_close_color);

    if(isset($_POST["meta-mhmm-menu-layout-close-background-color"])) {
        $mhmm_menu_layout_close_background_color = $_POST["meta-mhmm-menu-layout-close-background-color"];
    }
    update_post_meta($post_id, "meta-mhmm-menu-layout-close-background-color", $mhmm_menu_layout_close_background_color);
}
add_action("save_post", "mhmm_menu_layout_save_meta_box", 10, 3);

/* Body Classes */

add_filter( 'body_class','mhmm_body_classes' );
function mhmm_body_classes( $classes ) {
	global $post;
	if(isset($post)) {
		if(get_post_meta($post->ID, "meta-mhmm-style", true) && get_post_meta($post->ID, "meta-mhmm-style", true) != 'default') {
			$classes[] = get_post_meta($post->ID, "meta-mhmm-style", true);
		}
		else {
	    	$classes[] = get_theme_mod('mhmm_style');
	    }

	    if((get_post_meta($post->ID, "meta-mhmm-header", true) && get_post_meta($post->ID, "meta-mhmm-header", true) != 'default' && get_post_meta($post->ID, "meta-mhmm-header", true) != 'divi_default') || get_theme_mod('mhmm_layout') != 'divi_default') {
	    	$classes[] = 'using-mhmm';
	    }
	    return $classes;
    }
}

function mhmm_enqueue() {
	global $mhmmVersion;

	// Menu CSS
	wp_enqueue_style('mhmm-menus', plugins_url( '/css/mhmm-menus.css', __FILE__ ));

	// Menu Layout CSS
	wp_enqueue_style('mhmm-menu-layout', plugins_url( '/css/mhmm-menu-layout.css', __FILE__ ));

	// Header CSS and JS
	// WooCommerce support
	if(function_exists('is_shop') && is_shop()) {
    	$pageId = get_option( 'woocommerce_shop_page_id' );
    }
    else {
    	$pageId = get_queried_object_id();
    }	
	if(get_post_meta($pageId, "meta-mhmm-header", true) && get_post_meta($pageId, "meta-mhmm-header", true) != 'default') {
		$header_id = get_post_meta($pageId, "meta-mhmm-header", true);
	}
	else if(get_theme_mod('mhmm_layout')) {
		$header_id = get_theme_mod('mhmm_layout');
	}
	if($header_id && get_page_template_slug() != 'page-template-blank.php') {
		if($header_id != 'divi_default') {
			if($header_id == 'disabled') {
				$html = '';
			}
			else {
				$content_post = get_post($header_id);
				$content = $content_post->post_content;
				$html = do_shortcode($content);
			}
			wp_enqueue_script('mhmm', plugins_url( '/js/mhmm.min.js', __FILE__ ), array('jquery'), $mhmmVersion);
		    wp_localize_script( 'mhmm', 'html', $html );
		    wp_enqueue_style('mhmm', plugins_url( '/css/mhmm.css', __FILE__ ));
		}
    }

    // Menu Layouts
    wp_enqueue_script('mhmm-menu-layout', plugins_url( '/js/mhmm-menu-layout.min.js', __FILE__ ), array('jquery'), $mhmmVersion);
    $layouts = array();
    $layoutPosts = get_posts(array(
        'post_type' => 'et_pb_layout',
        'tax_query' => array(
            array(
                'taxonomy'          => 'layout_category',
                'field'             => 'slug',
                'terms'             => 'mhmm_menus'
            ),
        ),
        'posts_per_page'    => -1,
        'numberposts'       => -1
    ));
    foreach($layoutPosts as $layoutPost) {
        $layouts[$layoutPost->ID] = array(
        	'iframe' => '<iframe class="mhmm-menu-layout-iframe" src="' . add_query_arg('mhmm_menu_layout_id', $layoutPost->ID, get_permalink(get_page_by_title('Mhmm Menu Layout Loader'))) . '" scrolling="yes"></iframe>',
            'content' => do_shortcode($layoutPost->post_content),
            'transition' => get_post_meta($layoutPost->ID, "meta-mhmm-menu-layout-transition", true),
            'background' => get_post_meta($layoutPost->ID, "meta-mhmm-menu-layout-background", true),
            'close' => get_post_meta($layoutPost->ID, "meta-mhmm-menu-layout-close", true),
            'close_color' => get_post_meta($layoutPost->ID, "meta-mhmm-menu-layout-close-color", true),
            'close_background_color' => get_post_meta($layoutPost->ID, "meta-mhmm-menu-layout-close-background-color", true)
        );
    }
    wp_localize_script( 'mhmm-menu-layout', 'mhmm_menu_layout', array(
    	'ajaxurl' => admin_url('admin-ajax.php'),
        'layouts' => $layouts
    ));
}
add_action( 'wp_enqueue_scripts', 'mhmm_enqueue' );

function mhmm_update_customizer( $postid ) {
	global $post_type;
	if($post_type == 'et_pb_layout') {
		// Remove theme customizer setting if selected layout is deleted
		if(has_term('mhmm_headers', 'layout_category', $postid)) {
			if(get_theme_mod('mhmm_layout') == $postid) {
				remove_theme_mod('mhmm_layout');
			}
		}
    }
}
add_action( 'wp_trash_post', 'mhmm_update_customizer' );

function mhmm_customizer_enqueue() {
	global $mhmmVersion;
	wp_enqueue_script('mhmm-admin-customizer', plugins_url( '/js/mhmm-admin-customizer.min.js', __FILE__ ), array('jquery'), $mhmmVersion, true);
}
add_action( 'customize_controls_enqueue_scripts' , 'mhmm_customizer_enqueue');

function mhmm_admin_enqueue() {
    // CSS
	wp_enqueue_style('mhmm-admin', plugins_url( '/css/mhmm-admin.css', __FILE__ ));	
	wp_enqueue_style( 'wp-color-picker');

	// JS
	global $post;
	global $mhmmVersion;
	wp_enqueue_script( 'wp-color-picker');
	wp_enqueue_script('mhmm-admin', plugins_url( '/js/mhmm-admin.min.js', __FILE__ ), array('jquery', 'wp-color-picker'), $mhmmVersion);
    wp_localize_script( 'mhmm-admin', 'mhmm_admin_data', array('admin_url' => get_admin_url(null, '/customize.php?et_customizer_option_set=theme')));
}
add_action( 'admin_enqueue_scripts', 'mhmm_admin_enqueue' );

// Intialize these custom modules if the Builder is being used
add_action( 'et_builder_ready', 'Mhmm_Custom_Modules');

function Mhmm_Custom_Modules(){
    if(class_exists("ET_Builder_Module")){
       include("mhmm-menu-module.php");
       include("mhmm-inline-menu-module.php");
       include("mhmm-menu-layout-module.php");
    }
}

// Admin Notice
/*
function mhmm_admin_notice(){
    global $pagenow;
    if($pagenow == 'plugins.php') {
    	echo '<div class="notice notice-warning is-dismissible"><h3></h3><p></p></div>';
	}
}
add_action('admin_notices', 'mhmm_admin_notice');
*/

//=====  API LICENSING ========
if ( ! class_exists( 'superfly_mhmm_license' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'superfly-mhmm-license-menu.php' );
	global $superfly_mhmm_license;
	global $mhmmVersion;
	$superfly_mhmm_license = new superfly_mhmm_license( __FILE__, 'Mighty Header & Menu Maker', $mhmmVersion, 'plugin', 'https://besuperfly.com/', '', '' );
}

// Make it harder to find latest version. Keeps the honest people honest.
$updater = base64_decode('aHR0cHM6Ly9iZXN1cGVyZmx5LmNvbS90aGVtZXMtcGx1Z2lucy11cGRhdGVyL3BhY2thZ2VzL21obW0vbWhtbS5qc29u');

require 'plugin-update-checker/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    $updater,
    __FILE__,
    'mhmm'
);