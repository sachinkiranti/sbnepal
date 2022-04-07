<?php

$plugin_name = 'prasadi-result-sys';

include( preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__) . 'wp-load.php' );

// CSRF Validation
if( ! wp_verify_nonce($_POST['_wpnonce'], 'wps-frontend-prasadi-result-sys') ) {

    prasadi_result_sys_response( array(
        'message' => 'Invalid Request.',
        'status'  => 'invalid'
    ), false );

}

if ( ! function_exists( 'prasadi_result_sys_response' ) ) :

    /**
     * $response array
     * $status bool ie. 1 : success and 0 : failure
     */
    function prasadi_result_sys_response ($response, $status = true) {
        if ( $status ) {
            wp_send_json_success($response);
        }
        wp_send_json_error($response);
        die;
    }

endif;

if ( ! function_exists('prasadi_result_sys_resolve_data') ) :

    function prasadi_result_sys_resolve_data ( $formData ) {
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
            prasadi_result_sys_response( array(
                'errors' => $error,
                'status' => 'validation',
            ), false );
        }
        global $wpdb;

        $table_name = $wpdb->prefix . "prasadi_result_sys_results";
        $faculty_table_name = $wpdb->prefix . "prasadi_result_sys_faculties";
        $symbolNo = sanitize_text_field( $data['symbolNumber'] );
        $faculty = sanitize_text_field( $data['faculty'] );

        $facultyId = 0;

        $facultyRow = $wpdb->get_row($wpdb->prepare( "SELECT * FROM $faculty_table_name WHERE faculty_name = %s", $faculty));

        if(!is_null($facultyRow)) {
            $facultyId = $facultyRow->id;
        }

        $result = $wpdb->get_row($wpdb->prepare( "SELECT * FROM $table_name WHERE symbol_number = %s AND faculty_id = %d", $symbolNo, $facultyId));

        $file_path = dirname(__FILE__) . '/templates/prasadi-result-sys-response.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();

        prasadi_result_sys_response([
            'view' => $html,
            'status'  => 'success'
        ]);
    }

endif;

prasadi_result_sys_resolve_data( $_POST );