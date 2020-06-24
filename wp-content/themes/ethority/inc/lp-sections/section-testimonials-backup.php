<?php
/**
 * Template for displaying testimonials section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_testimonials_id'); ?>" class="testimonials boxed">

	<div class="section-header">
		<h3 class="title">
			<?php
			/**
			 *	Finds 'text to highlight' in the title and return highlighted title.
			 *
			 *	eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
			 */
			echo eth_filter_title( ot_get_option('eth_testimonials_title'), ot_get_option('eth_testimonials_title_highlight') );
			?>
		</h3>

		<div class="description">
			<?php echo do_shortcode( ot_get_option( 'eth_testimonials_subtitle' ) ); ?>
		</div>
	</div> <!-- /.section-header -->


	<?php
	$testimonials = ot_get_option( 'eth_testimonials_list', array() );
	if ( ! empty( $testimonials ) ) {
		foreach( $testimonials as $key => $testimonial ) {
		?>
		<div class="testimonial">
			<div class="container">

				<?php if ( $key % 2 == 0 ) : // even numbers ?>
				<div class="three columns">
					<img src="<?php echo $testimonial['eth_testimonial_avatar']; ?>">
				</div>
				<?php endif; ?>


				<div class="thirteen columns">
					<div class="profile">
						<span class="name"><?php echo $testimonial['eth_testimonial_name']; ?></span>

						<div class="ratings">
							<?php
							$rating = $testimonial['eth_testimonial_rating'];

							if ( '' == $rating ) {
								echo '<i></i>';
							} elseif ( substr( $rating, -1 ) == 5 && strlen( trim( $rating ) ) > 2 ) {
								// if $rating has a 0.5 decimal (1.5, 2.5, etc)
								for ( $x = 1; $x <= $rating; $x++ ) {
									echo '<i class="fa fa-star"></i>';
								}

								echo '<i class="fa fa-star-half-empty"></i>';

								// fill the rest with empty stars
								if ( ( 5 - $rating ) >= 1 ) {
									for ( $x = 1; $x <= ( 5 - $rating ); $x++ ) {
										echo '<i class="fa fa-star-o"></i>';
									}
								}

							} else {
							// if $rating is a whole number (1, 2, etc)
								for ( $x = 1; $x <= $rating; $x++ ) {
									echo '<i class="fa fa-star"></i>';
								}

								// fill the rest with empty stars
								if ( ( 5 - $rating ) >= 1 ) {
									for ( $x = 1; $x <= ( 5 - $rating ); $x++ ) {
										echo '<i class="fa fa-star-o"></i>';
									}
								}
							}
							?>

						</div> <!-- /.ratings -->

						<p><?php echo $testimonial['eth_testimonial_message']; ?></p>

					</div> <!-- /.profile -->
				</div> <!-- /.thirteen columns -->


				<?php if ( $key % 2 !== 0 ) : // odd numbers ?>
				<div class="three columns">
					<img src="<?php echo $testimonial['eth_testimonial_avatar']; ?>">
				</div>
				<?php endif; ?>

			</div> <!-- /.container -->
		</div> <!-- /.testimonial -->
		<?php
		}
	}
	?>

</section> <!-- #testimonials -->