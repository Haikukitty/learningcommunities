<?php
/**
 * Template for displaying contact section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_contact_id'); ?>" class="contact boxed">

	<div class="section-header">
		<h3 class="title">
			<?php
			/**
			 *	Finds 'text to highlight' in the title and return highlighted title.
			 *
			 *	eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
			 */
			echo eth_filter_title( ot_get_option('eth_contact_title'), ot_get_option('eth_contact_title_highlight') );
			?>
		</h3>

		<div class="description">
			<?php echo do_shortcode( ot_get_option( 'eth_contact_subtitle' ) ); ?>
		</div>
	</div> <!-- /.section-header -->


	<div class="container">
		<div class="twelve columns offset-by-two">

			<?php
			/**
			*	Contact Form 7
			*/
			echo do_shortcode( ot_get_option( 'eth_contact_shortcode' ) );
			?>

		</div>
	</div> <!-- /.container -->

</section> <!-- #contact -->