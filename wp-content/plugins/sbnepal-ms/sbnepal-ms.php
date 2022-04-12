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

        // Creating a agent role
        add_role(
            'agent', //  System name of the role.
            __( 'Agent'  ), // Display name of the role.
            array(
                'read'  => true,
                'upload_files'  => true,
            )
        );

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    }

endif;

// Adding the Admin sidebar menu
include  'inc/class-sbnepal-ms-admin-menu.php';

new SBNepal_MS_Admin_Menu();

// Add custom fields
include 'inc/agent/sbnepal-ms-agent-custom-fields.php';

include 'inc/agent/class-sbnepal-ms-agent-list-table.php';
include 'inc/agent/class-sbnepal-ms-agent-functions.php';

include 'inc/sbnepal-ms-toolbar-menu.php';

include 'inc/shortcodes/index.php';

include 'inc/sbnepal-ms-misc-functions.php';