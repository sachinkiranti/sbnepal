<?php

require_once dirname(__FILE__) . '/../sbnepal-ms-assets.php';

if ( ! function_exists('sbnepal_ms_login_shortcode') ) :

    function sbnepal_ms_login_shortcode( $atts ) {
        global $sbNepalBaseDir;

        extract( shortcode_atts(
            array(
                'title'        => 'Login Panel',
                'register' => null,
                'dashboard'    => '/dashboard'
            ), $atts )
        );

        // If already logged in redirect to dashboard
        if ( is_user_logged_in() ) {
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