(function($) {

"use strict";

$(document).ready(function() {

  // Js check
  $("html").removeClass("no-js").addClass("js");


  // Page load in effect
  $(window).load( function() {
    $('.site-container').animate({
      opacity: 1
    }, 300);
  });


  // FitVids
  $('.site-container').fitVids();



  // Owl Carousel
  $('.owl-carousel').owlCarousel({
    loop: false,
    autoplay: true,
    autoplayHoverPause: true,
    nav: false,
    smartSpeed: 700,
    responsive:{
      0:{
          items: 1
      }
    }
  });


  // Add a mobile class
  if ( $(window).width() < 959 ) {
    $('body').addClass('is-mobile-js');
  }
  // Add mobile class
  $(window).resize( function(){
    if ( $(window).width() < 959 ) {
      $('body').addClass('is-mobile-js');
    }
  });


  // Input placeholder fallback
  $('input, textarea').placeholder();

  // DL link centering
  var dlLink = $('.dl-link'),
      dlLinkWidth = dlLink.outerWidth();

  dlLink.css('margin-left', dlLinkWidth / 2 * -1 );


  /* Footer
  ------------------*/
  // back to top
  $('#back-to-top').click( function( e ) {
    e.preventDefault();

    $('html, body').stop().animate({ scrollTop: 0 }, 800);
  });


  /* Header
  ------------------*/
  // Cache variables
  var topMenu = $('.menu'),
      topMenuHeight = topMenu.outerHeight(), // include padding&margin, if .outerHeight(true), only padding
      menuItems = topMenu.find('a[href*="#"]');

  var scrolledItems = menuItems.map( function() {
        var hrefVal = $(this).attr('href'),
            hash = hrefVal.substr(hrefVal.indexOf("#"));

        // Only return items that is an anchor
        var item = $( hash );

        if ( item.length ) {
          return item;
        }
      });


  // Mobile Menu Toggle
  $('#menu-toggle').click( function( e ) {
    e.preventDefault();
    $(this).toggleClass('open');
    topMenu.slideToggle(400);
  });

  // Scroll to section
  menuItems.click( function( e ) {

    if ( $('body').hasClass('page-template-landing-page-php') ) {
      e.preventDefault();
    }

    var hrefVal = $(this).attr('href'),
        hash = hrefVal.substr(hrefVal.indexOf("#")),
        offsetTop = hash === '#' ? 0 : $(hash).offset().top - topMenu.outerHeight();

    // mobile
    var w = $(window).width();
    if ( w < 768 ){
      offsetTop = hash === '#' ? 0 : $(hash).offset().top - 60;
    }

    menuItems.parent().removeClass('active');
    $(this).parent().addClass('active');

    // Scroll to #
    $('html, body').animate({ scrollTop: offsetTop }, 800);


    // close mobile menu when item is clicked
    if ( $(window).width() < 768 ) {
      $('#menu-toggle').toggleClass('open');
      $('#menu').slideToggle(400);
    }

  }); // menuItems.click( function( e )


  // Scroll to 'purchase' section
  $('.purchase-button').click( function( e ) {

    var hrefVal = $(this).attr('href'),
        hash = hrefVal.substr(hrefVal.indexOf("#")),
        offsetTop = $(hrefVal).offset().top - topMenu.outerHeight();


    if ( hrefVal.indexOf('#') === 0 ) {
      e.preventDefault();
    }


    $('html, body').stop().animate({ scrollTop: offsetTop }, 800);
  });


  //
  $(window).scroll( function() {

    // Change .active menu item on scroll
    var fromTop = $(this).scrollTop() + topMenuHeight,

        // return menu item as object when scrolled into view
        itemsScrolled = scrolledItems.map( function(){

          if ( $(this).offset().top - 1 < fromTop ) // -1 so that menuItem detects using click event
          return this;
        });


    var scrolledItem = itemsScrolled[itemsScrolled.length - 1]; // index starts from 0...

    var id = scrolledItem && scrolledItem.length ? scrolledItem[0].id : 'none';


    // Add 'active' class to menuItem when scrolled to view
    menuItems
      .parent().removeClass('active')
      .end()
      .filter('[href*="#' + id + '"]').parent().addClass('active');



    // Scale down header
    if ( $(this).scrollTop() < 500 ) {
      $('#header').removeClass('scaled-down');
    } else {
      $('#header').addClass('scaled-down');
    }

    // back to top button
    if ( $(this).scrollTop() < 1000 ) {
      $('#back-to-top').fadeOut();
    } else {
      $('#back-to-top').fadeIn();
    }
  }); // $(window).scroll( function()




  /* Contact Form
  ------------------*/
  $('#commentform').validate({
  rules: {
    name: {
      required: true,
      minlength: 2
    },
    email: {
      required: true,
      email: true
    },
    comment: {
      required: true,
      minlength: 10
    }
  },
  messages: {
    name: "* Please enter your name.",
    email: "* Please enter a valid email address.",
    comment: "* Please enter your comment (min: 10 characters)."
  },
  errorElement: "div",
  errorPlacement: function(error, element) {
    element.before(error);
  }
});


});
}(jQuery));