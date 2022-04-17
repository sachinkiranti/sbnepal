<?php
/*
Plugin Name: Prasadi Result System
Description: Prasadi Extended Result System Plugin
Version: 0.1.0
Author: Sachin Kiranti
Author URI: https://raisachin.com.np
Text Domain: prasadi-result-sys
*/

defined('ABSPATH') or die("Restricted access!");

$prasadiBaseDir = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));

register_activation_hook( __FILE__, 'prasadi_result_sys_db_init' );

if ( ! function_exists('prasadi_result_sys_db_init') ) :

    function prasadi_result_sys_db_init () {
        global $wpdb;
        $charsetCollate = $wpdb->get_charset_collate();
        $tableName = $wpdb->prefix . 'prasadi_result_sys_results';
        $facultyTable = $wpdb->prefix . 'prasadi_result_sys_faculties';

        $sqlQuery = "CREATE TABLE $tableName (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            faculty_id INT UNSIGNED,
            symbol_number VARCHAR (255) NOT NULL,
            result VARCHAR (255) NOT NULL,
            appointment_date VARCHAR (255) NULL,
            appointment_time VARCHAR (255) NULL,
            meeting_link VARCHAR (255) NOT NULL,
            meeting_id VARCHAR (255) NOT NULL,
            password VARCHAR (255) NOT NULL,
            UNIQUE KEY id (id)
        ) $charsetCollate;";

        $facultySqlQuery = "CREATE TABLE $facultyTable (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            faculty_name VARCHAR (255) NOT NULL,
            response_message_passed TEXT NULL,
            response_message_scholarship TEXT NULL,
            response_message_failed TEXT NULL,
            response_message_unidentified TEXT NULL,
            UNIQUE KEY id (id)
        ) $charsetCollate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sqlQuery );
        dbDelta( $facultySqlQuery );
    }

endif;

include  'inc/class-prasadi-result-sys-admin-menu.php';

new Prasadi_Result_Sys_Admin_Menu();

include 'inc/faculty/class-prasadi-result-sys-faculty-list-table.php';
include 'inc/faculty/class-prasadi-result-sys-faculty-form-handler.php';
include 'inc/faculty/prasadi-result-sys-faculty-functions.php';

include 'inc/result/class-prasadi-result-sys-result-list-table.php';
include 'inc/result/class-prasadi-result-sys-result-form-handler.php';
include 'inc/result/prasadi-result-sys-result-functions.php';


include 'inc/prasadi-result-sys-importer.php';

include 'inc/prasadi-result-sys-shortcode.php';

function custom_dump($anything){
    add_action('shutdown', function () use ($anything) {
        echo "<pre id=wpwrap style='text-align: center'>";
        print_r($anything);
        echo "</pre>";
        exit;
    });
}