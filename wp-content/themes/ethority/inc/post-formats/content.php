<?php
/**
 * Template for displaying a standard post.
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-article'); ?>>

	<div class="post-body clearfix">

		<?php if ( is_sticky() && !is_single() ) : ?>
			<div class="post-sticky">
				<i class="fa fa-asterisk"></i>
			</div> <!-- /..post-sticky -->
		<?php endif; ?>


		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div> <!-- /.post-thumbnail -->

		<?php if ( !is_page() ) : ?>
			<h2 class="post-title">
			  <a href="<?php esc_url( the_permalink() ); ?>" class="post-title-link"><?php the_title(); ?></a>
			</h2>

			<div class="post-meta">

				<?php
				/**
				*	display post meta data @ /inc/eth-functions.php
				*/
				eth_post_meta();

				?>
	  	</div> <!-- /.post-meta -->

  	<?php endif; // !is_page() ?>

		<div class="post-content">

			<?php the_content( __( 'Read More', 'eth-theme' ) ); ?>


			<?php if ( !is_home() ) : ?>
				<?php
					// Post content numbered pagination
					wp_link_pages( array(
						'before'      => '<nav class="post-page-pagination">',
						'after'       => '</nav> <!-- /.post-page-pagination -->',
						'link_before' => '<span>',
						'link_after'  => '</span>'
					) );
				?>
		  <?php endif; // !is_home() ?>

		</div> <!-- /.post-content -->

	</div> <!-- /.post-body -->

</article> <!-- /.post-article -->