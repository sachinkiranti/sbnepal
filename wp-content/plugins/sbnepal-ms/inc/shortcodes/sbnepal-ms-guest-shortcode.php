<?php

require_once dirname(__FILE__) . '/../sbnepal-ms-assets.php';

if ( ! function_exists('sbnepal_ms_guest_shortcode') ) :

    function sbnepal_ms_guest_shortcode( $atts ) {
        global $sbNepalBaseDir;

        extract( shortcode_atts(
                array(
                    'title'        => 'Smart Business In Nepal',
                    'tagline'      => 'Quality Businesses is our comment',
                    'login'        => get_option('sbnepal-ms_redirect-login', '/login'),
                    'register'     => get_option('sbnepal-ms_redirect-register', '/register'),
                    'dashboard'    => get_option('sbnepal-ms_redirect-dashboard', '/dashboard'),
                ), $atts )
        );

        global $wp_customize;

        if ( (defined( 'REST_REQUEST' ) && REST_REQUEST) || isset( $wp_customize ) ) {
            return '[sbnepal-ms-guest title="'.$title.'" dashboard="'.$dashboard .'" login="'.$login.'" register="'.$register.'"]';
        }

        // If already logged in redirect to dashboard
        global $pagenow;
        
        if ( is_user_logged_in() && $pagenow !== 'post.php' ) {
            wp_redirect($dashboard);
        }

        $file_path = dirname(__FILE__) . '/../templates/frontend/sbnepal-ms-frontend-guest.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'sbnepal-ms-guest', 'sbnepal_ms_guest_shortcode' );
wp_enqueue_script('jquery');