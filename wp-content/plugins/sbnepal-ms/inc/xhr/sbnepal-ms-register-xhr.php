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
        'message' => 'Token Mismatched Error.',
        'status'  => 'invalid'
    ), false );

}

// Already logged in
if ( is_user_logged_in() ) {
    sbnepal_ms_response( array(
        'message' => 'You are already logged in.',
        'status'  => 'invalid'
    ), false );
}

if ( ! function_exists('sbnepal_ms_resolve_register_data') ) :

    function sbnepal_ms_resolve_register_data ( $formData ) {
        $error = []; // validation messages
        $data  = []; // success  data

        foreach ( $formData as $column => $value ) {
            $value = stripslashes( $value );

            if ($column === 'email') {
                if (email_exists($value)) {
                    $error[$column] = "The email address should be unique.";
                }
            } else {
                if(! $value ) {
                    $error[$column] = "Please enter your ". str_replace( '_', ' ', $column ) . '.';
                } else {
                    $data[$column]  = $value;
                }
            }
        }

        if ( count( $error ) > 0 ) {
            sbnepal_ms_response( array(
                'errors' => $error,
                'status' => 'validation',
            ), false );

            return false;
        }

        sbnepal_ms_response( array(
            'message' => 'Something went wrong while creating a new agent.',
            'status'  => 'invalid'
        ), false );

        $email = sanitize_text_field( $data['email'] );
        $password = sanitize_text_field( $data['password'] );
        $referralId = sanitize_text_field( $data['referral_id'] );
        $name = sanitize_text_field( $data['name'] );
        $fatherName = sanitize_text_field( $data['father_name'] );
        $address = sanitize_text_field( $data['address'] );
        $citizenshipNo = sanitize_text_field( $data['citizenship_no'] );
        $qualification = sanitize_text_field( $data['qualification'] );
        $phoneNumber = sanitize_text_field( $data['phone_number'] );
        $password = sanitize_text_field( $data['password'] );
        $passwordConfirmation = sanitize_text_field( $data['password_confirmation'] );
    }

endif;

sbnepal_ms_resolve_register_data( $_POST );