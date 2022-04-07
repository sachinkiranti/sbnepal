<?php

/**
 * Handle the form submissions
 *
 * @package prasadu-result-sys
 * @subpackage prasadu-result-sys-faculty
 */
class Prasadi_Result_sys_Faculty_Form_Handler {

    /**
     * Hook 'em all
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'handle_form' ) );
    }

    /**
     * Handle the faculty new and edit form
     *
     * @return void
     */
    public function handle_form() {
        if ( ! isset( $_POST['Submit'] ) ) {
            return;
        }

        if ( $_POST['FORM_HANDLER'] === 'prasadi_result_sys_faculty') {
            if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'prasadi_result_sys_faculty' ) ) {
                die( __( 'Are you cheatingk?', 'prasadi-result-sys' ) );
            }

            if ( ! current_user_can( 'read' ) ) {
                wp_die( __( 'Permission Denied!', 'prasadi-result-sys' ) );
            }

            $errors   = array();
            $page_url = admin_url( 'admin.php?page=prasadi-result-sys-faculty' );
            $field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;

            $faculty_name = isset( $_POST['faculty_name'] ) ? sanitize_text_field( $_POST['faculty_name'] ) : '';
            $response_message_passed = isset( $_POST['response_message_passed'] ) ? $_POST['response_message_passed'] : '';
            $response_message_scholarship = isset( $_POST['response_message_scholarship'] ) ? $_POST['response_message_scholarship'] : '';
            $response_message_failed = isset( $_POST['response_message_failed'] ) ? $_POST['response_message_failed'] : '';
            $response_message_unidentified = isset( $_POST['response_message_unidentified'] ) ? $_POST['response_message_unidentified'] : '';

            // some basic validation
            if ( ! $faculty_name ) {
                $errors[] = __( 'Error: Faculty Name is required', 'prasadi-result-sys' );
            }

            // bail out if error found
            if ( $errors ) {
                $first_error = reset( $errors );
                $redirect_to = add_query_arg( array( 'error' => $first_error ), $page_url );
                wp_safe_redirect( $redirect_to );
                exit;
            }

            $fields = array(
                'faculty_name' => $faculty_name,
                'response_message_passed' => $response_message_passed,
                'response_message_scholarship' => $response_message_scholarship,
                'response_message_failed' => $response_message_failed,
                'response_message_unidentified' => $response_message_unidentified
            );

            // New or edit?
            if ( ! $field_id ) {

                $insert_id = prasadi_result_sys_faculty_insert_faculty( $fields );

            } else {

                $fields['id'] = $field_id;

                $insert_id = prasadi_result_sys_faculty_insert_faculty( $fields );
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

new Prasadi_Result_sys_Faculty_Form_Handler();