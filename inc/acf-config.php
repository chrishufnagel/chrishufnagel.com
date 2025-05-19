<?php
/**
 * Blocks
 *
 * @package      ch
 * @author       Chris Hufnagel
 * @since        1.0.0
 * @license      GPL-2.0+
 **/


// Exit if ACF is not active
 if( ! class_exists('ACF') ) {
	return;
 } else {
	add_action( 'init', 'ali_register_blocks' );
 }

/**
 * Registers custom blocks for the theme.
 * 
 * @link https://www.advancedcustomfields.com/resources/blocks/#block-json-support
 *
 * This function scans the specified directory for custom block directories
 * and registers each block found within that directory.
 *
 * @return void
 */
function ali_register_blocks() {
	$block_directories = glob(get_stylesheet_directory() . "/assets/cc_blocks/*", GLOB_ONLYDIR);

	foreach ($block_directories as $block) {
		register_block_type( $block );
	}
}

/**
 * ACF Set custom load and save JSON points.
 */

add_filter( 'acf/json/load_paths', 'cc_json_load_paths' );
add_filter( 'acf/settings/save_json/type=acf-field-group', 'cc_json_save_path_field_groups' );
add_filter( 'acf/settings/save_json/type=acf-ui-options-page', 'cc_json_save_path_option_pages' );
add_filter( 'acf/settings/save_json/type=acf-post-type', 'cc_json_save_path_post_types' );
add_filter( 'acf/settings/save_json/type=acf-taxonomy', 'cc_json_save_path_taxonomies' );
add_filter( 'acf/json/save_file_name', 'cc_json_filename', 10, 3 );


/**
 * Set a custom ACF JSON load path.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#loading-explained
 *
 * @param array $paths Existing, incoming paths.
 * @return array $paths New, outgoing paths.
 *
 * @since 0.1.1
 */
function cc_json_load_paths( $paths ) {

	$paths[] = get_stylesheet_directory() . '/assets/acf-json/field-groups';
	$paths[] = get_stylesheet_directory() . '/assets/acf-json/options-pages';
	$paths[] = get_stylesheet_directory() . '/assets/acf-json/post-types';
	$paths[] = get_stylesheet_directory() . '/assets/acf-json/taxonomies';

	return $paths;
}

/**
 * Set custom ACF JSON save point for
 * ACF generated post types, field groups, taxonomies, and options pages.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#saving-explained
 *
 * @return string $path New, outgoing path.
 *
 * @since 0.1.1
 */
function cc_json_save_path_post_types() {
	return get_stylesheet_directory() . '/assets/acf-json/post-types';
}

function cc_json_save_path_field_groups() {
	return get_stylesheet_directory() . '/assets/acf-json/field-groups';
}

function cc_json_save_path_taxonomies() {
	return get_stylesheet_directory() . '/assets/acf-json/taxonomies';
}

function cc_json_save_path_option_pages() {
	return get_stylesheet_directory() . '/assets/acf-json/options-pages';
}

/**
 * Customize the file names for each file.
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/#saving-explained
 *
 * @param string $filename  The default filename.
 * @param array  $post      The main post array for the item being saved.
 *
 * @return string $filename
 *
 * @since  0.1.1
 */
function cc_json_filename( $filename, $post ) {
	$filename = str_replace(
		array(
			' ',
			'_',
		),
		array(
			'-',
			'-',
		),
		$post['title']
	);

	$filename = strtolower( $filename ) . '.json';

	return $filename;
}