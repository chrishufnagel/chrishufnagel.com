<?php 
/**
 * Register Custom Block Pattern Categories
 *
 * @package Rckbs Child
 * @author  Rockbase LLC
 * 
 */

/**
 * Register block pattern categories
 * https://developer.wordpress.org/reference/functions/register_block_pattern_category/
 */

function register_custom_pattern_categories() {
	register_block_pattern_category(
		'rckbs-child',
		array(
			'label'       => __( 'CH Theme', __NAMESPACE__ ),
			'description' => __( 'Custom patterns for the CH Theme theme.', 'jasonfeifer' ),
		)
	);
}

add_action( 'init', __NAMESPACE__ . '\register_custom_pattern_categories' );