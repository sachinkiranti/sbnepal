<?php

/**
 * Handle the form submissions
 *
 * @package Package
 * @subpackage Sub Package
 */
class Prasadi_Result_sys_Result_Form_Handler {

    /**
     * Hook 'em all
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'handle_form' ) );
    }

    /**
     * Handle the result new and edit form
     *
     * @return void
     */
    public function handle_form() {
        if ( ! isset( $_POST['Submit'] ) ) {
            return;
        }

        if ($_POST['FORM_HANDLER'] === 'prasadi_result_sys_result') {
            if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'prasadi_result_sys_result' ) ) {
                die( __( 'Are you cheatingdasda?', 'prasadi-result-sys' ) );
            }

            if ( ! current_user_can( 'read' ) ) {
                wp_die( __( 'Permission Denied!', 'prasadi-result-sys' ) );
            }

            $errors   = array();
            $page_url = admin_url( 'admin.php?page=prasadi-result-sys' );
            $field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;

            $symbol_number = isset( $_POST['symbol_number'] ) ? sanitize_text_field( $_POST['symbol_number'] ) : '';
            $result = isset( $_POST['result'] ) ? sanitize_text_field( $_POST['result'] ) : '';
            $appointment_date = isset( $_POST['appointment_date'] ) ? sanitize_text_field( $_POST['appointment_date'] ) : '';
            $appointment_time = isset( $_POST['appointment_time'] ) ? sanitize_text_field( $_POST['appointment_time'] ) : '';
            $facultyId = isset( $_POST['faculty_id'] ) ? absint( $_POST['faculty_id'] ) : '';
            $meeting_link = isset( $_POST['meeting_link'] ) ? wp_kses_post( $_POST['meeting_link'] ) : '';
            $meeting_id = isset( $_POST['meeting_id'] ) ? sanitize_text_field( $_POST['meeting_id'] ) : '';
            $password = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';

            // some basic validation
            if ( ! $symbol_number ) {
                $errors[] = __( 'Error: Symbol Number is required', 'prasadi-result-sys' );
            }

            if ( ! $result ) {
                $errors[] = __( 'Error: Result is required', 'prasadi-result-sys' );
            }

            // bail out if error found
            if ( $errors ) {
                $first_error = reset( $errors );
                $redirect_to = add_query_arg( array( 'error' => $first_error ), $page_url );
                wp_safe_redirect( $redirect_to );
                exit;
            }

            $fields = array(
                'symbol_number' => $symbol_number,
                'result' => $result,
                'appointment_date' => $appointment_date,
                'appointment_time' => $appointment_time,
                'meeting_link' => $meeting_link,
                'meeting_id' => $meeting_id,
                'password' => $password,
                'faculty_id' => $facultyId,
            );

            // New or edit?
            if ( ! $field_id ) {

                $insert_id = prasadi_result_sys_result_insert_result( $fields );

            } else {

                $fields['id'] = $field_id;

                $insert_id = prasadi_result_sys_result_insert_result( $fields );
            }

            if ( is_wp_error( $insert_id ) ) {
                $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
            } else {
                $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
            }

            wp_safe_redirect( $redirect_to );
            exit;
        }
    }
}

new Prasadi_Result_sys_Result_Form_Handler();