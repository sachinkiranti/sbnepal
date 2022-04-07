<?php
/*
Plugin Name: ThemeMiles Poll Survey
Plugin URI: https://www.thememiles.com/plugins/thememiles-poll-survey/
Description: ThemeMiles Poll Survey plugin allows you to create unlimited user poll or voting system into your WordPress post/page.
Version: 1.0.0
Author: ThemeMiles
Author URI: https://www.thememiles.com
Text Domain: thememiles-poll-survey
*/

define( 'WP_THEMEMILES_POLL_SURVEY_VERSION', '1.0.0' );

add_action( 'plugins_loaded', 'thememiles_poll_survey_text_domain' );

if ( ! function_exists('thememiles_poll_survey_text_domain') ) :

    function thememiles_poll_survey_text_domain () {
        load_plugin_textdomain( 'thememiles-poll-survey' );
    }

endif;

register_activation_hook( __FILE__, 'thememiles_poll_survey_activation' );

if ( ! function_exists('thememiles_poll_survey_activation') ) :

    function thememiles_poll_survey_activation () {
        thememiles_poll_survey_activate();
    }

endif;

if ( ! function_exists('thememiles_poll_survey_activate') ) :

    function thememiles_poll_survey_activate () {
        global $wpdb;

        if(@is_file(ABSPATH.'/wp-admin/includes/upgrade.php')) {
            include_once(ABSPATH.'/wp-admin/includes/upgrade.php');
        } elseif(@is_file(ABSPATH.'/wp-admin/upgrade-functions.php')) {
            include_once(ABSPATH.'/wp-admin/upgrade-functions.php');
        } else {
            die('ThemeMiles Poll Survey : There seems to be a problem finding files \'/wp-admin/upgrade-functions.php\' and \'/wp-admin/includes/upgrade.php\'');
        }

        $charset_collate = $wpdb->get_charset_collate();

        $table_name = $wpdb->prefix.'thememiles_poll_survey';

        $sqlQuery = "CREATE TABLE $table_name (
            tps_id mediumint(9) NOT NULL AUTO_INCREMENT,
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
    }

endif;