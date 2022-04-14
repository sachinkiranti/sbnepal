<?php

require_once dirname(__FILE__) . '/../sbnepal-ms-assets.php';

if ( ! function_exists('sbnepal_ms_dashboard_shortcode') ) :

    function sbnepal_ms_dashboard_shortcode( $atts ) {
        global $sbNepalBaseDir;

        extract( shortcode_atts(
            array(
                'title'        => 'Agent Dashboard',
                'login'        => '/login'
            ), $atts )
        );

        // If user is not logged in redirect to login
        if ( !is_user_logged_in() ) {
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