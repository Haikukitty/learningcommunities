<?php
/**
 * Template for displaying author section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_author_id'); ?>" class="author boxed">

  <div class="section-header">
    <h3 class="title">
      <?php
      /**
       *  Finds 'text to highlight' in the title and return highlighted title.
       *
       *  eth_filter_title( $title, $text_to_highlight ) @ /inc/eth-functions.php
       */
      echo eth_filter_title( ot_get_option('eth_author_title'), ot_get_option('eth_author_title_highlight') );
      ?>
    </h3>

    <div class="description">
      <?php echo ot_get_option( 'eth_author_subtitle' ); ?>
    </div>
  </div> <!-- /.section-header -->

  <div class="container">
    <div class="sixteen columns">
      <div class="author-info">
        <?php if ( ot_get_option( 'eth_author_avatar' ) ) : ?>
        <div class="author-avatar">
          <img src="<?php echo ot_get_option( 'eth_author_avatar' ); ?>" />
        </div> <!-- /.author-avatar-->
        <?php endif; ?>

        <div class="author-meta">
          <?php if ( ot_get_option( 'eth_author_name' ) ) : ?>
          <span class="name"><?php echo ot_get_option( 'eth_author_name' ); ?></span>
          <?php endif; ?>


          <?php if ( ot_get_option( 'eth_author_social_list', array() ) ) : ?>
          <div class="social">
            <?php
            $author_social_links = ot_get_option( 'eth_author_social_list', array() );
            if ( ! empty( $author_social_links ) ) {
              foreach( $author_social_links as $author_social_link ) {
              ?>
                <a href="<?php echo esc_url( $author_social_link['eth_author_social_link'] ); ?>"><i class="fa <?php echo $author_social_link['eth_author_social_icon']; ?>"></i></a>
              <?php
              }
            }
            ?>
          </div> <!-- /.social -->
          <?php endif; ?>

          <?php if ( ot_get_option( 'eth_author_sig' ) ) : ?>
          <img src="<?php echo ot_get_option( 'eth_author_sig' ); ?>" class="sig">
          <?php endif; ?>
        </div> <!-- /.author-meta -->

        <div class="clearfix"></div>

        <div class="author-description">
          <?php echo do_shortcode( ot_get_option( 'eth_author_desc' ) ); ?>
        </div> <!-- /.author-description -->
      </div> <!-- /.author-info -->
    </div> <!-- /.sixteen columns -->
  </div> <!-- /.container -->

</section> <!-- #author -->