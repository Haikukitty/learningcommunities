<?php
/**
 * Template for displaying subscribe section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_subscribe_id'); ?>" class="subscribe boxed">
  <div class="container">

    <div class="five columns">
      <div class="section-header">
        <h3 class="title" style="color:#FFF;">
          <?php
          /**
           *  Finds 'text to highlight' in the title and return highlighted title.
           *
           *  eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
           */
          echo eth_filter_title( ot_get_option('eth_subscribe_title'), ot_get_option('eth_subscribe_title_highlight') );
          ?>
        </h3>
      </div> <!-- /.section-header -->
    </div>

    <div class="eleven columns">
      <div class="subscribe-mc4wp">
        <?php echo do_shortcode( ot_get_option('eth_subscribe_mc4wp_shortcode') ); ?>
      </div>
    </div>

  </div> <!-- /.container -->
</section> <!-- #subscribe -->