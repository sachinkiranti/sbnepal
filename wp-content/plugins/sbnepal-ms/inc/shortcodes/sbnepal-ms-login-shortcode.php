<?php

require_once dirname(__FILE__) . '/../sbnepal-ms-assets.php';

if ( ! function_exists('sbnepal_ms_login_shortcode') ) :

    function sbnepal_ms_login_shortcode( $atts ) {
        global $sbNepalBaseDir;

        extract( shortcode_atts(
            array(
                'title'        => 'Login Panel',
                'register'     => get_option('sbnepal-ms_redirect-register', '/register'),
                'dashboard'    => get_option('sbnepal-ms_redirect-dashboard', '/dashboard')
            ), $atts )
        );

        global $wp_customize;

        if ( (defined( 'REST_REQUEST' ) && REST_REQUEST) || isset( $wp_customize ) ) {
            return '[sbnepal-ms-login title="'.$title.'" dashboard="'.$dashboard .'" register="'.$register.'"]';
        }

        // If already logged in redirect to dashboard
        global $pagenow;
        
        if ( $pagenow !== 'post.php' && is_user_logged_in() ) {
            wp_redirect($dashboard);
        }

        $file_path = dirname(__FILE__) . '/../templates/frontend/login/sbnepal-ms-frontend-login.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'sbnepal-ms-login', 'sbnepal_ms_login_shortcode' );
wp_enqueue_script('jquery');