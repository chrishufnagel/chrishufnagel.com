<?php
/**
 * Rockbase Child functions
 *
 * @package Rockbase Child
 * @author  Rockbase LLC
 * @license GNU General Public License v2 or later
 * @link    https://rockbase.co
 */

namespace rckbs_child;

/**
 * Load customizations
 *
 * Adds custom includes for custom functionality.
 * Delete if not needed.
 */
function rckbs_child_load_customizations() {

	add_editor_style( '/assets/css/main.css' );

	// Add new pattern categories
	require_once get_stylesheet_directory() . '/inc/load-custom-pattern-categories.php';

	// Add custom ACF blocks
	require_once get_stylesheet_directory() . '/inc/acf-config.php';

}
add_action( 'after_setup_theme', __NAMESPACE__ . '\rckbs_child_load_customizations' );

/**
 * Load scripts and styles
 *
 * Adds custom stylesheet.
 * Adds custom scripts.
 */
function enqueue_rckbs_child_scripts() {

	$front_script_asset = include get_theme_file_path( 'assets/dist/js/front.asset.php'  );

	wp_enqueue_script(
		'rckbs-child-front-scripts',
		get_theme_file_uri( 'assets/dist/js/front.js' ),
		$front_script_asset['dependencies'],
		$front_script_asset['version'],
		true
	);

	wp_enqueue_style( 
		'rckbs-child-main-styles', 
		get_stylesheet_directory_uri() . '/assets/css/main.css', 
		array(), 
		wp_get_theme()->get( 'Version' ) 
	);

}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_rckbs_child_scripts' );

/**
 * Enqueues the Rockbase Child editor assets
 *
 * This function is used to enqueue the Rockbase editor assets in the WordPress theme.
 *
 * @package rckbs
 * @since 1.0.0
 */
function rckbs_child_block_editor_assets() {

	$editor_script_asset = include get_theme_file_path( 'assets/dist/js/editor.asset.php'  );

	wp_enqueue_script(
		'rckbs-child-editor-scripts',
		get_theme_file_uri( 'assets/dist/js/editor.js' ),
		$editor_script_asset['dependencies'],
		$editor_script_asset['version'],
		true
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\rckbs_child_block_editor_assets' );