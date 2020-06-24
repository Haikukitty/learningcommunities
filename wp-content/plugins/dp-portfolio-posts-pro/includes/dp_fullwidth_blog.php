<?php
if (class_exists('ET_Builder_Module')) {//IF Divi Theme activated

class ET_Builder_Module_DP_Fullwidth_Blog extends ET_Builder_Module {
	function init() {
		$this->name       = __( 'DP Fullwidth Blog', 'et_builder' );
		$this->slug       = 'et_pb_dpfullwidth_blog';
		$this->fullwidth  = true;

		$this->whitelisted_fields = array(
			'title',
			'fullwidth',
			'include_categories',
			'posts_number',
			'custom_post_types',
			'show_title',
            'lightbox',
			'custom_url',
			'custom_url_field_name',
			'show_date',
			'show_excerpt',
			'excerpt_limit',
			'arrow_placement',
			'background_layout',
			'auto',
			'auto_speed',
			'admin_label',
			'module_id',
			'module_class',
		);

		$this->fields_defaults = array(
			'fullwidth'         => array( 'on' ),
			'show_title'        => array( 'on' ),
            'lightbox'          => array( 'off' ),
			'custom_url'        => array( 'off' ),
			'show_date'         => array( 'on' ),
			'show_excerpt'      => array( 'off' ),
			'excerpt_limit'     => array( 140, 'add_default_setting' ),
			'excerpt_limit'     => array( 140, 'add_default_setting' ),
			'arrow_placement'   => array( 'on' ),
			'background_layout' => array( 'light' ),
			'auto'              => array( 'off' ),
			'auto_speed'        => array( '7000' ),
			'custom_post_types' => array('post', 'add_default_setting'),
		);
	}

	function get_fields() {
		$fields = array(
			'title' => array(
				'label'           => __( 'Portfolio Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => __( 'Title displayed above the portfolio.', 'et_builder' ),
			),
			'fullwidth' => array(
				'label'             => __( 'Layout', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => array(
					'on'  => __( 'Carousel', 'et_builder' ),
					'off' => __( 'Grid', 'et_builder' ),
				),
				'affects'           => array(
					'#et_pb_auto',
				),
				'description'        => __( 'Choose your desired portfolio layout style.', 'et_builder' ),
			),
			'custom_post_types' => array(
				'label'            => __( 'Post Types', 'et_builder' ),
				'renderer'         => 'et_builder_custom_post_types_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'option_category'  => 'basic_option',
				'description'      => __( 'Select the Post Type that you would like to include in the feed.', 'et_builder' ),
			),
			'include_categories' => array(
				'label'           => __( 'Include Categories', 'et_builder' ),
				'renderer'         => 'et_builder_divi_include_categories_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'option_category' => 'basic_option',
				'description'     => __( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
			),
			'posts_number' => array(
				'label'           => __( 'Posts Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => __( 'Control how many projects are displayed. Leave blank or use 0 to not limit the amount.', 'et_builder' ),
			),
			'show_title' => array(
				'label'             => __( 'Show Title', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'        => __( 'Turn project titles on or off.', 'et_builder' ),
			),
            'lightbox' => array(
				'label'              => __( 'Open in Lightbox', 'et_builder' ),
				'type'              => 'yes_no_button',
				'options'     => array(
					'off' => __( 'No', 'et_builder' ),
					'on'  => __( 'Yes', 'et_builder' ),
				),
				'description'        => __( 'Image opens in lightbox instead of opening blog post.', 'et_builder' ),
			),
			'custom_url' => array(
				'label'              => __( 'Use Custom URLs', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category' => 'configuration',
				'options'     => array(
					'off' => __( 'No', 'et_builder' ),
					'on'  => __( 'Yes', 'et_builder' ),
				),
				'affects'     => array(
					'#et_pb_custom_url_field_name',
				),
				'description'        => __( 'Changes the URL to a custom field value set in each post.', 'et_builder' ),
			),
			'custom_url_field_name' => array(
				'label'             => __( 'Custom Field for URL', 'et_builder' ),
				'type'              => 'text',
				'description'       => __( 'Enter custom field name (NOT the URL). The URL value needs to be set in each post using the custom field you input here. If no value is set, defaults to post URL.', 'et_builder' ),
			),
			'show_date' => array(
				'label'             => __( 'Show Date', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'        => __( 'Turn the date display on or off.', 'et_builder' ),
			),
			'show_excerpt' => array(
				'label'              => __( 'Show Excerpt', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category' => 'configuration',
				'options'     => array(
					'off' => __( 'No', 'et_builder' ),
					'on'  => __( 'Yes', 'et_builder' ),
				),
				'affects'     => array(
					'#et_pb_excerpt_limit',
					'#et_pb_show_more',
					'#arrow_placement'
				),
				'description'        => __( 'Turn the excerpt display on or off', 'et_builder' ),
			),
			'excerpt_limit' => array(
				'label'             => __( 'Excerpt Limit', 'et_builder' ),
				'type'              => 'text',
				'description'       => __( 'Enter number of characters to limit excerpt.', 'et_builder' ),
			),
			'arrow_placement' => array(
				'label'             => __( 'Arrow Placement', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => __( 'Default', 'et_builder' ),
					'top' => __( 'Top', 'et_builder' ),
					'sides' => __( 'Push to left/right', 'et_builder' ),
				),
				'description'        => __( 'Choose your desired location of left and right carousel arrows.', 'et_builder' ),
			),
			'background_layout' => array(
				'label'             => __( 'Text Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'color_option',
				'options'           => array(
					'light'  => __( 'Dark', 'et_builder' ),
					'dark' => __( 'Light', 'et_builder' ),
				),
				'description'        => __( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
			),
			'auto' => array(
				'label'             => __( 'Automatic Carousel Rotation', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off'  => __( 'Off', 'et_builder' ),
					'on' => __( 'On', 'et_builder' ),
				),
				'affects'           => array(
					'#et_pb_auto_speed',
				),
				'depends_show_if' => 'on',
				'description'        => __( 'If you the carousel layout option is chosen and you would like the carousel to slide automatically, without the visitor having to click the next button, enable this option and then adjust the rotation speed below if desired.', 'et_builder' ),
			),
			'auto_speed' => array(
				'label'             => __( 'Automatic Carousel Rotation Speed (in ms)', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'depends_default'   => true,
				'description'       => __( "Here you can designate how fast the carousel rotates, if 'Automatic Carousel Rotation' option is enabled above. The higher the number the longer the pause between each rotation. (Ex. 1000 = 1 sec)", 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => __( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => __( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => __( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => __( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'et_builder' ),
			),
			'module_class' => array(
				'label'           => __( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => __( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'et_builder' ),
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$title              = $this->shortcode_atts['title'];
		$module_id          = $this->shortcode_atts['module_id'];
		$module_class       = $this->shortcode_atts['module_class'];
		$fullwidth          = $this->shortcode_atts['fullwidth'];
		$custom_post_types  = $this->shortcode_atts['custom_post_types'];
		$include_categories = $this->shortcode_atts['include_categories'];
		$posts_number       = $this->shortcode_atts['posts_number'];
		$show_title         = $this->shortcode_atts['show_title'];
        $lightbox         = $this->shortcode_atts['lightbox'];
		$custom_url        	= $this->shortcode_atts['custom_url'];
		$custom_url_field_name  = $this->shortcode_atts['custom_url_field_name'];
		$show_date          = $this->shortcode_atts['show_date'];
		$show_excerpt    	= $this->shortcode_atts['show_excerpt'];
		$excerpt_limit    	= $this->shortcode_atts['excerpt_limit'];
		$arrow_placement    = $this->shortcode_atts['arrow_placement'];
		$background_layout  = $this->shortcode_atts['background_layout'];
		$auto               = $this->shortcode_atts['auto'];
		$auto_speed         = $this->shortcode_atts['auto_speed'];

		$args = array();
		if ( is_numeric( $posts_number ) && $posts_number > 0 ) {
			$args['posts_per_page'] = $posts_number;
		} else {
			$args['nopaging'] = true;
		}
		if ( '' !== $custom_post_types ){
			$args['post_type'] = explode(',',$custom_post_types);
		}else{
			$args['post_type'] = 'post';
		}
		
		if ( '' !== $include_categories ){
			global $wpdb;
			$all_include_categories = explode( ',', $include_categories );
				for($i=0;$i<count($all_include_categories);$i++){
					$this_taxonomy = $wpdb->get_var("Select taxonomy from ".$wpdb->prefix."term_taxonomy where term_id='".$all_include_categories[$i]."'");
					$temp_cat_arr[] = array(
						'taxonomy' => $this_taxonomy,
						'field' => 'id',
						'terms' => $all_include_categories[$i],
						'operator' => 'IN',
						);
				}
				$temp_cat_arr['relation'] = 'OR';
				$args['tax_query'] = $temp_cat_arr;
		}

		$projects = dp_divi_get_projects( $args );

		ob_start();
		if( $projects->post_count > 0 ) {
			while ( $projects->have_posts() ) {
				$projects->the_post();
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_portfolio_item et_pb_grid_item ' ); ?>>
				<?php
					$thumb = '';

					$width = 320;
					$width = (int) apply_filters( 'et_pb_portfolio_image_width', $width );
					$lightbox_width = 1080;
					$lightbox_width = (int) apply_filters( 'et_pb_portfolio_image_width', $lightbox_width );
					$height = 241;
					$height = (int) apply_filters( 'et_pb_portfolio_image_height', $height );
					$lightbox_height = 9999;
					$lightbox_height = (int) apply_filters( 'et_pb_portfolio_image_height', $lightbox_height );
					list($thumb_src, $thumb_width, $thumb_height) = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array( $lightbox_width, $lightbox_height ) );
					$post_url = '';
					if (($custom_url == 'on') && ($custom_url_field_name != '')) {
						$post_url = get_post_meta(get_the_ID(), $custom_url_field_name, true);
						if ($post_url == '') {
							$post_url = get_the_permalink();
						}
					} else {
						$post_url = get_the_permalink();
					}
					$carousel = "on";

					$orientation = ( $thumb_height > $thumb_width ) ? 'portrait' : 'landscape';

					if ( '' !== $thumb_src ) : ?>
						<div class="et_pb_portfolio_image <?php echo esc_attr( $orientation ); ?><?php if ( 'on' === $show_excerpt ) { echo ' show_excerpt'; } ?>">
                        	<?php if ($lightbox == 'on') { ?>
							<a href="<?php print $thumb_src; ?>" class="et_pb_lightbox_image">
                            <?php } else { ?>
							<a href="<?php echo $post_url; ?>">
						<?php } ?>
								<img src="<?php echo esc_attr( $thumb_src ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"/>
								<div class="meta">
									<span class="et_overlay"></span>

									<?php if ( 'on' === $show_title ) : ?>
										<h3><?php the_title(); ?></h3>
									<?php endif; ?>

									<?php if ( 'on' === $show_date ) : ?>
										<p class="post-meta"><?php echo get_the_date(); ?></p>
									<?php endif; ?>
									
									<?php if ( 'on' === $show_excerpt ) : ?>
										<p class="post-excerpt"><?php dp_the_excerpt_max_charlength($excerpt_limit, $lightbox, $show_more, $custom_url, $post_url, $carousel);?></p>
									<?php endif; ?>
								</div>
							</a>
						</div>
				<?php endif; ?>
				</div>
				<?php
			}
		}

		wp_reset_postdata();

		$posts = ob_get_clean();

		$class = " et_pb_module et_pb_bg_layout_{$background_layout}";

		$output = sprintf(
			'<div%4$s class="et_pb_fullwidth_portfolio %1$s%3$s%5$s%9$s" data-auto-rotate="%6$s" data-auto-rotate-speed="%7$s">
				%8$s
				<div class="et_pb_portfolio_items clearfix" data-portfolio-columns="">
					%2$s
				</div><!-- .et_pb_portfolio_items -->
			</div> <!-- .et_pb_fullwidth_portfolio -->',
			( 'on' === $fullwidth ? 'et_pb_fullwidth_portfolio_carousel' : 'et_pb_fullwidth_portfolio_grid clearfix' ),
			$posts,
			esc_attr( $class ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			( '' !== $auto && in_array( $auto, array('on', 'off') ) ? esc_attr( $auto ) : 'off' ),
			( '' !== $auto_speed && is_numeric( $auto_speed ) ? esc_attr( $auto_speed ) : '7000' ),
			( '' !== $title ? sprintf( '<h2>%s</h2>', esc_html( $title ) ) : '' ),
			( 'on' !== $arrow_placement ? ( 'top' === $arrow_placement ? ' carousel_arrow_top' : ' carousel_arrow_sides') : '' )
		);

		return $output;
	}
}
new ET_Builder_Module_DP_Fullwidth_Blog;

}//IF Divi Theme activated
?>