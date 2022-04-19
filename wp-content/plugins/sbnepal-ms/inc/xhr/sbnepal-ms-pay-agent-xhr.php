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
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-pay-agent') ) {
    sbnepal_ms_response( array(
        'message' => 'CSRF Token Mismatched.',
        'status'  => 'invalid'
    ), false );

}

if ( ! function_exists('sbnepal_ms_resolve_agent_paying_data') ) :

    function sbnepal_ms_resolve_agent_paying_data ( $formData ) {

        $userId = $formData['userId'];
        $user = get_user_by('id', $userId);

        $wallets = sbnepal_ms_wallet_get_all_wallet(array(), $user->ID);

        // Pay to user
        foreach ($wallets as $wallet) {
            sbnepal_ms_insert_wallet_log(array(
                'is_paid' => true,
                'added_by' => $wallet->added_by,
                'user_id' => $wallet->user_id,
                'commission' => $wallet->commission,
                'last_level_commission_level' => $wallet->last_level_commission_level,
                'last_level_commission' => $wallet->last_level_commission,
                'id'      => $wallet->id
            ));
        }

        if ($user->ID) {
            sbnepal_ms_response( array(
                'message' => 'You have successfully paid the commission to the agent.',
                'status'  => 'success'
            ) );
        }

        sbnepal_ms_response( array(
            'message' => 'Something went wrong while paying commission to agent.',
            'status'  => 'invalid'
        ), false );

    }

endif;

sbnepal_ms_resolve_agent_paying_data( $_POST );