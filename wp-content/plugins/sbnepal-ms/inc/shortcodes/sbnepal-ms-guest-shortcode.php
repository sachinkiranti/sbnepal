<?php

require_once dirname(__FILE__) . '/../sbnepal-ms-assets.php';

if ( ! function_exists('sbnepal_ms_guest_shortcode') ) :

    function sbnepal_ms_guest_shortcode( $atts ) {
        global $sbNepalBaseDir;

        extract( shortcode_atts(
                array(
                    'title'        => 'Smart Business In Nepal',
                    'tagline'      => 'Quality Businesses is our comment',
                    'register' => null,
                    'login' => null
                ), $atts )
        );

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