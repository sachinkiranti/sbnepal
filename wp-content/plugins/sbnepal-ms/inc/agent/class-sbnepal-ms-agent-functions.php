<?php

/**
 * Get all Agents
 *
 * @param $args array
 *
 * @return array
 */
function sbnepal_ms_get_all_agent( $args = array() ) {

    $defaults = array(
        'role'    => 'agent',
        'number'     => 20,
        'offset'     => 0,
        'orderby'    => 'id',
        'order'      => 'ASC',
    );

    return get_users( wp_parse_args( $args, $defaults ));
}

/**
 * Fetch all agents from database
 *
 * @return int
 */
function sbnepal_ms_get_agent_count() {
    return (int) count( get_users( array( 'role' => 'agent' ) ) );
}
