<?php
/**
 * Template for displaying footer section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_footer_id'); ?>" class="footer boxed" style="padding-bottom:0px;">

  <div class="section-header">
    <h3 class="title">
      <?php
      /**
       *  Finds 'text to highlight' in the title and return highlighted title.
       *
       *  eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
       */
      echo eth_filter_title( ot_get_option('eth_footer_title'), ot_get_option('eth_footer_title_highlight') );
      ?>
    </h3>

  </div> <!-- /.section-header -->

  <div class="social">
    <?php
    $new_tab = '';
    if ( 'new_tab' == ot_get_option( 'eth_social_link_new_tab' ) ) {
      $new_tab = 'target="_blank"';
    }

    $social_links = ot_get_option( 'eth_social_list', array() );
    if ( ! empty( $social_links ) ) {
      foreach( $social_links as $social_link ) {
      ?>
        <a href="<?php echo esc_url( $social_link['eth_social_link'] ); ?>" <?php echo esc_attr( $new_tab ); ?>><i class="fa <?php echo $social_link['eth_social_icon']; ?>"></i></a>
      <?php
      }
    }
    ?>
  </div> <!-- /.social -->
   
  <div style="max-width:50%;margin:50px auto 0;">
    <?php echo do_shortcode( ot_get_option( 'eth_footer_subtitle' ) ); ?>
  </div>
	

</section> <!-- /#footer -->