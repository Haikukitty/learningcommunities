(function($) {

"use strict";

$(document).ready(function() {
	
	// Accordian @ jquery.ui
	$('.eth-accordion-ct').accordion({
		heightStyle: "content" // height set to height of content
	});

	// Toggle
	$('h3.eth-toggle').click( function() {
		$(this)
			.toggleClass("active")
			.next()
			.slideToggle(350);

		return false;
	} );

	// Tabs
	$('#eth-tabs-ct').tabs();


}); // $(document).ready(function()
}(jQuery));