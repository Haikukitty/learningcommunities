(function($) {

"use strict";

$(document).ready(function() {

	var version = eth_theme.ver,
			stringEl = '<span class="theme-version">v' + version + ' | Get support <a href="http://themeforest.net/user/gdthemes">here</a>.</span>';

	$('#option-tree-version')
		.children(":first")
		.remove()
		.end()
		.append( stringEl );

});
}(jQuery));
