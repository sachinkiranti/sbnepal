<?php
/*
Plugin Name: NativeX Extended Form
Description: NativeX Extended Form Plugin
Text Domain: nativex-extended-form
*/

// Prevent Direct Access
defined('ABSPATH') or die("Restricted access!");

$nativex_base_dir = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));

register_activation_hook( __FILE__, 'nativex_extended_form_db_init' );

if ( ! function_exists( 'nativex_extended_form_db_init' ) ) :

    function nativex_extended_form_db_init () {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'nativex_extended_form';

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            full_name VARCHAR (255) NOT NULL,
            email VARCHAR (255) NOT NULL,
            company_name VARCHAR (255) NOT NULL,
            phone VARCHAR (255) NOT NULL,
            UNIQUE KEY id (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

endif;

/**
 * Register admin menu
 */
if ( ! function_exists( 'nativex_extended_form_admin_menu' ) ) :

    function nativex_extended_form_admin_menu () {
        add_menu_page(
            __('NEX Form', 'nativex-extended-form'),
            __('NativeX Extended Form', 'nativex-extended-form'),
            'activate_plugins',
            'nativex-extended-form',
            'nativex_extended_form_page_handler',
            'dashicons-editor-outdent'
        );
    }

endif;

add_action( 'admin_menu', 'nativex_extended_form_admin_menu' );

include 'nativex-extended-form-list.php';

include 'nativex-extended-form-shortcode.php';
