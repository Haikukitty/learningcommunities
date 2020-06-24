<?php
/**
 * Template for displaying cta section.
 *
 * Only used in `Landing Page` page template.
 *
 * @package    Ethority
 * @subpackage Option Tree plugin
 * @since      1.2.0
 */
?>

<section id="<?php echo ot_get_option('eth_cta_id'); ?>" class="cta boxed">
  <div class="container">

    <span class="cta-txt"><?php echo ot_get_option('eth_cta_text'); ?></span>
    <?php if ( ot_get_option('eth_cta_button_href') ) : ?>
      <a href="<?php echo esc_url( ot_get_option('eth_cta_button_href') ); ?>" class="button purchase-button"><?php echo ot_get_option('eth_cta_button_text'); ?></a>
    <?php endif; ?>

  </div> <!-- /.container -->
</section> <!-- #cta -->