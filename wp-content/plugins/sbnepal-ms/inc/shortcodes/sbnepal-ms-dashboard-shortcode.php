<?php

require_once dirname(__FILE__) . '/../sbnepal-ms-assets.php';

if ( ! function_exists('sbnepal_ms_dashboard_shortcode') ) :

    function sbnepal_ms_dashboard_shortcode( $atts ) {
        global $sbNepalBaseDir;

        extract( shortcode_atts(
            array(
                'title'        => 'Agent Dashboard',
                'login'        => get_option('sbnepal-ms_redirect-login', '/login'),
                'register'     => get_option('sbnepal-ms_redirect-register', '/register')
            ), $atts )
        );

        global $wp_customize;

        if ( (defined( 'REST_REQUEST' ) && REST_REQUEST) || isset( $wp_customize ) ) {
            return '[sbnepal-ms-dashboard title="'.$title.'" register="'.$register .'" login="'.$login.'"]';
        }

        // If user is not logged in redirect to login
        global $pagenow;
        
        if ( !is_user_logged_in() && $pagenow !== 'post.php' ) {
            wp_redirect($login);
        }


        $file_path = dirname(__FILE__) . '/../templates/frontend/dashboard/sbnepal-ms-frontend-dashboard.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'sbnepal-ms-dashboard', 'sbnepal_ms_dashboard_shortcode' );
wp_enqueue_script('jquery');