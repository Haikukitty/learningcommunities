jQuery(document).ready(function($){
	var wh = $(window).height(); 
	var mh = $('#main-header').height();
	var th = $('#top-header').height();
	var mf = $('#main-footer').height();
	var sh = wh - mh - th - mf;
	var sh_transparent = wh - mf;
	var sh1 = wh - mh;
	var sh2 = wh - th;
	var sh3 = wh - mf;
	var sh4 = wh - mh - th;
	var ab = wh - mh - th - mf - 32;
	var ab_transparent = wh - mf - 32;
	var allHeaders = mh + th;
	$('body.divi-hacks-footer-on-bottom:not(.admin-bar) #main-content .container').css('min-height', sh);
	$('.divi-hacks-footer-on-bottom:not(.admin-bar) #main-content').css('min-height', sh);
	$('.divi-hacks-footer-on-bottom.et_transparent_nav:not(.admin-bar) #main-content').css('min-height', sh_transparent);
	$('.divi-hacks-footer-on-bottom.admin-bar #main-content').css('min-height', ab);
	$('.divi-hacks-footer-on-bottom.et_transparent_nav.admin-bar #main-content').css('min-height', ab_transparent);
	$('.divi-hacks-full-height .full-height').css('min-height', wh);
	$('.divi-hacks-full-height .full-height-minus-main-header').css('min-height', sh1);
	$('.divi-hacks-full-height .full-height-minus-top-header').css('min-height', sh2);
	$('.divi-hacks-full-height .full-height-minus-main-footer').css('min-height', sh3);
	$('.divi-hacks-full-height .full-height-minus-both-headers').css('min-height', sh4);
});

jQuery(document).ready(function($){
	window.onscroll = function (e) {
		$(".divi-hacks-sticky.et_fixed_nav .sticky-element").sticky({topSpacing:$('#main-header').height() + $('#top-header').height()});
		$(".divi-hacks-sticky:not(.et_fixed_nav) .sticky-element").sticky({topSpacing:0});
		$(".divi-hacks-sticky.et_fixed_nav.admin-bar .sticky-element").sticky({topSpacing:$('#main-header').height() + $('#top-header').height() + 32});
		$(".divi-hacks-sticky.admin-bar:not(.et_fixed_nav) .sticky-element").sticky({topSpacing:32});
	}
});

jQuery(document).ready(function($){ 
    var node = $(".et_pb_testimonial.event-box .et_pb_testimonial_meta").contents().filter(function () { return this.nodeType == 3 }).first(),
        text = node.text(),
        first = text.slice(0, text.indexOf(" "));
    
    if (!node.length)
        return;
    
    node[0].nodeValue = text.slice(first.length);
    node.before('<span>' + first + '</span>');
    
    $(".et_pb_testimonial.event-box .et_pb_testimonial_meta").each(function(){
    $(this).html($(this).html().replace(/,/g , '')); });
});

jQuery(document).ready(function($){
	var alterClass = function() {
		var ww = document.body.clientWidth;
		if (ww < 981) {
			$('body').removeClass('is-desktop');
		} else if (ww >= 981) {
			$('body').addClass('is-desktop');
		};
		if ((ww < 768) || (ww > 980)) {
			$('body').removeClass('is-tablet');
		} else if ((ww >= 768) || (ww <= 980)) {
			$('body').addClass('is-tablet');
		};
		if (ww > 768) {
			$('body').removeClass('is-phone');
		} else if (ww <= 767) {
			$('body').addClass('is-phone');
		};
		if (ww > 980) {
			$('body').removeClass('is-mobile');
		} else if (ww <= 980) {
			$('body').addClass('is-mobile');
		};
	};
	$(window).resize(function(){
		alterClass();
	});
	//Fire it when the page first loads:
	alterClass();
});

jQuery(document).ready(function($){
	function setup_collapsible_submenus() {
	var $menu = $('.divi-hacks-collapse-mobile-submenus .et_mobile_menu'),
	top_level_link = '.divi-hacks-collapse-mobile-submenus .et_mobile_menu > .menu-item-has-children > a';
	$menu.find('a').each(function() {
	$(this).off('click');

	if ( $(this).is(top_level_link) ) {
	$(this).attr('href', '#');
	$(this).next('.divi-hacks-collapse-mobile-submenus .sub-menu').addClass('hide');
	}

	if ( ! $(this).siblings('.divi-hacks-collapse-mobile-submenus .sub-menu').length ) {
	$(this).on('click', function(event) {
	$(this).parents('.divi-hacks-collapse-mobile-submenus .mobile_nav').trigger('click');
	});
	} else {
	$(this).on('click', function(event) {
	event.preventDefault();
	$(this).next('.divi-hacks-collapse-mobile-submenus .sub-menu').toggleClass('visible');
	});
	}
	});
	}

	$(window).load(function() {
	setTimeout(function() {
	setup_collapsible_submenus();
	}, 2700);
	});
});

jQuery(document).ready(function() {
	jQuery('body:not(.logged-in)').addClass('logged-out');
});