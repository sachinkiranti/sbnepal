<?php

/*
Plugin Name: Wp Refers Text To Speech
Plugin URI: https://wprefers.com/plugins/wprefers-text-to-speech
Description: Text To Speech Tool helps you add the audio player section for your content.
Version: 1.0.0
Author: sachinkiranti
Author URI: https://raisachin.com.np
Text Domain: wprefers-text-to-speech
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
if (! function_exists('wprefers_text_to_speech_shortcode')) :

    function wprefers_text_to_speech_shortcode( $atts )
    {
        extract(shortcode_atts(
            array(
                'title'   => 'Text To Speech',
                'element' => '.post-content'
            ), $atts ));

        $file_path = dirname(__FILE__) . '/templates/wprefers-text-to-speech-frontend.php';

        $ipData = wprefers_get_my_location();

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'wprefers-text-to-speech', 'wprefers_text_to_speech_shortcode' );

if (! function_exists('wprefers_text_to_speech_append_shortcode')) :

    function wprefers_text_to_speech_append_shortcode ($content) {
        global $post;
        if( ! $post instanceof WP_Post ) return $content;

        $withShortcode = do_shortcode( '[wprefers-text-to-speech]' );

        switch( $post->post_type ) {
            case 'post':
                return $withShortcode.$content;
            case 'page':
                return $withShortcode.$content;
            default:
                return $content;
        }
    }

endif;
add_filter( 'the_content', 'wprefers_text_to_speech_append_shortcode', 11, 1 );

if (! function_exists('wprefers_text_to_speech_enqueue_scripts')) :

    function wprefers_text_to_speech_enqueue_scripts() {
        global $post;
        // && has_shortcode( $post->post_content, 'wprefers-text-to-speech')
        if ( ( is_single() || is_page() ) ) {
            wp_enqueue_style('wtts-css', plugin_dir_url(__FILE__) . 'css/wtts.css');
            wp_enqueue_script('wtts-script', plugin_dir_url(__FILE__) . 'js/wtts.js', array('jquery'), null, true);
        }
    }

endif;
add_action( 'wp_enqueue_scripts', 'wprefers_text_to_speech_enqueue_scripts' );