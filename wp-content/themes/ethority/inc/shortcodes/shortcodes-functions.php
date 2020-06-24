<?php
/**
 * List of shortcode to add.
 *
 * @package Ethority
 * @since   1.2.0
 */

// Color
add_shortcode( 'eth_color' , 'eth_color' );
function eth_color( $atts , $content ) {
  extract( shortcode_atts( array(
    'class'     => '',
    'color'     => ''
  ), $atts ) );
  return '<span class="' . $class . '" style="color: ' . $color . ';">' . do_shortcode( $content ) . '</span>';
}


// Empty space
add_shortcode( 'eth_empty' , 'eth_empty' );
function eth_empty( $atts ) {
  extract( shortcode_atts( array(
    'class'       => '',
    'height'      => '20px'
  ), $atts ) );
  return '<hr class="' . $class . '" style="height: ' . $height . '; border: none; margin: 0" />';
}


// Divider
add_shortcode( 'eth_divider' , 'eth_divider' );
function eth_divider( $atts ) {
  extract( shortcode_atts( array(
    'width'     => '100%',
    'margin'    => '20px',
    'class'     => ''
  ), $atts ) );
  return '<hr class="eth-divider ' . $class . '" style="width: ' . $width . '; margin: ' . $margin . ' 0;" />';
}


// Highlight
add_shortcode( 'eth_highlight' , 'eth_highlight' );
function eth_highlight( $atts , $content ) {
  extract( shortcode_atts( array(
    'class'     => '',
    'color'     => ''
  ), $atts ) );
  return '<span class="eth-highlight ' . $class .'" style="color: ' . $color . ';">' . do_shortcode( $content ) . '</span>';
}

// Clear
add_shortcode( 'eth_clearfix' , 'eth_clearfix' );
function eth_clearfix() {
  return '<div class="clearfix"></div>';
}

// Columns
add_shortcode( 'eth_col' , 'eth_col' );
function eth_col( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'size'      => '1-3',
    'class'     => '',
    'pos'       => ''
  ), $atts ) );
  return '<div class="ethcol-' . $size . ' ' . $class .' ethcol-' . $pos . '">' . do_shortcode( $content ) . '</div>';
}

// Accordion container
add_shortcode( 'eth_accordion', 'eth_accordion' );
function eth_accordion( $atts, $content = null  ) {

  extract( shortcode_atts( array(
    'class'     => ''
  ), $atts ) );


  return '<div class="eth-accordion-ct ' . $class . '">' . do_shortcode( $content ) . '</div>';
}

// Accordion item
add_shortcode( 'eth_accordion_item', 'eth_accordion_item' );
function eth_accordion_item( $atts, $content = null  ) {
  extract( shortcode_atts( array(
    'title' => 'Title',
    'class' => '',
  ), $atts ) );

 return '<h3 class="' . $class . '"><a href="#">' . $title . '</a></h3><div>' . do_shortcode( $content ) . '</div>';
}

// Toggle
add_shortcode('eth_toggle', 'eth_toggle');
function eth_toggle( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'title'     => 'Title',
    'class'     => ''
  ), $atts ) );

  // Display the Toggle
  return '<div class="eth-toggle-ct ' . $class . '"><h3 class="eth-toggle"><a href="#">' . $title . '</a></h3><div class="eth-toggle-content">' . do_shortcode( $content ) . '</div></div>';
}


// Tabs

$tabs_item = ''; // this variable will hold your divs

add_shortcode('eth_tabsgroup', 'eth_tabsgroup');
function eth_tabsgroup( $atts, $content = null ) {
    global $tabs_item;

    // reset divs
    $tabs_item = '';

    extract( shortcode_atts( array(
        'class' => ''
    ), $atts ) );

    $output  = '<div id="eth-tabs-ct" class="eth-tabs-ct"' . $class . '">';
    $output .= '<ul>' . do_shortcode( $content ) . '</ul>';

    // use global variable containing tabs item content
    $output .= '<div class="eth-tabsitems">' . $tabs_item . '</div>';
    $output .= '</div>';

    return $output;
}

add_shortcode('eth_tabsitem', 'eth_tabsitem');
function eth_tabsitem( $atts, $content = null ) {
  global $tabs_item;

  extract( shortcode_atts( array(
        'title' => ''
    ), $atts ) );

    $item_id = 'eth-tabsitem-' . rand( 100,999 );

    $output = '<li><a href="#' . $item_id . '">' . $title . '</a></li>';

    // put tabs item content into global variable
    $tabs_item .= '<div id="' . $item_id . '" class="eth-tabsitem">' . do_shortcode( $content ) . '</div>';

    return $output;
}