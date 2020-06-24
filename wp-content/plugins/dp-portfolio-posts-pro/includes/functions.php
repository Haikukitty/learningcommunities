<?php

if ( ! function_exists( 'et_builder_custom_post_types_option' ) ) :
function et_builder_custom_post_types_option( $args = array() ) {
	$defaults = apply_filters( 'et_builder_custom_post_types_defaults', array (
		'post_type' => 'post',
	) );

	$args = wp_parse_args( $args, $defaults );
	$post_types = get_post_types(array('_builtin'=>false,'public'=>true));
	$default_post_type = array('post'=>'post');
	$post_types = $default_post_type + $post_types;
	//print'<pre>';print_r($post_types);print'</pre>';
	
	$output = "\t" . "<% var et_pb_custom_post_types_temp = typeof et_pb_custom_post_types !== 'undefined' ? et_pb_custom_post_types.split( ',' ) : []; %>" . "\n";

	
	foreach ( $post_types as $post_type ) {
		$contains = sprintf(
			'<%%= _.contains( et_pb_custom_post_types_temp, "%1$s" ) ? checked="checked" : "" %%>',
			esc_html( $post_type )
		);

		$output .= sprintf(
			'%4$s<label><input type="checkbox" class="et_dp_post_type" name="et_pb_custom_post_types" value="%1$s"%3$s> %2$s</label><br/>',
			esc_attr( $post_type ),
			esc_html( ucfirst($post_type) ),
			$contains,
			"\n\t\t\t\t\t"
		);
	}

	return apply_filters( 'et_builder_custom_post_types_option_html', $output );
}
endif;



if ( ! function_exists( 'et_builder_divi_include_categories_option' ) ) :
function et_builder_divi_include_categories_option( $args = array() ) {
	$defaults = apply_filters( 'et_builder_include_categories_defaults', array (
		'use_terms' => true,
		'term_name' => 'project_category',
	) );

	$args = wp_parse_args( $args, $defaults );

	$cats_array[0] = get_categories( apply_filters( 'et_builder_get_categories_args', 'hide_empty=0' ) );

	$argsX = array(
			'public'   => true,
			'_builtin' => false
	
		); 
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$taxonomies = get_taxonomies( $argsX, $output, $operator ); 
	if ( $taxonomies ) {
		foreach ( $taxonomies  as $taxonomy ) {
			if (get_terms( $taxonomy )){
				$cats_array[] = get_terms( $taxonomy );
			}
		}
	}

	$output = "\t" . "<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>" . "\n";

	/*if ( $args['use_terms'] ) {
		$cats_array = get_terms( $args['term_name'] );
	} else {
		$cats_array = get_categories( apply_filters( 'et_builder_get_categories_args', 'hide_empty=0' ) );
	}*/

	if ( empty( $cats_array ) ) {
		$output = '<p>' . esc_html__( "You currently don't have any projects assigned to a category.", 'et_builder' ) . '</p>';
	}

	global $wpdb;
	for($i=0;$i<count($cats_array);$i++){
		foreach ( $cats_array[$i] as $category ) {
			$post_type = '';
			$object_id = $wpdb->get_var("Select object_id from ".$wpdb->prefix."term_relationships tr Left Join ".$wpdb->prefix."term_taxonomy tt 
											on tt.term_taxonomy_id = tr.term_taxonomy_id where tt.term_id='".$category->term_id."'");
			
			$post_type = $wpdb->get_var("Select post_type from ".$wpdb->prefix."posts where ID='$object_id'");
			
			if($post_type <> ''){//IF category have no post//
				if($post_type == 'post')$this_post_type = '';
				else $this_post_type = ' ('.ucfirst($post_type).')';
				
				$contains = sprintf(
					'<%%= _.contains( et_pb_include_categories_temp, "%1$s" ) ? checked="checked" : "" %%>',
					esc_html( $category->term_id )
				);
		
				$output .= sprintf(
					'%4$s<label><input type="checkbox" class="et_dp_'.$post_type.'" name="et_pb_include_categories" value="%1$s"%3$s> %2$s '.$this_post_type.'</label><br/>',
					esc_attr( $category->term_id ),
					esc_html( $category->name ),
					$contains,
					"\n\t\t\t\t\t"
				);
			}//IF category have no post//
		}
	}

	return apply_filters( 'et_builder_include_categories_option_html', $output );
}
endif;
?>