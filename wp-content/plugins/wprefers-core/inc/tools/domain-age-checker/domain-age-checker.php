<?php

/**
 * WPRefers : Domain Age Checker
 *
 * @link https://raisachin.com.np
 * @package wprefers-core
 */

// Shortcode for the tools

if (! function_exists('wprefers_domain_age_checker_shortcode')) :

    function wprefers_domain_age_checker_shortcode ( $atts ) {
        extract(shortcode_atts(
            array(
                'title' => 'Domain Age Checker',
            ), $atts ));

        $file_path = dirname(__FILE__) . '/templates/wprefers-domain-age-checker-frontend.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'wprefers-domain-age-checker', 'wprefers_domain_age_checker_shortcode' );

include 'domain-age-checker-xhr.php';

// Script
if (! function_exists('wprefers_domain_age_checker_enqueue_scripts')) :

    function wprefers_domain_age_checker_enqueue_scripts()
    {
        global $post;

        if ((is_single() || is_page()) && has_shortcode($post->post_content, 'wprefers-domain-age-checker')) {
            wp_enqueue_script('wprefers-da-script', plugin_dir_url(__FILE__) . 'js/wprefers-da-script.js', array('jquery'), null, true);
            wp_localize_script('wprefers-da-script', "wprefers_da_script_data", array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'action' => 'wprefers_domain_age_checker_xhr_action',
                'security' => wp_create_nonce("wprefers-domain-age-checker-xhr-nonce")
            ));
        }
    }

endif;
add_action( 'wp_enqueue_scripts', 'wprefers_domain_age_checker_enqueue_scripts' );