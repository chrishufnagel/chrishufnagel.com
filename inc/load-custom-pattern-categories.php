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
			'label'       => __( 'Rockbase Child', __NAMESPACE__ ),
			'description' => __( 'Custom patterns for the Rockbase Child theme.', 'jasonfeifer' ),
		)
	);
}

add_action( 'init', __NAMESPACE__ . '\register_custom_pattern_categories' );