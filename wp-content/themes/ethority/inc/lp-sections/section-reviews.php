<?php
/**
 * Template for displaying reviews section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_reviews_id'); ?>" class="reviews boxed-mini">
	<div class="reviews-wrap">
		<div class="owl-carousel">

			<?php
			$reviews = ot_get_option( 'eth_reviews_list', array() );
			if ( ! empty( $reviews ) ) {
				foreach( $reviews as $review ) {
				?>
				<blockquote>
					<i class="fa fa-quote-left"></i>

					<p><?php echo $review['eth_review_quote']; ?></p>
					<span class="source">- <?php echo $review['eth_review_source']; ?></span>
				</blockquote>
				<?php
				}
			}
			?>

		</div> <!-- /.owl-carousel -->
	</div> <!-- /.reviews-wrap -->
</section> <!-- #reviews -->