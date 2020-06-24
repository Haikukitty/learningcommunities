<?php
/**
 * Template for displaying the landing page.
 *
 * Template Name: Landing Page
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<?php get_header(); ?>

<?php
$eth_sections = ot_get_option( 'eth_lp_layout', array() );

if ( !empty( $eth_sections ) ) {
	foreach ( $eth_sections as $eth_section ) {
		get_template_part( 'inc/lp-sections/' . $eth_section['eth_lp_section'] );
	}
}
?>

<?php get_footer(); ?>