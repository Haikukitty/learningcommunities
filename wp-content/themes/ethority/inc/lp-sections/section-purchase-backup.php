<?php
/**
 * Template for displaying purchase section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_pricetable_id'); ?>" class="purchase boxed">

	<div class="section-header">
		<h3 class="title">
			<?php
			/**
			 *	Finds 'text to highlight' in the title and return highlighted title.
			 *
			 *	eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
			 */
			echo eth_filter_title( ot_get_option('eth_pricetable_title'), ot_get_option('eth_pricetable_title_highlight') );
			?>
		</h3>

		<div class="description">
			<?php echo do_shortcode( ot_get_option( 'eth_pricetable_subtitle' ) ); ?>
		</div>
	</div> <!-- /.section-header -->



	<div class="container">
		<div class="sixteen columns">

			<?php
			$tables = ot_get_option( 'eth_pricetable_list', array() );
			if ( ! empty( $tables ) ) {
				foreach( $tables as $table ) {
				?>
					<div class="price-table <?php if ( $table['eth_pricetable_recommended'] == 'on' ) echo 'recommended'; ?>">
						<h4 class="price-table-title"><?php echo $table['eth_pricetable_title']; ?></h4>

						<div class="price">
							<p><?php echo $table['eth_pricetable_price']; ?></p>

						</div>

						<div class="price-table-description">
							<?php echo $table['eth_pricetable_desc']; ?>
						</div> <!-- /.price-table-description -->

						<?php if ( $table['eth_pricetable_button_link'] ) : ?>
							<a href="<?php echo esc_url( $table['eth_pricetable_button_link'] ); ?>" class="button"><?php echo do_shortcode( $table['eth_pricetable_button_text'] ); ?></a>
						<?php else : ?>
							<?php echo do_shortcode( $table['eth_pricetable_button_text'] ); ?>
						<?php endif; ?>
					</div> <!-- /.price-table -->
				<?php
				}
			}
			?>

		</div> <!-- /.sixteen columns -->
	</div> <!-- /.container -->

</section> <!-- #purchase -->