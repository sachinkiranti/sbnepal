<?php

/**
 * WPRefers : Query Functions for WP Refers
 *
 * @link https://raisachin.com.np
 * @package wprefers-core
 */

if (! function_exists('wprefers_core_get_recent_blogs')) {

    function wprefers_core_get_recent_blogs($limit = 5) {
        return wp_get_recent_posts(array(
            'numberposts' => $limit
        ));
    }

}

if (! function_exists('wprefers_core_get_featured_blogs')) {

    function wprefers_core_get_featured_blogs($post_type, $key, $value, $limit, $catID = 1) {
        $args = array(
            'post_type'  => $post_type,
            'meta_key'   => $key,
            'meta_value' => $value,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category', //double check your taxonomy name in you dd
                    'field'    => 'id',
                    'terms'    => $catID,
                ),
            ),
            'post_per_page' => $limit, /* add a reasonable max # rows */
            'no_found_rows' => true, /* don't generate a count as part of query, unless you need it. */
        );
        return new WP_Query( $args );
    }

}

$fRequestURI = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
if( false === strpos( $fRequestURI, '/wp-admin/' ) ){
    add_filter( 'option_active_plugins', 'wprefers_activate_plugins' );
}

function wprefers_activate_plugins( $plugins ){

    global $fRequestURI;
    $is_contact_page = strpos( $fRequestURI, '/contact/' );

    $k = array_search( "contact-form-7/wp-contact-form-7.php", $plugins );

    if( false !== $k && false === $is_contact_page ){
        unset( $plugins[$k] );
    }

    return $plugins;
}