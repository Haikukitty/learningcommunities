<?php

if (class_exists('ET_Builder_Module')) {//IF Divi Theme activated

class ET_Builder_Module_DP_Blog_Portfolio extends ET_Builder_Module {
	function init() {
		$this->name = __( 'DP Blog Portfolio', 'et_builder' );
		$this->slug = 'et_pb_dpblog_portfolio';

		$this->whitelisted_fields = array(
			'fullwidth',
			'posts_number',
			'custom_post_types',
			'include_categories',
			'show_title',
			'lightbox',
			'custom_url',
			'custom_url_field_name',
			'show_categories',
			'show_date',
			'show_excerpt',
			'excerpt_limit',
			'show_more',
			'show_pagination',
			'background_layout',
			'admin_label',
			'module_id',
			'module_class',
			'zoom_icon_color',
			'hover_overlay_color',
			'hover_icon',
		);

		$this->fields_defaults = array(
			'fullwidth'         => array( 'on' ),
			'posts_number'      => array( 10, 'add_default_setting' ),
			'show_title'        => array( 'on' ),
			'lightbox'          => array( 'off' ),
			'custom_url'        => array( 'off' ),
			'show_categories'   => array( 'on' ),
			'show_date'   		=> array( 'off' ),
			'show_excerpt'      => array( 'off' ),
			'excerpt_limit'     => array( 140, 'add_default_setting' ),
			'show_more'         => array( 'off' ),
			'show_pagination'   => array( 'on' ),
			'background_layout' => array( 'light' ),
			'custom_post_types' => array('post', 'add_default_setting'),
		);

		$this->main_css_element = '%%order_class%% .et_pb_portfolio_item';
		$this->advanced_options = array(
			'fonts' => array(
				'title'   => array(
					'label'    => __( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} h2",
					),
				),
				'caption' => array(
					'label'    => __( 'Caption', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .post-meta",
					),
				),
			),
			'background' => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'border' => array(),
		);
		$this->custom_css_options = array(
			'portfolio_image' => array(
				'label'    => __( 'Portfolio Image', 'et_builder' ),
				'selector' => '.et_portfolio_image',
			),
			'overlay' => array(
				'label'    => __( 'Overlay', 'et_builder' ),
				'selector' => '.et_overlay',
			),
			'overlay_icon' => array(
				'label'    => __( 'Overlay Icon', 'et_builder' ),
				'selector' => '.et_overlay:before',
			),
			'portfolio_title' => array(
				'label'    => __( 'Portfolio Title', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item h2',
			),
			'portfolio_post_meta' => array(
				'label'    => __( 'Portfolio Post Meta', 'et_builder' ),
				'selector' => '.et_pb_portfolio_item .post-meta',
			),
		);
	}

	function get_fields() {
		$fields = array(
			'fullwidth' => array(
				'label'           => __( 'Layout', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => __( 'Fullwidth', 'et_builder' ),
					'off' => __( 'Grid', 'et_builder' ),
				),
				'description'       => __( 'Choose your desired portfolio layout style.', 'et_builder' ),
			),
			'posts_number' => array(
				'label'             => __( 'Posts Number', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => __( 'Define the number of projects that should be displayed per page.', 'et_builder' ),
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
				'label'            => __( 'Include Categories', 'et_builder' ),
				'renderer'         => 'et_builder_divi_include_categories_option',
				'renderer_options' => array(
					'use_terms' => true,
				),
				'option_category'  => 'basic_option',
				'description'      => __( 'Select the categories that you would like to include in the feed.', 'et_builder' ),
			),
			'show_title' => array(
				'label'           => __( 'Show Title', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'       => __( 'Turn project titles on or off.', 'et_builder' ),
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
			'show_categories' => array(
				'label'           => __( 'Show Categories', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'        => __( 'Turn the category links on or off.', 'et_builder' ),
			),
			'show_date' => array(
				'label'           => __( 'Show Date', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => __( 'No', 'et_builder' ),
					'on'  => __( 'Yes', 'et_builder' ),
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
				),
				'description'        => __( 'Turn the excerpt display on or off', 'et_builder' ),
			),
			'excerpt_limit' => array(
				'label'             => __( 'Excerpt Limit', 'et_builder' ),
				'type'              => 'text',
				'description'       => __( 'Enter number of characters to limit excerpt.', 'et_builder' ),
			),
			'show_more' => array(
				'label'             => __( 'Read More Button', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => __( 'Off', 'et_builder' ),
					'on'  => __( 'On', 'et_builder' ),
				),
				'description'       => __( 'Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder' ),
			),
			'show_pagination' => array(
				'label'           => __( 'Show Pagination', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => __( 'Yes', 'et_builder' ),
					'off' => __( 'No', 'et_builder' ),
				),
				'description'        => __( 'Enable or disable pagination for this feed.', 'et_builder' ),
			),
			'background_layout' => array(
				'label'           => __( 'Text Color', 'et_builder' ),
				'type'            => 'select',
				'option_category' => 'color_option',
				'options'         => array(
					'light'  => __( 'Dark', 'et_builder' ),
					'dark' => __( 'Light', 'et_builder' ),
				),
				'description'        => __( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
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
			'zoom_icon_color' => array(
				'label'             => __( 'Zoom Icon Color', 'et_builder' ),
				'type'              => 'color',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_overlay_color' => array(
				'label'             => __( 'Hover Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
			),
			'hover_icon' => array(
				'label'               => __( 'Hover Icon Picker', 'et_builder' ),
				'type'                => 'text',
				'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
				'renderer'            => 'et_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'tab_slug'            => 'advanced',
			),
		);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		global $wpdb;
		
		$module_id          = $this->shortcode_atts['module_id'];
		$module_class       = $this->shortcode_atts['module_class'];
		$fullwidth          = $this->shortcode_atts['fullwidth'];
		$posts_number       = $this->shortcode_atts['posts_number'];
		$custom_post_types  = $this->shortcode_atts['custom_post_types'];
		$include_categories = $this->shortcode_atts['include_categories'];
		$show_title         = $this->shortcode_atts['show_title'];
		$lightbox         	= $this->shortcode_atts['lightbox'];
		$custom_url        	= $this->shortcode_atts['custom_url'];
		$custom_url_field_name  = $this->shortcode_atts['custom_url_field_name'];
		$show_categories    = $this->shortcode_atts['show_categories'];
		$show_date    		= $this->shortcode_atts['show_date'];
		$show_excerpt    	= $this->shortcode_atts['show_excerpt'];
		$excerpt_limit    	= $this->shortcode_atts['excerpt_limit'];
		$show_more          = $this->shortcode_atts['show_more'];
		$show_pagination    = $this->shortcode_atts['show_pagination'];
		$background_layout  = $this->shortcode_atts['background_layout'];
		$zoom_icon_color    = $this->shortcode_atts['zoom_icon_color'];
		$hover_overlay_color = $this->shortcode_atts['hover_overlay_color'];
		$hover_icon         = $this->shortcode_atts['hover_icon'];

		global $paged;

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		if ( '' !== $zoom_icon_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay:before',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $zoom_icon_color )
				),
			) );
		}

		if ( '' !== $hover_overlay_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay',
				'declaration' => sprintf(
					'background-color: %1$s;
					border-color: %1$s;',
					esc_html( $hover_overlay_color )
				),
			) );
		}

		$container_is_closed = false;

		if ( '' !== $custom_post_types ){
			$args = array(
				'posts_per_page' => (int) $posts_number,
				'post_type'      => explode(',',$custom_post_types),
			);
		}
		else{
			$args = array(
				'posts_per_page' => (int) $posts_number,
				'post_type'      => 'post',
			);
		}

		$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

		if ( is_front_page() ) {
			$paged = $et_paged;
		}

		if ( '' !== $include_categories ){
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
			
		/*if ( '' !== $include_categories )
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => explode( ',', $include_categories ),
					'operator' => 'IN',
				)
			);*/

		if ( ! is_search() ) {
			$args['paged'] = $et_paged;
		}

		$main_post_class = sprintf(
			'et_pb_portfolio_item%1$s',
			( 'on' !== $fullwidth ? ' et_pb_grid_item' : '' )
		);

		ob_start();
		
		query_posts( $args );

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class( $main_post_class ); ?>>

			<?php
				$thumb = '';

				$width = 'on' === $fullwidth ?  1080 : 400;
				$width = (int) apply_filters( 'et_pb_portfolio_image_width', $width );
				$lightbox_width = 1080;
				$lightbox_width = (int) apply_filters( 'et_pb_portfolio_image_width', $lightbox_width );
				$height = 'on' === $fullwidth ?  9999 : 284;
				$height = (int) apply_filters( 'et_pb_portfolio_image_height', $height );
				$lightbox_height = 9999;
				$lightbox_height = (int) apply_filters( 'et_pb_portfolio_image_height', $lightbox_height );
				$classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
				$thumb = $thumbnail["thumb"];
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
				$carousel = 'off';

				if ( '' !== $thumb ) : ?>
					<?php if ($lightbox == 'on') { ?>
					<a href="<?php print $thumb_src; ?>" class="et_pb_lightbox_image">
					<?php } else { ?>
					<a href="<?php echo $post_url; ?>">
					<?php } ?>
					<?php if ( 'on' !== $fullwidth ) : ?>
						<span class="et_portfolio_image">
					<?php endif; ?>
							<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
					<?php if ( 'on' !== $fullwidth ) :

							$data_icon = '' !== $hover_icon
								? sprintf(
									' data-icon="%1$s"',
									esc_attr( et_pb_process_font_icon( $hover_icon ) )
								)
								: '';

							printf( '<span class="et_overlay%1$s"%2$s></span>',
								( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
								$data_icon
							);

					?>
						</span>
					<?php endif; ?>
					</a>
			<?php
				endif;
			?>

				<?php if ( 'on' === $show_title ) : ?>
					<?php if  ( 'on' === $lightbox ) { ?>
						<h2><?php the_title(); ?></h2>
					<?php } else { ?>
					<h2><a href="<?php echo $post_url;?>"><?php the_title(); ?></a></h2>
					<?php } ?>
				<?php endif; ?>

				<?php if ( 'on' === $show_categories ) : 
				$terms = $wpdb->get_results("Select tt.term_id,tt.taxonomy from ".$wpdb->prefix."term_taxonomy tt Left Join ".$wpdb->prefix."term_relationships tr 
											on tt.term_taxonomy_id = tr.term_taxonomy_id where tr.object_id='".get_the_ID()."'");
				$show_cats = array();
				for($i=0;$i<count($terms);$i++){
					$term = $wpdb->get_row("Select name,slug from ".$wpdb->prefix."terms where term_id='".$terms[$i]->term_id."'");
					
					if (strpos($terms[$i]->taxonomy, 'tag') == false && $terms[$i]->taxonomy <> 'product_type') //Don't show Tag
						$show_cats[] = '<a rel="tag" href="'.site_url().'/'.$terms[$i]->taxonomy.'/'.$term->slug.'/">'.$term->name.'</a>';
				}
				?>
					<p class="post-meta"><?php echo implode(', ',$show_cats); ?></p>
				<?php endif; ?>
				
				<?php if ( 'on' === $show_date ) : ?>
					<p class="post-meta"><?php echo get_the_date(); ?></p>
				<?php endif; ?>
				
				<?php if ( 'on' === $show_excerpt ) : ?>
					<p class="post-excerpt"><?php dp_the_excerpt_max_charlength($excerpt_limit, $lightbox, $show_more, $custom_url, $post_url, $carousel);?></p>
				<?php endif; ?>

				</div> <!-- .et_pb_portfolio_item -->
	<?php	}

			if ( 'on' === $show_pagination && ! is_search() ) {
				echo '</div> <!-- .et_pb_portfolio -->';

				$container_is_closed = true;

				if ( function_exists( 'wp_pagenavi' ) )
					wp_pagenavi();
				else
					get_template_part( 'includes/navigation', 'index' );
			}

			wp_reset_query();
		} else {
			get_template_part( 'includes/no-results', 'index' );
		}

		$posts = ob_get_contents();

		ob_end_clean();

		$class = " et_pb_module et_pb_bg_layout_{$background_layout}";

		$output = sprintf(
			'<div%5$s class="%1$s%3$s%6$s">
				%2$s
			%4$s',
			( 'on' === $fullwidth ? 'et_pb_portfolio' : 'et_pb_portfolio_grid clearfix' ),
			$posts,
			esc_attr( $class ),
			( ! $container_is_closed ? '</div> <!-- .et_pb_portfolio -->' : '' ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
		);

		return $output;
	}
}
new ET_Builder_Module_DP_Blog_Portfolio;

}//IF Divi Theme activated

?>