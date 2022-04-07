<?php

/**
 * Get all result
 *
 * @param $args array
 *
 * @return array
 */
function prasadi_result_sys_results_get_all_result( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'number'     => 20,
        'offset'     => 0,
        'orderby'    => 'id',
        'order'      => 'ASC',
    );

    $args      = wp_parse_args( $args, $defaults );

    $cache_key = 'result-all';
    $items     = wp_cache_get( $cache_key, 'prasadi-result-sys' );
    $facultyId = isset($args['faculty_id']) ? $args['faculty_id'] : 1;
    if ( false === $items ) {
        $items = $wpdb->get_results(
            'SELECT * FROM ' . $wpdb->prefix . 'prasadi_result_sys_results WHERE faculty_id = '.$facultyId.' ORDER BY ' . $args['orderby'] .' ' . $args['order'] .' LIMIT ' . $args['offset'] . ', ' . $args['number'] );

        wp_cache_set( $cache_key, $items, 'prasadi-result-sys' );
    }

    return $items;
}

/**
 * Fetch all result from database
 *
 * @return array
 */
function prasadi_result_sys_results_get_result_count() {
    global $wpdb;

    return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'prasadi_result_sys_results' );
}

/**
 * Fetch a single result from database
 *
 * @param int   $id
 *
 * @return array
 */
function prasadi_result_sys_results_get_result( $id = 0 ) {
    global $wpdb;
    return $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'prasadi_result_sys_results WHERE id = %d', $id ) );
}

/**
 * Insert a new result
 *
 * @param array $args
 */
function prasadi_result_sys_result_insert_result( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id'         => null,
        'symbol_number' => '',
        'result' => '',
        'appointment_date' => '',
        'appointment_time' => '',
        'meeting_link' => '',
        'meeting_id' => '',
        'password' => '',
    );

    $args       = wp_parse_args( $args, $defaults );

    $table_name = $wpdb->prefix . 'prasadi_result_sys_results';

    // some basic validation
    if ( empty( $args['symbol_number'] ) ) {
        return new WP_Error( 'no-symbol_number', __( 'No Symbol Number provided.', 'prasadi-result-sys' ) );
    }
    if ( empty( $args['result'] ) ) {
        return new WP_Error( 'no-result', __( 'No Result provided.', 'prasadi-result-sys' ) );
    }


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