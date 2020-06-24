<?php
/**
 * Template for displaying full width page.
 *
 * Template Name: Full Width Page
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>

<?php get_header(); ?>

<section class="blog-page-header boxed-mini">
  <div class="section-header">
    <h1 class="title"><span class="title-highlight"><?php the_title(); ?></span></h1>
  </div> <!-- /.blog-page-title -->
</section> <!-- /.blog-page-header -->

<section class="blog-page-content boxed">
  <div class="container">

    <div class="sixteen columns">
      <?php
      // Start loop
      while ( have_posts() ) : the_post();

        // content
        get_template_part( 'inc/post-formats/content', get_post_format() );
        ?>

        <?php

        // If comments are allowed OR there is at least 1 comment
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        }

      endwhile;
      ?>
    </div> <!-- /.eleven columns -->

  </div> <!-- /.container -->
</section> <!-- /.blog-page-content -->

<?php get_footer(); ?>