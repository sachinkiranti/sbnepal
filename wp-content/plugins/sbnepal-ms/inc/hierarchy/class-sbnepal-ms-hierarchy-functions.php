<?php

if ( ! function_exists('sbnepal_ms_get_hierarchy_with_commission') ) :

    function sbnepal_ms_get_hierarchy_ids( $user_id ) {
        $agentId = get_the_author_meta( 'agent_added_by', $user_id );
        $secondAgentId = get_the_author_meta( 'agent_added_by', $agentId );
        $thirdAgentId = get_the_author_meta( 'agent_added_by', $secondAgentId );
        $fourthAgentId = get_the_author_meta( 'agent_added_by', $thirdAgentId );

        return array(
            array(
                'level' => 1,
                'commission' => get_option("sbnepal-ms_first_level_commission", 150),
                'agent_id' => $agentId
            ),

            array(
                'level' => 2,
                'commission' => get_option("sbnepal-ms_second_level_commission", 50),
                'agent_id' => $secondAgentId
            ),

            array(
                'level' => 3,
                'commission' => get_option("sbnepal-ms_third_level_commission", 50),
                'agent_id' => $thirdAgentId
            ),

            array(
                'level' => 4,
                'commission' => get_option("sbnepal-ms_fourth_level_commission", 50),
                'agent_id' => $fourthAgentId
            ),
        );
    }

endif;

if ( ! function_exists('sbnepal_ms_insert_hierarchy_with_commission') ) :

    function sbnepal_ms_insert_hierarchy_with_commission( $user_id )
    {
        $hierarchies = sbnepal_ms_get_hierarchy_ids($user_id);

        foreach ($hierarchies as $hierarchy) {
            if ($hierarchy['agent_id']) {
                sbnepal_ms_insert_wallet_log(array(
                    'added_by' => $hierarchy['agent_id'],// added by agent and got this commission
                    'user_id' => $user_id, // agent added this user
                    'commission' => $hierarchy['commission'],
                    'last_level_commission_level' => $hierarchy['level'],
                    'last_level_commission' => $hierarchy['commission'],
                    'is_paid' => false
                ));
            }
        }
    }

endif;

function sbnepal_ms_insert_wallet_log( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id'         => null,
        'added_by' => '',
        'user_id' => '',
        'commission' => '',
        'last_level_commission_level' => '',
        'last_level_commission' => '',
        'is_paid' => false
    );

    $args       = wp_parse_args( $args, $defaults );

    $table_name = $wpdb->prefix . 'sbnepal_ms_wallet';

    // remove row id to determine if new or update
    $row_id = (int) $args['id'];

    unset( $args['id'] );

    if ( ! $row_id ) {

        // insert a new
        if ( $wpdb->insert( $table_name, $args ) ) {
            return $wpdb->insert_id;
        }

    } else {

        // do update method here
        if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
            return $row_id;
        }
    }

    return false;
}


/**
 * Get all wallet
 *
 * @param $args array
 *
 * @return array
 */
function sbnepal_ms_wallet_get_all_wallet( $args = array(), $userWise = false ) {
    global $wpdb;

    $defaults = array(
        'number'     => 20,
        'offset'     => 0,
        'orderby'    => 'id',
        'order'      => 'DESC',
    );

    $args      = wp_parse_args( $args, $defaults );
    $cache_key = 'wallet-all';
    $items     = wp_cache_get( $cache_key, 'sbnepal-ms' );
    if ( false === $items ) {

        $items = $wpdb->get_results(
            'SELECT * FROM ' . $wpdb->prefix . 'sbnepal_ms_wallet ' . ($userWise ? ' WHERE added_by ='. $userWise : '').' ORDER BY ' .
            $args['orderby'] .' ' . $args['order'] .' LIMIT ' .
            $args['offset'] . ', ' . $args['number'] );

        wp_cache_set( $cache_key, $items, 'sbnepal-ms' );
    }

    return $items;
}

/**
 * Fetch all wallet from database
 *
 * @return array
 */
function sbnepal_ms_wallet_get_wallet_count() {
    global $wpdb;

    return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'sbnepal_ms_wallet' );
}

function sbnepal_ms_wallet_get_commission_sum($user_id) {
    global $wpdb;

    return $wpdb->get_results( 'SELECT 
        SUM(CASE WHEN is_paid = 1 THEN commission ELSE 0 END) AS total_paid_commission,
        SUM(CASE WHEN is_paid = 0 THEN commission ELSE 0 END) AS total_unpaid_commission,
        SUM(commission) AS total_commission
        FROM ' . $wpdb->prefix . 'sbnepal_ms_wallet WHERE added_by = '. $user_id
    );
}