<?php
 /*
 ** Plugin Name: Divi Hacks Lite
 ** Version: 1.3	
 ** Plugin URI: https://divihacks.com
 ** Description: Simple and elegant hacks to visually power up your Divi website
 ** Author: Divi Hacks
 ** Author URI: https://divihacks.com
 */

define( 'DIVI_HACKS_VERSION', '1.3' );
define( 'HACKS_URL', plugin_dir_url( __FILE__ ) );
require dirname(__FILE__).'/updater/updater.php';
require dirname(__FILE__).'/plugin-update-checker-4-4/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://divihacks.com/wp-content/divi-hacks-lite-update/plugin.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'divi-hacks-settings'
);
require ( 'register-hacks.php' ); // Switch Array

function dh_switch_plugin_styles() { 
    wp_enqueue_style( 'hacks-styles', HACKS_URL . 'scripts/hacks-style.css',true,'1.3','all'); // Styles
    wp_enqueue_script( 'dh-jquery', HACKS_URL . 'scripts/dh_snippets.js', array( 'jquery' ), '1.3', true ); // jQuery
    wp_enqueue_script( 'dh-sticky', HACKS_URL . 'scripts/jquery.sticky.js', array( 'jquery' ), '1.3', true ); // jQuery
}

function dh_switch_plugin_admin_styles() { 
    wp_enqueue_style('hacks_admin', HACKS_URL . 'scripts/plugin_admin.css',true,'1.3','all'); 
}
add_action( 'admin_enqueue_scripts', 'dh_switch_plugin_admin_styles' );

function dh_switch_setting_set($key, $val) {
	global $dh_switch_matrix;
	foreach ($dh_switch_matrix as $switch) {
		if ($switch['option'] == $key) {
			update_option( "dh_{$key}", $val );
			return true;
		}
	}
	return false;
}
function dh_switch_setting_get($key, $default = false) {
	return get_option( "dh_{$key}", $default);
}
function dh_switch_admin_head_scripts() {   
?>
<script type="text/javascript" id="Gritty_WidgetLinks">

(function($) {
    $(function() {
        $("LABEL[for^=myonoffswitch]")
        .each(function() {
            // ------------------------------ Which label was clicked? -----------------------------------
            var which = $(this).attr("for");
            var cls = $(this).data("class");
            if ( $("INPUT[id=" + which + "]").is(":checked") ) {
                $("BODY").addClass(cls);
            } else {
                $("BODY").removeClass(cls);
            }

            $(this).parents(".onoffswitch").on("click", function() {
                if (!$("INPUT[id=" + which + "]").is(":checked")) {
                    $("BODY").addClass(cls);
                } else {
                    $("BODY").removeClass(cls);
                }

                var val = $("INPUT[id=" + which + "]").is(":checked") ? "1" : "0";
                console.info("Set " + which + " to " + val)

                $.ajax({
                    url: './',
                    type: "POST",
                    data: $("INPUT[id=" + which + "]").attr("name") + "=" + val + "&<?php echo MD5("DiviHacks");?>=1", //Hat tip to Terry @ https://www.facebook.com/mizagorn/ for fixing the save state issue.
                    success: function (response) {
                    },
                    error: function (jqXhr, e, responseText) {
                        console.log(arguments);
                        alert("Oops. Something went wrong: " + responseText);
                    }
                });
            });
        });
    });
})(jQuery);

</script>
<?php
}

// End Create Switch Array ------------------------------------------------------------------------------------

// Settings Menu Item -----------------------------------------------------------------------------------------


class divi_hacks_settings {

    public function __construct () { add_action('admin_menu', array(&$this, 'dh_admin_menu'), 100); 
                                   }

