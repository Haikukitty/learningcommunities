<?php
/**
* Plugin Name: DP Portfolio Posts Pro
* Plugin URI: http://www.diviplugins.com/divi/portfolio-posts-pro-plugin/
* Description: Creates three new portfolio modules that load posts in place of projects. It also adds the option to open images in a lightbox for each module.
* Version: 1.2.3
* Author: DiviPlugins
* Author URI: http://www.diviplugins.com
**/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$is_admin = is_admin();

$action_hook = $is_admin ? 'wp_loaded' : 'wp';

function dp_inc_mods() {

	global $pagenow, $is_admin;
	
	$required_admin_pages = array( 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit­tags.php', 'admin-ajax.php' );
	$specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
	
	if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages )  && ( ! in_array( $pagenow, $specific_filter_pages ) ) )) {
	
		require 'includes/dp_blog_portfolio.php';
		require 'includes/dp_filterable_blog.php';
		require 'includes/dp_fullwidth_blog.php';
		require 'includes/functions.php';
	
	}

}

add_action($action_hook,'dp_inc_mods');
	
// REGISTER ADMIN STYLES
function register_dp_plugin_admin_styles() {
wp_register_style('db-portfolio-posts-pro-css', plugin_dir_url( __FILE__ ) . '/admin/css/style.css', false, '1.0.0' );
wp_enqueue_style( 'db-portfolio-posts-pro-css' );
wp_enqueue_script( 'db-portfolio-posts-pro-js', plugin_dir_url( __FILE__ ) . 'admin/js/functions.js' );
}

add_action( 'admin_enqueue_scripts', 'register_dp_plugin_admin_styles' );

// REGISTER STYLES
function register_dp_plugin_module_styles() {
wp_register_style('db-portfolio-posts-pro-css', plugin_dir_url( __FILE__ ) . '/css/style.css', false, '1.0.0' );
wp_enqueue_style( 'db-portfolio-posts-pro-css' );
}

add_action( 'wp_enqueue_scripts', 'register_dp_plugin_module_styles' );

// HELPER FUNCTIONS

if ( ! function_exists( 'dp_divi_get_projects' ) ) :
	function dp_divi_get_projects( $args = array() ) {
	$default_args = array(
		'post_type' => 'post',
	);
	$args = wp_parse_args( $args, $default_args );
	return new WP_Query( $args );
	}
endif;

if ( ! function_exists( 'dp_the_excerpt_max_charlength' ) ) :

function dp_the_excerpt_max_charlength($excerpt_limit, $lightbox, $show_more, $custom_url, $post_url, $carousel) {
	$excerpt = get_the_excerpt();
	$charlength = $excerpt_limit;
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut ).'...';
		} else {
			echo $subex;
		}
		if (( ($show_more == 'on') && ($lightbox == 'off') && ($carousel == 'off')) || (($custom_url == 'on') && ($carousel == 'off'))) {
			$more_link = sprintf( ' <a href="%1$s" class="more-link" >%2$s</a>' , $post_url, __( 'Read More', 'et_builder' ) );
			echo $more_link;
		}
	}
	else {
		echo $excerpt;
	}
}
endif;



?>