<?php

/*
Plugin Name: Wp Refers IP Address
Plugin URI: https://wprefers.com/plugins/wprefers-ip-address
Description: Instagram Lite Tool helps you find the instagram ID, Profile Picture and many other.
Version: 1.0.0
Author: sachinkiranti
Author URI: https://raisachin.com.np
Text Domain: wprefers-ip-address
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

include 'libs/lookup-api.php';

// Shortcode for the Frontend UI
if (! function_exists('wprefers_ip_address_shortcode')) :

    function wprefers_ip_address_shortcode( $atts )
    {
        extract(shortcode_atts(
            array(
                'title' => 'Instagram'
            ), $atts ));

        $file_path = dirname(__FILE__) . '/templates/wprefers-ip-address-frontend.php';

        $ipData = wprefers_get_my_location();

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'wprefers-ip-address', 'wprefers_ip_address_shortcode' );

if (! function_exists('wprefers_ip_address_enqueue_scripts')) :

    function wprefers_ip_address_enqueue_scripts() {
        global $post;

        if ( ( is_single() || is_page() ) && has_shortcode( $post->post_content, 'wprefers-ip-address') ) {
            wp_enqueue_style('wprefers-ip-address-leaflet', 'https://unpkg.com/leaflet@1.8.0/dist/leaflet.css');
            wp_enqueue_script('wprefers-ip-address-script', plugin_dir_url(__FILE__) . 'js/wprefers-ip-address.js', array('jquery', 'wprefers-js-ip-address-script'), null, true);

            wp_enqueue_script('wprefers-js-ip-address-script', 'https://unpkg.com/leaflet@1.8.0/dist/leaflet.js', array('jquery'), null, true);
        }
    }

endif;
add_action( 'wp_enqueue_scripts', 'wprefers_ip_address_enqueue_scripts' );
//
//function wprefers_ip_address_script_loader_tag($tag, $handle, $src) {
//
//    if ($handle === 'wprefers-js-ip-address-script') {
//
//        if (false === stripos($tag, 'integrity')) {
//
//            $tag = str_replace(' src', ' integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="" src', $tag);
//
//        }
//
//    }
//
//    return $tag;
//
//}
//add_filter('script_loader_tag', 'wprefers_ip_address_script_loader_tag', 10, 3);
//
//
//function wprefers_ip_address_style_loader_tag($tag, $handle, $src) {
//
//    if ($handle === 'wprefers-ip-address-leaflet') {
//
//        if (false === stripos($tag, 'integrity')) {
//
//            $tag = str_replace(' href', ' integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="" href', $tag);
//
//        }
//
//    }
//
//    return $tag;
//
//}
//add_filter('style_loader_tag', 'wprefers_ip_address_style_loader_tag', 10, 3);