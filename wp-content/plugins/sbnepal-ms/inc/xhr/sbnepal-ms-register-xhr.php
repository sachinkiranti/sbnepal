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
//if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-register') ) {
//    sbnepal_ms_response( array(
//        'message' => 'Token Mismatched Error.',
//        'status'  => 'invalid'
//    ), false );
//
//}

// Already logged in
if ( is_user_logged_in() ) {
    sbnepal_ms_response( array(
        'message' => 'You are already logged in.',
        'status'  => 'invalid'
    ), false );
}

if ( ! function_exists('sbnepal_ms_resolve_register_data') ) :

    function sbnepal_ms_resolve_register_data ( $formData, $files ) {
        $error = []; // validation messages
        $data  = []; // success  data

        parse_str($formData['form'], $result);

        foreach ( $result as $column => $value ) {
            $value = stripslashes( $value );

            if ($column === 'email') {
                if (email_exists($value)) {
                    $error[$column] = "The email address should be unique.";
                } else {
                    $data[$column]  = $value;
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

        $data['user_email'] = sanitize_email( $result['email'] );
        $data['password'] = sanitize_text_field( $result['password'] );
        $data['referral_id'] = sanitize_text_field( $result['referral_id'] );
        $data['name'] = sanitize_text_field( $result['name'] );
        $data['father_name'] = sanitize_text_field( $result['father_name'] );
        $data['address'] = sanitize_text_field( $result['address'] );
        $data['citizenship_no'] = sanitize_text_field( $result['citizenship_no'] );
        $data['qualification'] = sanitize_text_field( $result['qualification'] );
        $data['phone_number'] = sanitize_text_field( $result['phone_number'] );
        $data['user_pass'] = sanitize_text_field( $result['password'] );
        $data['password_confirmation'] = sanitize_text_field( $result['password_confirmation'] );

        // image
        $data['passport_size_photo'] = $files['passport_size_photo'];
        $data['citizenship_photo'] = $files['citizenship_photo'];
        $data['signature_photo'] = $files['signature_photo'];

        if (sbnepal_ms_agent_insert_agent( $data )) {
            sbnepal_ms_response( array(
                'url'    => home_url(sanitize_text_field( $data['dashboard'] )),
                'status' => 'success',
            ) );
        } else {
            sbnepal_ms_response( array(
                'message' => 'Something went wrong while creating a new agent.',
                'status'  => 'invalid'
            ), false );
        }
    }

endif;

sbnepal_ms_resolve_register_data( $_POST, $_FILES );