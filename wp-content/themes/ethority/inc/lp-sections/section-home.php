<?php
/**
 * Template for displaying home section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */

$post       = ot_get_option( 'eth_home_media_pos' );
$media_type = ot_get_option( 'eth_home_media_type' );

if ( 'embed' === $media_type ) {
  $media_html = ot_get_option( 'eth_home_embed' );
} else {
  $media_html = '<img src="' . ot_get_option('eth_home_image') . '" class="home-image">';
}

/**
 * Print text
 */
ob_start();
?>
  <!-- Text -->
  <div class="eight columns">

    <h1 class="title">
      <?php
      /**
       *  Finds 'text to highlight' in the title and return highlighted title.
       *
       *  eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
       */
      echo eth_filter_title( ot_get_option('eth_home_title'), ot_get_option('eth_home_title_highlight') );
      ?>
    </h1>

    <div class="subtitle">
      <?php echo do_shortcode( ot_get_option('eth_home_subtitle') ); ?>

      <?php if ( ot_get_option('eth_home_button_href') != '' ) : ?>
        <a onclick="test()" href="<?php echo esc_url( ot_get_option('eth_home_button_href') ); ?>" class="button purchase-button"><?php echo ot_get_option('eth_home_button_text'); ?></a>
      <?php endif; ?>
    </div> <!-- /.subtitle -->

  </div><!-- /.eight columns -->
<?php
$text = ob_get_contents();
ob_end_clean();


/**
 * Print media
 */
ob_start();
?>
  <!-- Media -->
  <div class="eight columns">
    <?php echo $media_html; ?>
  </div><!-- /.eight columns -->
<?php
$media = ob_get_contents();
ob_end_clean();
?>

<section id="<?php echo ot_get_option('eth_home_id'); ?>" class="section-home boxed">
  <div class="container">

    <?php
      if ( $post === 'left' ) {
        echo $media . $text;
      } else {
        echo $text . $media;
      }
    ?>

  </div> <!-- /.container -->
</section> <!-- #home -->