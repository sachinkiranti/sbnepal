<?php
/**
 * SmartMag Theme!
 * 
 * This is the typical theme initialization file. Sets up the Bunyad Framework
 * and the theme functionality.
 * 
 * ----
 * 
 * Other Code Locations:
 * 
 *  /               -  WordPress default template files.
 *  lib/            -  Contains the core Bunyad framework files.
 *  inc/            -  Functions & Classes: Helpers, Hooks, Objects.
 *  admin/          -  Admin-only content.
 *  blocks/         -  Several loops and components used in the theme.
 *  partials/       -  Template parts (partials): Views & HTML.
 *  page-templates/ -  Custom page templates.
 *  
 * NOTE: If you're looking to edit HTML, look for default WordPress templates in
 * top-level / and in partials/ folder. Use same location in a Child Theme.
 * 
 */
define('BUNYAD_THEME_VERSION', '5.3.0');

// Already initialized - some buggy plugin call?
if (class_exists('Bunyad_Core')) {
	return;
}

/**
 * Initialize Framework
 * 
 * Include the Bunyad_Base and extend it using our theme-specific class.
 */ 
require_once get_theme_file_path('lib/bunyad.php');
require_once get_theme_file_path('inc/bunyad.php');

/**
 * Main Theme File: Contains most theme-related functionality
 * 
 * See file:  inc/theme.php
 */
require_once get_theme_file_path('inc/theme.php');

// Fire up the theme - make available in Bunyad::get('theme')
Bunyad::register('theme', [
	'class' => 'Bunyad_Theme_SmartMag',
	'init'  => true
]);

// Legacy compat: Alias
Bunyad::register('smart_mag', ['object' => Bunyad::get('theme')]);

/**
 * Main Framework Configuration
 */
$bunyad = Bunyad::core()->init(apply_filters('bunyad_init_config', [
	// Due to legacy compatibility, it's named smartmag without dash.
	'theme_name'  => 'smartmag',

	// For retrieving meta values from core plugin.
	'meta_prefix' => '_bunyad',

	// Legacy compat.
	'theme_version' => BUNYAD_THEME_VERSION,
	
	// Widgets enabled.
	'post_formats' => ['gallery', 'image', 'video', 'audio'],
	
	// Sphere Core plugin components
	'sphere_components' => ['social-follow', 'breadcrumbs', 'auto-load-post'],

	'add_sidebar_class' => false,
]));

/**
 * Category & Tags for Page
 */

function sachinkiranti_add_category_tag_for_pages () {
	register_taxonomy_for_object_type('category', 'page');
	register_taxonomy_for_object_type('post_tag', 'page');
}
add_action( 'init', 'sachinkiranti_add_category_tag_for_pages');
									  
function sachinkiranti_pages_with_category_and_tag_register($query) {
	if ( is_admin() || ! $query->is_main_query() ) {
	    return;
	}
	
	if($query->is_category && $query->is_main_query()){
		$query->set('post_type', array( 'post', 'page'));
	}
	if($query->is_tag && $query->is_main_query()){
	    $query->set('post_type', array( 'post', 'page'));
	}
}	
add_action( 'pre_get_posts', 'sachinkiranti_pages_with_category_and_tag_register' );
