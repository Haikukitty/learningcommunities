<?php
/**
 * Template for displaying a single post.
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>

<?php get_header(); ?>

<section class="blog-page-header boxed-mini">
  <div class="section-header">
    <h1><?php echo ot_get_option('eth_blog_page_title'); ?></h1>
  </div> <!-- /.blog-page-title -->
</section> <!-- /.blog-page-header -->

<section class="blog-page-content boxed">
  <div class="container">

    <div class="eleven columns">
      <?php
      // Start loop
      while ( have_posts() ) : the_post();

        // content
        get_template_part( 'inc/post-formats/content', get_post_format() );
        ?>

        <div class="adj-post-navigation clearfix">

          <?php if ( get_previous_post() ) : ?>
          <div class="prev-post">
            <?php previous_post_link( '%link', '<i class="fa fa-arrow-left"></i> %title' ); ?>
          </div> <!-- /.previous-post -->
          <?php endif; ?>

          <?php if ( get_next_post() ) : ?>
          <div class="next-post">
            <?php next_post_link( '%link', '%title <i class="fa fa-arrow-right"></i>' ); ?>
          </div> <!-- /.next-post -->
          <?php endif; ?>

        </div> <!-- /.adj-post-navigation -->

        <?php

        // If comments are allowed OR there is at least 1 comment
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        }

      endwhile;
      ?>
    </div> <!-- /.eleven columns -->

    <div class="four columns offset-by-one">
      <div class="sidebar">
        <?php get_sidebar(); ?>
      </div> <!-- /.sidebar -->
    </div> <!-- /.four columns -->

  </div> <!-- /.container -->
</section> <!-- /.blog-page-content -->

<?php get_footer(); ?>