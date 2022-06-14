<?php
/*
Plugin Name: Wp Refers Domain Availability Checker
Plugin URI: https://wprefers.com/plugins/wprefers-domain-availability-checker
Description: Keyword Generator Tool helps you discover keyword opportunities related to your query input.
Version: 1.0.0
Author: sachinkiranti
Author URI: https://raisachin.com.np
Text Domain: wprefers-kg
Author Email: sachinkiranti@gmail.com
License:

  Copyright 2019  (sachinkiranti@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program. If not, see <http://www.gnu.org/licenses/>.

*/

defined( 'ABSPATH' ) or die( 'No direct access!' );

// Shortcode for the Frontend UI
if (! function_exists('wprefers_domain_availability_checker_shortcode')) :

    function wprefers_domain_availability_checker_shortcode( $atts )
    {
        extract(shortcode_atts(
            array(
                'title' => 'Domain Availability Checker',
                'whoiskey' => null,
                'referralurl' => null, // url to buy the available domain 
                'suggestions' => 'yes' // Yes/no
            ), $atts ));

        $file_path = dirname(__FILE__) . '/templates/wprefers-domain-availability-checker-frontend.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'wprefers-domain-availability-checker', 'wprefers_domain_availability_checker_shortcode' );

include 'libs/who-is-api.php';

// Script
if (! function_exists('wprefers_domain_availability_checker_enqueue_scripts')) :

    function wprefers_domain_availability_checker_enqueue_scripts()
    {
        global $post;

        if ((is_single() || is_page()) && has_shortcode($post->post_content, 'wprefers-domain-availability-checker')) {
            wp_enqueue_script('wprefers-dac-script', plugin_dir_url(__FILE__) . 'assets/wprefers-dac-script.js', array('jquery'), null, true);
            wp_localize_script('wprefers-dac-script', "wprefers_dac_script_data", array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'action' => 'wprefers_domain_availability_checker_xhr_action',
                'security' => wp_create_nonce("wprefers-domain-availability-checker-xhr-nonce")
            ));
        }
    }

endif;
add_action( 'wp_enqueue_scripts', 'wprefers_domain_availability_checker_enqueue_scripts' );

