<?php
/*
Plugin Name: Wp Refers Instagram Lite
Plugin URI: https://wprefers.com/plugins/wprefers-instagram-lite
Description: Instagram Lite Tool helps you find the instagram ID, Profile Picture and many other.
Version: 1.0.0
Author: sachinkiranti
Author URI: https://raisachin.com.np
Text Domain: wprefers-instagram-lite
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
if (! function_exists('wprefers_instagram_lite_shortcode')) :

    function wprefers_instagram_lite_shortcode( $atts )
    {
        extract(shortcode_atts(
            array(
                'title' => 'Instagram'
            ), $atts ));

        $file_path = dirname(__FILE__) . '/templates/wprefers-instagram-lite-frontend.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'wprefers-instagram-lite', 'wprefers_instagram_lite_shortcode' );

include 'libs/insta-api.php';

// Script
if (! function_exists('wprefers_instagram_lite_enqueue_scripts')) :

    function wprefers_instagram_lite_enqueue_scripts()
    {
        global $post;

        if ((is_single() || is_page()) && has_shortcode($post->post_content, 'wprefers-instagram-lite')) {
            wp_enqueue_script('wprefers-insta-script', plugin_dir_url(__FILE__) . 'assets/wprefers-insta-script.js', array('jquery'), null, true);
            wp_localize_script('wprefers-insta-script', "wprefers_insta_script_data", array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'action' => 'wprefers_instagram_lite_xhr_action',
                'security' => wp_create_nonce("wprefers-instagram-lite-xhr-nonce")
            ));
        }
    }

endif;
add_action( 'wp_enqueue_scripts', 'wprefers_instagram_lite_enqueue_scripts' );

