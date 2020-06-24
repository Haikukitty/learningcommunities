<?php
/**
 * Template for displaying the site header.
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>

<!DOCTYPE html>
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title>
  <?php
    wp_title( '|', true, 'right' ); // post title appear on right
    bloginfo( 'name' );

    $blog_description = get_bloginfo( 'description', 'display' );
    if ( $blog_description && ( is_home() || is_front_page() ) ) echo " | $blog_description";
  ?>
  </title>

  <meta name="author" content="<?php echo get_bloginfo( 'name '); ?>">
  <meta name="description" content="<?php echo $blog_description ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo esc_url( ot_get_option( 'eth_favicon' ) ); ?>">

  <?php wp_head(); ?>
  
 <link href='https://fonts.googleapis.com/css?family=Oswald:400,700|Open+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74927210-1', 'auto');
  ga('send', 'pageview');

</script>
</head>


<body <?php body_class(); ?>>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<div id="site-container" class="site-container">

  <!-- jQuery .load() flicker fix (so that the site works even with JS disabled) -->
  <script type="text/javascript">
  (function($) {
    "use strict";
    // document.getElementById('site-container').className += ' opacity-zero';
    $('.site-container').css('opacity', '0');
  }(jQuery));
  </script>

  <header class="header" id="header">
    <div class="container">

      <div class="sixteen columns">

        <div class="logo">
          <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <img src="<?php echo esc_url( ot_get_option('eth_logo') ); ?>" />
          </a>
        </div>


        <nav class="nav">
          <!-- Mobile Menu Toggle -->
          <a href="#" id="menu-toggle" class="menu-toggle">Menu <i class="fa fa-align-justify"></i></a>

          <?php wp_nav_menu( array(
            'theme_location'  => 'top-menu',
            'container'       => false,
            'menu_class'      => 'menu',
            'menu_id'         => 'menu',
          ) ); ?>
        </nav>

      </div> <!-- /.sixteen columns -->

    </div><!-- /.container -->
  </header>