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
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-agent-activation') ) {
    sbnepal_ms_response( array(
        'message' => 'Invalid Request.',
        'status'  => 'invalid'
    ), false );

}

if ( ! function_exists('sbnepal_ms_resolve_agent_activation_data') ) :

    function sbnepal_ms_resolve_agent_activation_data ( $formData ) {
        $agentId = $formData['agentId'];

        $user = get_user_by('id', $agentId);
        $recipient = $user->user_email;
        $referId = get_the_author_meta('refer_id', $agentId);
        $message = str_replace(
            array('{%AGENT_NAME%}', '{%AGENT_REFER_ID%}', '{%agent_name%}', '{%agent_refer_id%}'),
            array(
                '{%AGENT_NAME%}'        => $recipient,
                '{%AGENT_REFER_ID%}'    => $referId,
                '{%agent_name%}'        => $recipient,
                '{%agent_refer_id%}'    => $referId,
            ), get_option('sbnepal-ms_agent_activation_email_template'));

        wp_mail($recipient, "Welcome to Smart Business in Nepal", $message);

        sbnepal_ms_response( array(
            'message' => 'You have successfully sent the welcome email to the agent.',
            'status'  => 'success',
        ) );
    }

endif;

sbnepal_ms_resolve_agent_activation_data( $_POST );