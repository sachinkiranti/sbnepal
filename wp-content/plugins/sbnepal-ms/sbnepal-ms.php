<?php

/*
Plugin Name: SBNepal Management System
Plugin URI: https://www.raisachin.com.np/plugins/sbnepal-management-system/
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

        // Creating a agent role
        add_role(
            'agent', //  System name of the role.
            __( 'Agent'  ), // Display name of the role.
            array(
                'read'  => true,
                'upload_files'  => true,
            )
        );

        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $tableName = $wpdb->prefix . 'sbnepal_ms_wallet';
        $hierarchyTableName = $wpdb->prefix . 'sbnepal_ms_user_hierarchy';

        $sqlQuery = "CREATE TABLE $tableName (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            added_by INT UNSIGNED,
            user_id INT UNSIGNED,
            commission DECIMAL(8,2),
            last_level_commission_level TINYINT(10) ZEROFILL,
            last_level_commission DECIMAL(8,2),
            is_paid boolean not null default 0,
            UNIQUE KEY id (id)
        ) $charsetCollate;";

        $hierarchySqlQuery = "CREATE TABLE $hierarchyTableName (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            parent_id INT UNSIGNED,
            user_id INT UNSIGNED,
            parent_list TEXT NULL,
            UNIQUE KEY id (id)
        ) $charsetCollate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sqlQuery );
        dbDelta( $hierarchySqlQuery );
    }

endif;

// Adding the Admin sidebar menu
include  'inc/class-sbnepal-ms-admin-menu.php';

new SBNepal_MS_Admin_Menu();

// Add notices
include 'inc/lib/sbnepal-ms-flash.php';

// Add custom fields
include 'inc/agent/sbnepal-ms-agent-custom-fields.php';

include 'inc/agent/class-sbnepal-ms-agent-list-table.php';
include 'inc/agent/class-sbnepal-ms-agent-form-handler.php';
include 'inc/agent/class-sbnepal-ms-agent-functions.php';

// Hierarchy
include 'inc/hierarchy/class-sbnepal-ms-hierarchy-functions.php';

include 'inc/sbnepal-ms-toolbar-menu.php';

include 'inc/shortcodes/index.php';

include 'inc/sbnepal-ms-misc-functions.php';

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'sbnepal_ms_add_plugin_page_settings_link');

if (! function_exists('sbnepal_ms_add_plugin_page_settings_link')) :

    function sbnepal_ms_add_plugin_page_settings_link( $links ) {
        return array_merge(array(
            '<a href="' .
            admin_url( 'admin.php?page=sbnepal-ms-setting' ) .
            '">' . __('Setting') . '</a>',
            '<a href="' .
            admin_url( 'admin.php?page=sbnepal-ms' ) .
            '">' . __('Dashboard') . '</a>'
        ),  $links);
    }

endif;