    function dh_admin_menu() {
		//$page = add_submenu_page('admin.php', 'Divi Hacks', 'Divi Hacks', 'manage_options', 'divi-hack-settings', array(&$this, 'switch_page'));
		add_submenu_page('admin.php?divi-hacks-settings', 'Options', 'Options', 'manage_options', 'wiki-options', array(&$this, 'switch_page') );
		add_submenu_page(
			'et_divi_options',
		__( 'Divi Hacks', 'Divi' ), 
		__( 'Divi Hacks', 'Divi' ),
			'manage_options', 
			'divi-hacks-settings', 
			array(&$this, 'switch_page'));
	}
	
// Switch Settings Page ------------------------------------------------------------------

function switch_page() {
	if (!Divi_Hacks_has_license_key()) {
		return Divi_Hacks_activate_page();
	}
if( isset( $_GET[ 'tab' ] ) ) {

$active_tab = $_GET[ 'tab' ];

} else {

// Default Tab = Header Options ----------------------------------------------------------

$active_tab = 'all_options' ;

} ?>

<div class="btt-button"><a href="#top">^</a></div>
<div class="hacks-page">
	<div class="hacks-header">
		<div class="hacks-title">
			<h1><a href="https://divihacks.com" target="_blank">Divi Hacks <span>Lite</span></a></h1>
		   	<span class="customizer-link"><a href="https://divihacks.com/plugin" target="_blank">Upgrade to PRO</a></span>
		</div>
		<div class="hacks-nav">
			<h2 class="nav-tab-wrapper">
				<a href="?page=divi-hacks-settings&tab=all_options" class="nav-all nav-tab <?php echo $active_tab == 'all_options' ? 'nav-tab-active' : ''; ?>">All</a>
				<a href="?page=divi-hacks-settings&tab=background_options" class="nav-background nav-tab <?php echo $active_tab == 'background_options' ? 'nav-tab-active' : ''; ?>">Background</a>
				<a href="?page=divi-hacks-settings&tab=footer_options" class="nav-footer nav-tab <?php echo $active_tab == 'footer_options' ? 'nav-tab-active' : ''; ?>">Footer</a>
				<a href="?page=divi-hacks-settings&tab=alignment_options" class="nav-alignment nav-tab <?php echo $active_tab == 'alignment_options' ? 'nav-tab-active' : ''; ?>">Alignment</a>
				<a href="?page=divi-hacks-settings&tab=design_options" class="nav-design nav-tab <?php echo $active_tab == 'design_options' ? 'nav-tab-active' : ''; ?>">Design</a>
				<a href="?page=divi-hacks-settings&tab=mobile_options" class="nav-mobile nav-tab <?php echo $active_tab == 'mobile_options' ? 'nav-tab-active' : ''; ?>">Mobile</a>
				<a href="?page=divi-hacks-settings&tab=blog_options" class="nav-blog nav-tab <?php echo $active_tab == 'blog_options' ? 'nav-tab-active' : ''; ?>">Blog</a>
				<a href="?page=divi-hacks-settings&tab=animation_options" class="nav-animation nav-tab <?php echo $active_tab == 'animation_options' ? 'nav-tab-active' : ''; ?>">Animation</a>
				<a href="?page=divi-hacks-settings&tab=icon_options" class="nav-icon nav-tab <?php echo $active_tab == 'icon_options' ? 'nav-tab-active' : ''; ?>">Icon</a>
				<a href="?page=divi-hacks-settings&tab=admin_options" class="nav-admin nav-tab <?php echo $active_tab == 'admin_options' ? 'nav-tab-active' : ''; ?>">Admin</a>
				<a href="?page=divi-hacks-settings&tab=auto_options" class="nav-auto-on nav-tab <?php echo $active_tab == 'auto_options' ? 'nav-tab-active' : ''; ?>">Auto-On</a>
				<a href="?page=divi-hacks-settings&tab=about" class="nav-about nav-tab <?php echo $active_tab == 'about' ? 'nav-tab-active' : ''; ?>">About &amp; License Key</a>
			</h2>
		</div>
	</div>
    <div class="page-container">
   <?php
	if ($active_tab == 'about') {
		Divi_Hacks_license_key_box(); 
	} else { ?>
		<div class="onoffswitch-all">
			<button id="openall" >Show all Descriptions</button>
			<button id="closeall" class="hidden">Hide all Descriptions</button>
		</div>
	<?php
    // Switch Matrix -----------------------------------------------------------
    global $dh_switch_matrix;
    for ( $i = 0; $i < count($dh_switch_matrix); $i++ ) {
        $obj = $dh_switch_matrix[$i];
        $n = ($i+1);
        $opt = isset($obj['option'])?$obj['option']:"unknown_{$n}";
    ?>
    <script>
    // Toggle Descriptions -----------------------------------------------------
    jQuery(document).ready(function($){
        $("#hack-<?php echo $n;?> .divi-hacks-open-info").click(function(){
        	$("#hack-<?php echo $n;?> .divi-hacks-description").toggleClass("visible");
        });
        $("#hack-<?php echo $n;?> .divi-hacks-open-info").click(function(){
        	$("#hack-<?php echo $n;?> .divi-hacks-open-info").toggleClass("open");
        });
    	$("#openall").click(function(){
			$(".divi-hacks-description").addClass("visible");
			$(".divi-hacks-open-info").addClass("open");
			$("#openall").addClass("hidden").removeClass("visible");
			$("#closeall").removeClass("hidden").addClass("visible");
		});
		$("#closeall").click(function(){
			$(".divi-hacks-description").removeClass("visible");
			$(".divi-hacks-open-info").removeClass("open");
			$("#closeall").addClass("hidden").removeClass("visible");
			$("#openall").removeClass("hidden").addClass("visible");
		});
	});
    </script>
    <div class="divi-hack <?php echo isset($obj['category'])?$obj['category']:"uncategorized";?>" id="hack-<?php echo $n;?>">
        <div class="image-container">
            <img src="<?php echo plugins_url( isset($obj['image'])?$obj['image']:"images/placeholder.png", __FILE__ ) ?>" >
        </div>
        <div class="title-area">
            <h3><?php echo isset($obj['title'])?$obj['title']:"Unknown";?></h3>
            <p><?php echo isset($obj['more'])?$obj['more']:"No code selected";?></p>
        </div>
        <div class="onoffswitch">
            <input type="checkbox" name="<?php echo $opt;?>" class="onoffswitch-checkbox" id="myonoffswitch-<?php echo $n;?>" value="true"<?php echo (dh_switch_setting_get($opt, '0') == '0' ? "" : " checked='checked'");?> /> 
            <label class="onoffswitch-label" for="myonoffswitch-<?php echo $n;?>" data-class="<?php echo $obj['class'];?>">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        <span class="more-button divi-hacks-open-info"></span>
        <div class="divi-hacks-description info-container">
          <p><?php echo isset($obj['description'])?$obj['description']:"No description";?></p>
        </div>
    </div>

<?php
}
}
?>
</div>
</div>
    
<style type="text/css">

/** Splitting Switches into tabs **/

.divi-hack { display: block; } 

<?php if( $active_tab == 'all_options' ) {?>

.divi-hack { display: block !important; }

<?php } if( $active_tab == 'background_options' ) {?>

.divi-hack:not(.background) { display: none; }

<?php } else if( $active_tab == 'header_options' ) {?>

.divi-hack:not(.header) { display: none; }

<?php } else if( $active_tab == 'footer_options' ) {?>

.divi-hack:not(.footer) { display: none; }

<?php } else if( $active_tab == 'alignment_options' ) {?>

.divi-hack:not(.alignment) { display: none; }

<?php } else if( $active_tab == 'design_options' ) {?>

.divi-hack:not(.design) { display: none; }

<?php } else if( $active_tab == 'mobile_options' ) {?>

.divi-hack:not(.mobile) { display: none; }

<?php } else if( $active_tab == 'blog_options' ) {?>

.divi-hack:not(.blog) { display: none; }

<?php } else if( $active_tab == 'animation_options' ) {?>

.divi-hack:not(.animation) { display: none; }

<?php } else if( $active_tab == 'icon_options' ) {?>

.divi-hack:not(.icon) { display: none; }

<?php } else if( $active_tab == 'admin_options' ) {?>

.divi-hack:not(.admin) { display: none; }

<?php } else if( $active_tab == 'other_options' ) {?>

.divi-hack:not(.other) { display: none; }

<?php } else if( $active_tab == 'auto_options' ) {?>

.divi-hack:not(.auto-on) { display: none; }

<?php } else if( $active_tab == 'about' ) {?>

.divi-hack:not(.about) { display: none; }

<?php } ?>
</style>
<?php
}
}
new divi_hacks_settings();



