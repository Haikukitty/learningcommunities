<?php
/**
 * Template for displaying overview section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_overview_id'); ?>" class="overview boxed">

	<div class="section-header">
		<h3 class="title">
			<?php
			/**
			 *	Finds 'text to highlight' in the title and return highlighted title.
			 *
			 *	eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
			 */
			echo eth_filter_title( ot_get_option('eth_overview_title'), ot_get_option('eth_overview_title_highlight') );
			?>
		</h3>

		<div class="description">
			<?php echo do_shortcode( ot_get_option('eth_overview_subtitle') ); ?>
		</div>
	</div> <!-- /.section-header -->


	<div class="container">

		<div class="sixteen columns">

				<?php
				$chapters = ot_get_option( 'eth_overview_list', array() );
				if ( ! empty( $chapters ) ) {
					foreach( $chapters as $chapter ) {
					?>
					<div class="chapter-block">
						<h4 class="chapter-no"><?php echo $chapter['eth_overview_content']; ?></h4>

						<div class="chapter-preview-img">
							<?php if ( ! empty( $chapter['eth_overview_content_image_link'] ) ) : ?>
								<a href="<?php echo esc_url( $chapter['eth_overview_content_image_link'] ); ?>">
									<img src="<?php echo $chapter['eth_overview_content_image']; ?>">
								</a>
							<?php else : ?>
								<img src="<?php echo $chapter['eth_overview_content_image']; ?>">
							<?php endif; ?>
						</div> <!-- /.chapter-preview-img -->

						<h5 class="chapter-title"><?php echo $chapter['eth_overview_content_title']; ?></h5>

						<p>
							<?php echo $chapter['eth_overview_content_desc']; ?>
						</p>
					</div> <!-- /.chapter-block -->
					<?php
					}
				}
				?>

		</div> <!--- /.sixteen columns -->


		<div class="sixteen columns product-sample">
			<?php if ( ot_get_option('eth_overview_dl_link') ) : ?>
			<a href="<?php echo esc_url( ot_get_option('eth_overview_dl_link') ); ?>" class="button dl-link" <?php echo eth_link_target( ot_get_option('eth_testing') ); ?>
			>
				<?php echo ot_get_option('eth_overview_dl_text'); ?>
			</a>
			<?php endif; ?>

			<?php if ( ot_get_option('eth_overview_product_image') ) : ?>
				<img src="<?php echo ot_get_option('eth_overview_product_image'); ?>" />
			<?php endif; ?>
		</div> <!-- /.product-sample -->

	</div> <!-- /.container -->

</section> <!-- #overview -->