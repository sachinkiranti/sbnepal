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
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-login') ) {
    sbnepal_ms_response( array(
        'message' => 'Invalid Request.',
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

if ( ! function_exists('sbnepal_ms_resolve_login_data') ) :

    function sbnepal_ms_resolve_login_data ( $formData ) {
        $error = []; // validation messages
        $data  = []; // success  data

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

        $email = sanitize_text_field( $data['email'] );
        $referId = sanitize_text_field( $data['refer_id'] );
        $password = sanitize_text_field( $data['password'] );
        $remember = sanitize_text_field( $data['remember_me'] );

        $login = wp_signon( array(
            'user_login'        => $email,
            'user_password'     => $password,
            'remember'          => $remember,
        ), false );

        $isReferIdValid = $referId != esc_html( get_the_author_meta( 'refer_id', $login->ID ) );
        $isApprovedByAdmin = esc_html( get_the_author_meta( 'is_approved_by_admin', $login->ID ) ) === 'no';

        // logout procedure
        if ($isReferIdValid || $isApprovedByAdmin) {

            if ( $login->ID ) {
                wp_logout();
            }

            sbnepal_ms_response( array(
                'message' => 'The credentials are wrong!',
                'status' => 'failed',
            ), false );
        }

        if ( $login->ID ) {
            sbnepal_ms_response( array(
                'url'    => home_url(sanitize_text_field( $data['dashboard'] )),
                'data'   => $login->roles,
                'status' => 'success',
            ) );
        }  else {
            sbnepal_ms_response( array(
                'message' => 'The credentials are wrong!',
                'url'    => home_url('dashboard'),
                'status' => 'failed',
            ), false );
        }
    }

endif;

sbnepal_ms_resolve_login_data( $_POST );