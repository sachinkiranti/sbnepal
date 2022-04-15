<?php

$plugin_name = 'sbnepal-ms';

include( preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__) . 'wp-load.php' );

if ( ! function_exists('sbnepal_ms_response') ) :

    /**
     * $response array
     * $status bool ie. 1 : success and 0 : failure
     */
    function sbnepal_ms_response ($response, $status = true) {
        if ( $status ) {
            wp_send_json_success($response);
        }
        wp_send_json_error($response);
        die;
    }

endif;

// CSRF Validation
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-add-agent') ) {
    sbnepal_ms_response( array(
        'message' => 'CSRF Token Mismatched.',
        'status'  => 'invalid'
    ), false );

}

if ( ! function_exists('sbnepal_ms_resolve_add_agent_data') ) :

    function sbnepal_ms_resolve_add_agent_data ( $formData ) {
        sbnepal_ms_response( array(
            'message' => 'Something went wrong while creating a new agent.',
            'status'  => 'invalid'
        ), false );

    }

endif;

sbnepal_ms_resolve_add_agent_data( $_POST );