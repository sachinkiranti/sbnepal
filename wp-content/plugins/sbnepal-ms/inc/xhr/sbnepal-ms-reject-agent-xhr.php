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
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-agent-reject') ) {
    sbnepal_ms_response( array(
        'message' => 'CSRF Token Mismatched.',
        'status'  => 'invalid'
    ), false );

}


if ( ! function_exists('sbnepal_ms_resolve_agent_reject_data') ) :

    function sbnepal_ms_resolve_agent_reject_data ( $formData ) {
        $error = []; // validation messages

        $agentId = $formData['agentId'];
        $user = get_user_by('id', $agentId);

        $rejectInformation = sanitize_textarea_field($formData['reject_information']);

        if(! $rejectInformation ) {
            $error['reject_information'] = "Please type why the agent is rejected?";
        }

        if ( count( $error ) > 0 ) {
            sbnepal_ms_response( array(
                'errors' => $error,
                'status' => 'validation',
            ), false );

            return false;
        }

        update_user_meta(
            $user->ID,
            'is_approved_by_admin',
            'rejected'
        );

        update_user_meta(
            $user->ID,
            'reject_information',
            $rejectInformation
        );

        sbnepal_ms_response( array(
            'message' => 'You have successfully rejected the agent.',
            'status'  => 'success'
        ) );

    }

endif;

sbnepal_ms_resolve_agent_reject_data( $_POST );