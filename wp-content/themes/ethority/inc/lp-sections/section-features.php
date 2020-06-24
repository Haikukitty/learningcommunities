<?php
/**
 * Template for displaying features section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_features_id'); ?>" class="features boxed">

	<div class="section-header">
		<h3 class="title" style="line-height: 50px;">
				<?php
				/**
				 *	Finds 'text to highlight' in the title and return highlighted title.
				 *
				 *	eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
				 */
				echo eth_filter_title( ot_get_option('eth_features_title'), ot_get_option('eth_features_title_highlight') );
				?>
			</h3>

		<div class="description">
			<?php // echo ot_get_option('eth_features_subtitle'); ?>


			<?php echo do_shortcode(ot_get_option('eth_features_subtitle')); ?>
		</div>
	</div> <!-- /.section-header -->


	<?php
	$features = ot_get_option( 'eth_features_list', array() );
	if ( ! empty( $features ) ) {
		foreach( $features as $feature ) {
		?>
		<div class="feature">
			<div class="container">

				<div class="sixteen columns">

					<div class="feature-icon"><i class="fa <?php echo $feature['eth_feature_icon']; ?>"></i></div>

					<div class="feature-title"><?php echo $feature['eth_feature_title']; ?></div>

					<div class="feature-description">
						<?php echo $feature['eth_feature_desc']; ?>
					</div> <!-- /.feature-description -->

				</div> <!-- /.sixteen columns -->

			</div> <!-- /.container -->
		</div> <!-- /.feature -->
		<?php
		}
	}
	?>

</section> <!-- #features -->