<?php

require_once dirname(__FILE__) . '/../sbnepal-ms-assets.php';

if ( ! function_exists('sbnepal_ms_register_shortcode') ) :

    function sbnepal_ms_register_shortcode( $atts ) {
        global $sbNepalBaseDir;

        extract( shortcode_atts(
            array(
                'title'        => 'Login Panel',
                'login'        => get_option('sbnepal-ms_redirect-login', '/login'),
                'dashboard'    => get_option('sbnepal-ms_redirect-dashboard', '/dashboard')
            ), $atts )
        );

        // If already logged in redirect to dashboard
        global $pagenow;
        
        if ( is_user_logged_in() && $pagenow !== 'post.php' ) {
            wp_redirect($dashboard);
        }

        $file_path = dirname(__FILE__) . '/../templates/frontend/register/sbnepal-ms-frontend-register.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'sbnepal-ms-register', 'sbnepal_ms_register_shortcode' );
wp_enqueue_script('jquery');