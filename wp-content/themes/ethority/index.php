<?php
/**
 * Template for displaying the blog posts page.
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>

<?php get_header(); ?>

<section class="blog-page-header boxed-mini">
  <div class="section-header">
    <h1><?php echo ot_get_option('eth_blog_page_title'); ?></h1>
  </div> <!-- /.section-header -->
</section> <!-- /.blog-page-header -->

<section class="blog-page-content boxed">
  <div class="container">

    <div class="eleven columns">
      <?php
      /**
      * Replacement of search.php, category.php, tag.php, 404.php
      */
      if ( is_search() || is_category() || is_tag() || is_404() ) :
      ?>
        <div class="others-header">

          <?php if ( is_search() ) : ?>
          <h2 class="others-title"><?php printf( __( 'Search Results for: %s', 'eth-theme' ), get_search_query() ); ?></h2>
          <?php elseif ( is_category() ) : ?>
          <h2 class="others-title"><?php printf( __( 'All Posts in Category: %s', 'eth-theme' ), single_cat_title( '', false ) ); ?></h2>
          <?php elseif ( is_tag() ) : ?>
          <h2 class="others-title"><?php printf( __( 'All Posts Tagged: %s', 'eth-theme' ), single_tag_title( '', false ) ); ?></h2>
          <?php elseif ( is_404() ) : ?>
          <h2 class="others-title"><?php _e( 'ERROR 404', 'eth-theme' ); ?></h2>
          <?php endif; ?>

          <i class="fa fa-arrow-circle-o-down"></i>

        </div> <!-- /.search-header -->
      <?php
      endif; // ( is_search() || is_category() || is_tag() ) :
      ?>

      <?php
      // Start loop
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();

          get_template_part( 'inc/post-formats/content', get_post_format() );

        endwhile;
      else :

       // If no posts, load content-none.php
       get_template_part( 'inc/post-formats/content', 'none' );

      endif;
      // End loop
      ?>

      <nav class="post-pagination clearfix">
        <div class="next-posts"><?php next_posts_link( __('<i class="fa fa-arrow-left"></i> Older posts', 'eth-theme') ); ?></div>
        <div class="prev-posts"><?php previous_posts_link( __('Newer posts <i class="fa fa-arrow-right"></i>', 'eth-theme') ); ?></div>
      </nav>
    </div> <!-- /.eleven columns -->


    <div class="four columns offset-by-one">
      <div class="sidebar">
        <?php get_sidebar(); ?>
      </div> <!-- /.sidebar -->
    </div> <!-- /.four columns -->

  </div> <!-- /.container -->
</section> <!-- /.blog-page-content -->

<?php get_footer(); ?>