function dh_switch_init() {
	if (Divi_Hacks_has_license_key()) {
	//if(true) {

		add_filter( 'body_class', 'dh_switch_classes' );
		add_action( 'admin_head', 'dh_switch_admin_head_scripts' );
		add_action( 'wp_enqueue_scripts', 'dh_switch_plugin_styles' );
	}
}
add_action('plugins_loaded', 'dh_switch_init');

function dh_switch_admin_init() {
	if ( isset($_POST[MD5("DiviHacks")]) && current_user_can('manage_options') ) {
		foreach ( $_POST as $key => $val ) {
			if ( preg_match("/^(0|1)$/", $val ) ) dh_switch_setting_set($key, $val);
		}
		exit(1);
	}
}
add_action('admin_init', 'dh_switch_admin_init');

// Adds items to front-end admin bar menu
function better_mobile_edit_menu_divi() {
	global $wp_admin_bar;
	
	if( current_user_can('editor') || current_user_can('administrator') ) {

		$wp_admin_bar->add_menu(array('parent' => 'edit', 'title' => __('Edit in Backend'), 'id' => 'be-edit', 'href' => get_edit_post_link()));
		$wp_admin_bar->add_menu(array('parent' => 'edit', 'title' => __('Edit in Visual Builder'), 'id' => 'vb-edit', 'href' => get_permalink().'?et_fb=1'));
		$wp_admin_bar->add_menu(array('parent' => 'appearance', 'title' => __('Theme Options'), 'id' => 'themeoptions', 'href' => get_site_url().'/wp-admin/admin.php?page=et_divi_options'));
		$wp_admin_bar->add_menu(array('parent' => 'appearance', 'title' => __('Divi Library'), 'id' => 'divilibrary', 'href' => get_site_url().'/wp-admin/edit.php?post_type=et_pb_layout'));
		$wp_admin_bar->add_menu(array('parent' => 'appearance', 'title' => __('Plugins'), 'id' => 'plugins', 'href' => get_site_url().'/wp-admin/plugins.php'));
		$wp_admin_bar->add_menu(array('parent' => 'appearance', 'title' => __('Pages'), 'id' => 'pages', 'href' => get_site_url().'/wp-admin/edit.php?post_type=page'));
		$wp_admin_bar->add_menu(array('parent' => 'appearance', 'title' => __('Posts'), 'id' => 'posts', 'href' => get_site_url().'/wp-admin/edit.php'));
		$wp_admin_bar->add_menu(array('parent' => 'appearance', 'title' => __('Divi Hacks'), 'id' => 'divi-hacks', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=all_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'All'), 'id' => 'divi-hacks-all', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=all_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Background'), 'id' => 'divi-hacks-background', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=background_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Header'), 'id' => 'divi-hacks-header', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=header_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Footer'), 'id' => 'divi-hacks-footer', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=footer_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Alignment'), 'id' => 'divi-hacks-alignment', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=alignment_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Design'), 'id' => 'divi-hacks-design', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=design_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Mobile'), 'id' => 'divi-hacks-mobile', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=mobile_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Blog'), 'id' => 'divi-hacks-blog', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=blog_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Animation'), 'id' => 'divi-hacks-animation', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=animation_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Icon'), 'id' => 'divi-hacks-icon', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=icon_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Admin'), 'id' => 'divi-hacks-admin', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=admin_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Auto-on'), 'id' => 'divi-hacks-auto-on', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=auto_options'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'About'), 'id' => 'divi-hacks-about', 'href' => get_site_url().'/wp-admin/admin.php?page=divi-hacks-settings&tab=about'));
		$wp_admin_bar->add_menu( array('parent' => 'divi-hacks', 'title' => __( 'Hacks Customizer'), 'id' => 'divi-hacks-customizer', 'href' => get_site_url().'/wp-admin/customize.php?autofocus[panel]=divi_hack_options'));
	
	}
	
}
add_action('admin_bar_menu', 'better_mobile_edit_menu_divi', 90);

// Add 'edit in visual builder' link to wordpress pages table
function edit_in_vb($actions, $page_object)
{
   $actions['edit_link'] = '<a href="' . get_permalink() . '?et_fb=1" class="edit_link">' . __('Edit in Visual Builder') . '</a>';
 
   return $actions;
}
add_filter('page_row_actions', 'edit_in_vb', 10, 2);
add_filter('post_row_actions', 'edit_in_vb', 10, 2);

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );
	function add_action_links ( $links ) {
 		$mylinks = array(
 			'<a href="' . admin_url( 'admin.php?page=divi-hacks-settings' ) . '">Settings</a>',
 			'<a href="https://divihacks.com/docs" target="_blank">Documentation</a>'
 		);
	return array_merge( $links, $mylinks );
}

/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function dh_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'dh_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
		return;
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if( $meta_key == '_wp_old_slug' ) continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_dh_duplicate_post_as_draft', 'dh_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function dh_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=dh_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'dh_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'dh_duplicate_post_link', 10, 2);