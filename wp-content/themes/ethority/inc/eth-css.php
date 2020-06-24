<?php
/**
 * Custom CSS from theme options.
 *
 * @package     Ethority
 * @subpackage  OptionTree plugin
 * @since       1.2.0
 */

if ( ! function_exists( 'eth_print_custom_css' ) ) :
/**
 * Print theme options custom css.
 *
 * @since 1.0.0
 */
function eth_print_custom_css() {
?>
<style type="text/css" id"ethority-css">
/*------------------------------------------------------------------------------
  Header
------------------------------------------------------------------------------*/
.header {
  height: <?php echo ot_get_option('eth_menu_height'); ?>;
  min-height: <?php echo ot_get_option('eth_menu_height'); ?>;
  line-height: <?php echo ot_get_option('eth_menu_height'); ?>;
}

.section-home {
  margin-top: <?php echo ot_get_option('eth_menu_height'); ?>;
}

.logo img {
  height: <?php echo ot_get_option('eth_logo_height'); ?>;
  max-height: <?php echo ot_get_option('eth_logo_height'); ?>;
}
/*------------------------------------------------------------------------------
  Background Colors
------------------------------------------------------------------------------*/
.header       { background-color: <?php echo ot_get_option('eth_header_bg_color'); ?>;       }
.section-home { background-color: <?php echo ot_get_option('eth_home_bg_color'); ?>;         }
.reviews      { background-color: <?php echo ot_get_option('eth_reviews_bg_color'); ?>;      }
.features     { background-color: <?php echo ot_get_option('eth_features_bg_color'); ?>;     }
.overview     { background-color: <?php echo ot_get_option('eth_overview_bg_color'); ?>;     }
.cta          { background-color: <?php echo ot_get_option('eth_cta_bg_color'); ?>;          }
.testimonials { background-color: <?php echo ot_get_option('eth_testimonials_bg_color'); ?>; }
.testimonials .testimonial
              { background-color: <?php echo ot_get_option('eth_testimonials_bg_color_odd'); ?>; }
.testimonials .testimonial:nth-child(2n+1)
              { background-color: <?php echo ot_get_option('eth_testimonials_bg_color_even'); ?>; }
.author       { background-color: <?php echo ot_get_option('eth_author_bg_color'); ?>;       }
.purchase     { background-color: <?php echo ot_get_option('eth_pricetable_bg_color'); ?>;     }
.subscribe    { background-color: <?php echo ot_get_option('eth_subscribe_bg_color'); ?>;    }
.contact      { background-color: <?php echo ot_get_option('eth_contact_bg_color'); ?>;      }
.footer       { background-color: <?php echo ot_get_option('eth_footer_bg_color'); ?>;       }

/*------------------------------------------------------------------------------
  Accent Color
------------------------------------------------------------------------------*/
code,
a,
a:visited,
.social i:hover,
div.error,
.nav li.active a,
.nav li a:hover,
.nav li a:active,
.menu-toggle.open,
.menu-toggle.open i,
.reviews blockquote i,
.testimonials .profile .name,
.purchase .product-name,
footer .copyright p a:hover,
.post-article .post-meta-date i,
.post-article .comments-span i,
.post-article .post-meta-categories i,
.post-article .post-meta-tags i,
.post-pagination i,
.adj-post-navigation i,
.bypostauthor cite,
.others-header i,
.features .feature-icon i
{
  color: <?php echo ot_get_option('eth_accent_color'); ?>;
}

.button,
button,
input[type="submit"],
input[type="reset"],
input[type="button"],
.underline:after,
.landing-page .title .title-highlight:after,
.purchase .price-table .price,
footer .back-to-top i,
.sticky .post-sticky i,
.comment-reply-link,
.cancel-reply-link,
.widget_tag_cloud a:hover,
.widget_tag_cloud a:active,
.widget_calendar a,
.post-article .more-link
{
  background: <?php echo ot_get_option('eth_accent_color'); ?>;
}

.social i:hover,
.post-pagination i,
.adj-post-navigation i
{
  border-color: <?php echo ot_get_option('eth_accent_color'); ?>;
}

<?php
/*------------------------------------------------------------------------------
  Price tables
------------------------------------------------------------------------------*/
$tables = ot_get_option( 'eth_pricetable_list', array() );
$no_of_tables = count( $tables );
?>
<?php if ( 1 === $no_of_tables ) : ?>
@media only screen and (min-width: 768px) {
  .purchase .price-table {
    width: 500px;
    margin: 0;
  }
}
<?php endif; ?>



<?php
/**
 * Custom CSS setting from `General` section.
 */
echo ot_get_option('eth_custom_css');
?>;
</style>
<?php
}
add_action( 'wp_head', 'eth_print_custom_css' );
endif;