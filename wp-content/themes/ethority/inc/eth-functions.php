<?php
/**
 * Custom theme related functions.
 *
 * @package Ethority
 * @since   1.2.0
 */

if ( ! function_exists( 'eth_admin_bar_fix' ) ) :
/**
 * Admin bar overlap styling fix for the header.
 *
 * @since 1.0.0
 */
function eth_admin_bar_fix() {
  if ( ! is_admin_bar_showing() ) {
    return;
  }
?>
<style type="text/css">
.header {
  top: 32px !important;
}
@media only screen and (max-width: 782px) {
  .header {
    top: 46px !important;
  }
  #wpadminbar {
    position: fixed;
  }
}
</style>
<?php
}
add_action( 'wp_head', 'eth_admin_bar_fix' );
endif;

if ( ! function_exists( 'eth_body_classes' ) ) :
/**
 * Add classes for Landing Page Template
 *
 * @since 1.2.0
 */
function eth_body_classes( $classes ) {
  if ( is_page_template( 'landing-page.php' ) ) {
    $classes[] = esc_attr( 'landing-page' );
  }

  return $classes;
}
add_filter( 'body_class','eth_body_classes' );
endif;

if ( ! function_exists( 'eth_filter_title' ) ) :
/**
 * Filters title and highlight word from settings.
 *
 * @since   1.2.0
 * @return  string Title to highlight.
 */
function eth_filter_title( $title, $highlight ) {
  $highlight = empty( $highlight ) ? '' : $highlight;
  $title = str_replace( $highlight, '<span class="title-highlight">' . $highlight .'</span>', $title );

  return $title;
}
endif;

if ( ! function_exists( 'eth_google_analytics' ) ) :
/**
 * Print google analytics
 *
 * @since  1.2.0
 */
function eth_google_analytics() {
  echo ot_get_option('eth_google_analytics');
}
if ( ot_get_option('eth_google_analytics_insert') === 'header' ) {
  add_action( 'wp_head', 'eth_google_analytics', 9999 );
}
elseif ( ot_get_option('eth_google_analytics_insert') === 'footer' ) {
  add_action( 'wp_footer', 'eth_google_analytics', 9999 );
}
endif;


if ( ! function_exists( 'eth_post_meta' ) ) :
/**
 * Print post meta.
 *
 * @since  1.2.0
 */
function eth_post_meta() {
  ?>
  <!-- date -->
  <span class="post-meta-date">
    <i class="fa fa-clock-o"></i> <a href="<?php esc_url( the_permalink() ); ?>"><?php echo __( get_the_date('d M , Y') , 'eth-theme'); ?></a>
  </span>
  <!-- comments -->
  <span class="comments-span">
    <i class="fa fa-comments"></i> <a href="<?php esc_url( the_permalink() ); ?>#comments"><?php comments_number( __( 'Leave a comment', 'eth-theme' ), __( '1 Comment', 'eth-theme' ), __( '% Comments', 'eth-theme' ) ); ?></a>
  </span>
  <!-- categories -->
  <span class="post-meta-categories">
    <i class="fa fa-folder-open"></i><?php the_category( _x( ', ', 'Used between list items, there is a space after the comma.', 'focus-theme' ) ); ?>
  </span>
  <!-- tags -->
  <span class="post-meta-tags">
    <i class="fa fa-tags"></i><?php the_tags(' '); ?>
  </span>
  <?php
}
endif;


if ( ! function_exists( 'eth_custom_comment_form' ) ) :
/**
 * Prints custom comment form.
 *
 * @since  1.2.0
 */
function eth_custom_comment_form() {
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );

  $fields =  array(
  'author' =>
    '<p class="comment-form-author"><label for="author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' placeholder="'. esc_attr( __( '*Enter your name...', 'eth-theme' ) ) .'"/></p>',

  'email' =>
    '<p class="comment-form-email"><label for="email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' placeholder="'. esc_attr( __( '*Enter your email...', 'eth-theme' ) ) .'"/></p>',

  'url' =>
    '<p class="comment-form-url"><label for="url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" placeholder="'. esc_attr( __( 'Enter your website...', 'eth-theme' ) ) .'"/></p>',
  );


  $comment_args = array(
    'title_reply'       => __( 'Leave a comment', 'eth-theme' ),
    'title_reply_to'    => __( 'Leave a reply to %s', 'eth-theme' ),
    'cancel_reply_link' => "<span class='cancel-reply-link'>" . __( 'Cancel reply', 'eth-theme' ) . "</span>",
    'label_submit'      => __( 'Post Comment', 'eth-theme' ),
    'fields'            => $fields,
    'comment_field'     => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr( __( '*Enter your comment...', 'eth-theme' ) ) . '"></textarea></p>'
  );

  comment_form( $comment_args );
}
endif;

if ( ! function_exists( 'eth_link_target' ) ) :
/**
 * Retrieve HTML target attribute if set to
 * open new tab.
 *
 * @since 1.0.0
 *
 * @param  string $option Open new tab on cick?
 * @return string $target HTML target attribute.
 */
function eth_link_target( $option = '' ) {
  if ( $option == 'new_tab' ) {
    $target = 'target="_blank"';
  } else {
    $target = '';
  }

  return $target;
}
endif;