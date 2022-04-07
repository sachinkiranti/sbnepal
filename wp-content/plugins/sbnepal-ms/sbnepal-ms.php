<?php

/*
Plugin Name: SBNepal Management System
Plugin URI: https://www.sachinkiranti.com/plugins/sbnepal-management-system/
Description: SBNepal Management System plugin allows SBNepal to manage their agents and their commissions with their history.
Version: 1.0.0
Author: sachinkiranti
Author URI: https://raisachin.com.np
Text Domain: sbnepal-ms
*/

// Prevent Direct Access
defined('ABSPATH') or die("Restricted access!");

define( 'SBNEPAL_MS_VERSION', '1.0.0' );

$sbNepalBaseDir = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));

register_activation_hook( __FILE__, 'sbnepal_ms_db_init' );

if ( ! function_exists('sbnepal_ms_db_init') ) :

    function sbnepal_ms_db_init() {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    }

endif;

// Adding the Admin sidebar menu
include  'inc/class-sbnepal-ms-admin-menu.php';

new SBNepal_MS_Admin_Menu();


add_filter( "admin_footer_text" , "sbnepal_ms_custom_admin_footer" );

function sbnepal_ms_custom_admin_footer( $footer_text ) {

    if ( isset( $_GET[ "page" ] ) && strpos($_GET[ "page" ], 'sbnepal-ms') !== false ) {

        $footer_text = __( 'Thanks for using the plugin. Made with <span style="color: #e25555;">♥</span> by <a href="https://raisachin.com.np" target="_blank" rel="nofollow">Sachin kiranti</a>.' );

    }
    return $footer_text;
}

if ( ! function_exists('sb_dump') ) :

    function sb_dump(){
        $anything = func_get_args();

        add_action('shutdown', function () use ($anything) {
            echo "<pre>";
            print_r($anything);
            echo "</pre>";
            exit;
        });
    }

endif;