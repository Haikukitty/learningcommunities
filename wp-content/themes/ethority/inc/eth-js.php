<?php
/**
 * Custom JS from theme options.
 *
 * @package     Ethority
 * @subpackage  OptionTree plugin
 * @since       1.2.0
 */

if ( ! function_exists( 'eth_print_custom_js' ) ) :
/**
 * Prints custom JS from the options settings.
 *
 * @since 1.1.0
 */
function eth_print_custom_js() {
?>
<script id="eth_custom_js">
  <?php echo ot_get_option('eth_custom_js'); ?>;
</script>
<?php
}
add_action( 'wp_footer', 'eth_print_custom_js', 10 );
endif;

if ( ! function_exists( 'eth_print_animations_js' ) ) :
/**
 * Print theme options animations.
 *
 * @since  1.2.0
 */
function eth_print_animations_js() {
  if ( 'disable' == ot_get_option( 'eth_disable_animation_mobile' ) ) {
    $is_animation_disabled = 1;
  } else {
    $is_animation_disabled = 0;
  }
?>

<script type="text/javascript">
(function($) {
"use strict";
$(document).ready(function() {

  if ( <?php echo $is_animation_disabled; ?> == 1 && $('body').hasClass('is-mobile-js') ) {
    return;
  }

  var animWithOpacity, elAnims;

  elAnims = {
    homeImage        : '<?php echo ot_get_option( 'eth_home_image_anim' ); ?>',
    featuresList     : '<?php echo ot_get_option( 'eth_features_list_anim' ); ?>',
    overviewList     : '<?php echo ot_get_option( 'eth_overview_list_anim' ); ?>',
    overviewImage    : '<?php echo ot_get_option( 'eth_overview_product_image_anim' ); ?>',
    ctaButton        : '<?php echo ot_get_option( 'eth_cta_button_anim' ); ?>',
    testimonialsEven : '<?php echo ot_get_option( 'eth_testimonials_anim_even' ); ?>',
    testimonialsOdd  : '<?php echo ot_get_option( 'eth_testimonials_anim_odd' ); ?>',
    // pricetable:       '<?php echo ot_get_option( 'eth_pricetable_list' ); ?>' // @see comments below
  }


  animWithOpacity = [
    'flash',
    'bounce',
    'bounceIn',
    'bounceInDown',
    'bounceInUp',
    'bounceInLeft',
    'bounceInRight',
    'fadeIn',
    'fadeInUp',
    'fadeInDown',
    'fadeInLeft',
    'fadeInRight',
    'fadeInUpBig',
    'fadeInDownBig',
    'fadeInLeftBig',
    'fadeInRightBig',
    'flip',
    'flipInX',
    'flipInY',
    'lightSpeedin',
    'rotateIn',
    'rotateInDownLeft',
    'rotateInDownRight',
    'rotateInUpLeft',
    'rotateInUpRight',
    'rollIn',
  ];

  // Checks animation against list that uses opacity
  function checkAnim(elAnim, animWithOpacity) {
    for (var i = 0; i < animWithOpacity.length; i++) {
      if ( elAnim == animWithOpacity[i])
        return true;
    }
  }

  // Hides element first with a class if animation uses opacity
  function hideEl(el, elAnims, animWithOpacity) {
    var check = checkAnim(elAnims, animWithOpacity);

    if ( true == check ) {
      el.addClass('opacity-zero');
    }
  }

  // $.each(elAnims, function(key, value) {
    // if ( true == checkAnim(value, animWithOpacity) ) {
    //  console.log(key);
    // }
  // });

  // Home section
  if ( elAnims.homeImage !== 'none' ) {
    hideEl($('.home-image'), elAnims.homeImage, animWithOpacity);

    $('.home-image')
      .removeClass('opacity-zero')
      .addClass('animated opacity-one ' + elAnims.homeImage);
  }

  // Features section
  if ( elAnims.featuresList !== 'none' ) {
    hideEl($('.feature'), elAnims.featuresList, animWithOpacity);

    $('.features').waypoint( function() {
      $('.feature').each( function ( i ) {
        $(this).css({
          'animation-delay' : (i * 0.3) + "s",
          '-webkit-animation-delay' : (i * 0.3) + "s",
          '-moz-animation-delay' : (i * 0.3) + "s",
          '-ms-animation-delay' : (i * 0.3) + "s",
          '-o-animation-delay' : (i * 0.3) + "s"
        });
      });

      $('.feature')
        .removeClass('opacity-zero')
        .addClass('animated opacity-one ' + elAnims.featuresList);
    }, {offset: 400});
  } // Features Section

  // Overview section
  if ( elAnims.overviewList !== 'none' ) {
    // Chapters
    hideEl($('.chapter-block'), elAnims.overviewList, animWithOpacity);

    $('.overview').waypoint( function() {
      $('.chapter-block').each( function ( i ) {
        $(this).css({
          'animation-delay' : (i * 0.1) + "s",
          '-webkit-animation-delay' : (i * 0.1) + "s",
          '-moz-animation-delay' : (i * 0.1) + "s",
          '-ms-animation-delay' : (i * 0.1) + "s",
          '-o-animation-delay' : (i * 0.1) + "s"
        });
      });

      $('.chapter-block')
        .removeClass('opacity-zero')
        .addClass('animated opacity-one ' + elAnims.overviewList);

    }, {offset: 400});
  }
  if ( elAnims.overviewImage !== 'none' ) {
    // Product image
    hideEl($('.product-sample'), elAnims.overviewImage, animWithOpacity);

    $('.product-sample').waypoint( function() {
      $(this)
        .removeClass('opacity-zero')
        .addClass('animated opacity-one ' + elAnims.overviewImage);
    }, {offset: 800});
  } // Overview section

  // CTA section
  if ( elAnims.ctaButton !== 'none' ) {
    hideEl($('.cta .purchase-button'), elAnims.ctaButton, animWithOpacity);

    $('.cta').waypoint( function() {
      $('.cta .purchase-button')
        .removeClass('opacity-zero')
        .addClass('animated opacity-one ' + elAnims.ctaButton);
    }, {offset: 550});
  } // CTA section

  // Testimonials section
  if ( elAnims.testimonialsEven !== 'none' || elAnims.testimonialsOdd !== 'none' ) {

    hideEl($('.testimonial:nth-child(2n)'), elAnims.testimonialsEven, animWithOpacity);
    hideEl($('.testimonial:nth-child(2n+1)'), elAnims.testimonialsOdd, animWithOpacity);

    $('.testimonials').waypoint( function() {

      $('.testimonial').each( function ( i ) {
        $(this).css({
          'animation-delay' : (i * 0.3) + "s",
          '-webkit-animation-delay' : (i * 0.3) + "s",
          '-moz-animation-delay' : (i * 0.3) + "s",
          '-ms-animation-delay' : (i * 0.3) + "s",
          '-o-animation-delay' : (i * 0.3) + "s"
        });
      });

      $('.testimonial:nth-child(2n)')
        .removeClass('opacity-zero')
        .addClass('animated opacity-one ' + elAnims.testimonialsEven);
      $('.testimonial:nth-child(2n+1)')
        .removeClass('opacity-zero')
        .addClass('animated opacity-one ' + elAnims.testimonialsOdd);
    }, {offset: 400});
  } // Testimonials section

  /**
   * This section does not use the functions like the above sections as
   * the animation value is stored in an array. Direct implementation us
   * used.
   */
  // Purchase section
  <?php if ( ot_get_option('eth_pricetable_anim') !== 'none' ) : ?>

    <?php
    /**
     * Direct input to check if opacity class is needed.
     */
    if ( ! empty( $tables ) ) :
      foreach( $tables as $key => $table ) :
        ?>
          for (var i = 0; i < animWithOpacity.length; i++) {
            if ( '<?php echo $table['eth_pricetable_anim']; ?>' == animWithOpacity[i]) {
              $('.price-table').addClass('opacity-zero');
            }
          }
      <?php
      endforeach;
    endif;
    ?>

    $('.purchase').waypoint( function () {

      $('.price-table').each( function ( i ) {
        $(this).css({
          'animation-delay' : (i * 0.1) + "s",
          '-webkit-animation-delay' : (i * 0.1) + "s",
          '-moz-animation-delay' : (i * 0.1) + "s",
          '-ms-animation-delay' : (i * 0.1) + "s",
          '-o-animation-delay' : (i * 0.1) + "s"
        });
      });


      <?php
      $tables = ot_get_option( 'eth_pricetable_list', array() );
      if ( ! empty( $tables ) ) :
        foreach( $tables as $key => $table ) :
        ?>
          // get each table's animation separately from option list
          $('.price-table:nth-child( <?php echo $key + 1; ?> )')
            .removeClass('opacity-zero')
            .addClass('animated opacity-one <?php echo $table['eth_pricetable_anim']; ?>');
        <?php
        endforeach;
      endif;
      ?>

    }, {offset: 400});
  <?php endif; ?>

});
}(jQuery));
</script>
<?php
} // eth_animations()
add_action( 'wp_footer', 'eth_print_animations_js', 99 );
endif;