<?php
/**
 * Template for displaying the comments.
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>

<section id="comments" class="comments">

  <div class="comments-title">
    <i class="fa fa-comments"></i>

    <h3>
      <?php
        printf( _n('%d comment', '%d comments', get_comments_number(), 'eth-theme' ), number_format_i18n( get_comments_number() ) );
      ?>
    </h3>

    <a href="#respond" class="button leave-a-comment">Leave a comment</a>
  </div> <!-- /.comments-title -->

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
  <nav id="comments-pagination-top" class="comments-pagination-top" role="navigation">
    <?php
      paginate_comments_links( array(
        'show_all'     => false,
        'end_size'     => 1,
        'mid_size'     => 1,
        'prev_next'    => true,
        'prev_text'    => '<i class="fa fa-chevron-left"></i>',
        'next_text'    => '<i class="fa fa-chevron-right"></i>'
      ) );
    ?>
  </nav><!-- #comments-nav-top -->
  <?php endif; // Check for comments navigation. ?>

  <!-- The Comments -->
  <ol class="comment-list">
    <?php
      wp_list_comments( array(
        'style'      => 'ol',
        'short_ping' => true,
        'avatar_size'=> 80,
      ) );
    ?>
  </ol>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
  <nav id="comments-pagination-bottom" class="comments-pagination-bottom" role="navigation">
    <?php
      paginate_comments_links( array(
        'show_all'     => false,
        'end_size'     => 1,
        'mid_size'     => 1,
        'prev_next'    => true,
        'prev_text'    => '<i class="fa fa-chevron-left"></i>',
        'next_text'    => '<i class="fa fa-chevron-right"></i>'
      ) );
    ?>
  </nav><!-- #comments-nav-bottom -->
  <?php endif; // Check for comments navigation. ?>

  <?php eth_custom_comment_form(); ?>

</section> <!-- /#comments.comments -->