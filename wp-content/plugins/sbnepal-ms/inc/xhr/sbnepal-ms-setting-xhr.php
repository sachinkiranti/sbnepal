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
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-register') ) {
    sbnepal_ms_response( array(
        'message' => 'Invalid Request.',
        'status'  => 'invalid'
    ), false );

}
sleep(5);
if ( ! function_exists('sbnepal_ms_resolve_setting_data') ) :

    function sbnepal_ms_resolve_setting_data ( $formData ) {
        $error = []; // validation messages
        $data  = []; // success  data

        $exceptKeys = array(
            "_wpnonce",
            "_wp_http_referer"
        );

        foreach ( $formData as $column => $value ) {
            $value = stripslashes( $value );

            if(! $value ) {
                $error[$column] = "Please enter your ". str_replace( '_', ' ', $column ) . '.';
            } else {
                $data[$column]  = $value;
            }
        }

        if ( count( $error ) > 0 ) {
            sbnepal_ms_response( array(
                'errors' => $error,
                'status' => 'validation',
            ), false );
        }


        $currentDate = date("Y-m-d H:i:s");

        $data = array_merge($data, array(
            // Update last updated
            'sbnepal_ms_setting_last_updated' => $currentDate,
        ));

        // adding setting options for plugin
        foreach ($data as $key => $value) {

            if (! in_array($key, $exceptKeys, true)) {

                if (! get_option($key)) {
                    // If option does not exists add option else update the option
                    add_option( $key, sanitize_text_field($value) );
                } else {
                    update_option($key, sanitize_text_field($value));
                }
            }
        }

        sbnepal_ms_response( array(
            'formData'   => $data,
            'message'       => 'You have successfully updated the settings for the plugins.',
            'last_updated' => $currentDate,
            'status' => 'success',
        ) );
    }

endif;

sbnepal_ms_resolve_setting_data( $_POST );