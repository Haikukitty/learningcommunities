<?php wp_head(); ?>
<base target="_parent">
<style>
	html {
		margin-top: 0 !important;
	}
	body {
		background: none !important;
		width: 1px;
        min-width: 100%;
        *width: 100%;
	}
	#page-container {
		padding: 0 !important;
	}
	#mhmm-close-area {
		position: absolute;
		width: 100%;
		height: 100%;
	}
	#wpadminbar {
		display: none;
	}
</style>
<script>
	jQuery(function($) {
		var isTouch = ("ontouchstart" in document.documentElement);
		if(!isTouch) {
			$('#mhmm-close-area').on('mouseenter', function(e) {
				if($('.mhmm-hover-triggered', window.parent.document).length) {
					parent.mhmmMenuLayoutCloseOverlay($('.mhmm-menu-layout-overlay-active', window.parent.document));
				}
			});
		}

		$('#mhmm-close-area').on('click', function(e) {
		    parent.mhmmMenuLayoutCloseOverlay($('.mhmm-menu-layout-overlay-active', window.parent.document));
		});

		if($('form.et_pb_contact_form').length) {
			$('form.et_pb_contact_form').each(function() {
				var newAction = $(this).attr('action') + window.location.search;
				$(this).attr('action', newAction);
			});
		}
	});
</script>
<?php
	// Set gutters
	$page_custom_gutter = get_post_meta( get_the_ID(), '_et_pb_gutter_width', true );
	$gutter_width = ! empty( $page_custom_gutter ) && is_singular() ? $page_custom_gutter :  et_get_option( 'gutter_width', '3' );
	$classes[] = esc_attr( "et_pb_gutters{$gutter_width}" );

	// Button helper class
	$classes[] = 'et_pb_button_helper_class';
?>
<body id="mhmm-menu-layout-loader" class="<?php echo implode(' ', $classes); ?>">
	<div id="page-container">
		<div id="mhmm-close-area"></div>
		<?php $mhmmError = '<center style="padding: 20px 0;"><h3>No Mhmm Layout found.</h3><p>Please make sure you copied the correct HREF from the top right of your Mhmm Menu Layout\'s edit page.</p></center>'; ?>
		<?php if(isset($_GET['mhmm_menu_layout_id']) && $_GET['mhmm_menu_layout_id'] != '') {	
			$mhmmMenuLayout = get_post($_GET['mhmm_menu_layout_id']);
			if($mhmmMenuLayout) {
				echo do_shortcode($mhmmMenuLayout->post_content);
			}
			else {
				echo $mhmmError;
			}	
		} else {
			echo $mhmmError;
		} ?>
	</div>
</body>
<?php remove_action( 'wp_footer', 'integration_body', 12 ); ?>
<?php wp_footer(); ?>