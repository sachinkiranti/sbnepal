<?php

$plugin_name = 'nativex-extended-form';
$oldURL      = dirname(__FILE__);
$newURL      = str_replace(DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $plugin_name, '', $oldURL);
include( $newURL . DIRECTORY_SEPARATOR . 'wp-load.php' );

// CSRF Validation
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-nativex-extended-form') ) {

    nativex_extended_form_response( array(
        'message' => 'Invalid Request.',
        'status'  => 'invalid'
    ), false );

}

if ( ! function_exists('nativex_extended_form_resolve_data') ) :

    function nativex_extended_form_resolve_data ( $formData ) {
        $error = []; // validation messages
        $data  = []; // success  data

        foreach ( $formData as $column => $value ) {
            if ($column === 'email') {
                $value = trim( $value );

                if(! $value && !is_email($value) ) {
                    $error[$column] = 'Please enter a valid e-mail address.';;
                } else {
                    $data[$column]  = $value;
                }
            } else {
                $value = stripslashes( $value );

                if(! $value ) {
                    $error[$column] = "Please enter your ". str_replace( '_', ' ', $column ) . '.';
                } else {
                    $data[$column]  = $value;
                }
            }
        }

        if ( count( $error ) > 0 ) {
            nativex_extended_form_response( array(
                'errors' => $error,
                'status' => 'validation',
            ), false );
        }
        global $wpdb;

        $table_name = $wpdb->prefix . "nativex_extended_form";

        $wpdb->insert( $table_name, array(
            'company_name' => sanitize_text_field( $data['company_name'] ),
            'email'        => sanitize_email( $data['email'] ),
            'full_name'    => sanitize_text_field( $data['full_name'] ),
            'phone'        => $data['telephone'],
        ) );
        nativex_extended_form_response([
            'message' => 'Your form has been successfully submitted. Thank you',
            'status'  => 'success'
        ]);
    }

endif;

if ( ! function_exists( 'nativex_extended_form_response' ) ) :

    /**
     * $response array
     * $status bool ie. 1 : success and 0 : failure
     */
    function nativex_extended_form_response ($response, $status = true) {
        if ( $status ) {
            wp_send_json_success($response);
        }
        wp_send_json_error($response);
        die;
    }

endif;

nativex_extended_form_resolve_data( $_POST );