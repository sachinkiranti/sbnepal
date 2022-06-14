<?php

/**
 * Handle the form submissions
 *
 * @package Package
 * @subpackage Sub Package
 */
class SBNEPAL_MS_Agent_Form_Handler {

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

        // Adding the agent
        if ($_POST['FORM_HANDLER'] === 'sbnepal-ms-add-agent') {
            if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-add-agent' ) ) {
                die( __( 'Are you cheating?', 'sbnepal-ms' ) );
            }

            if ( ! current_user_can( 'read' ) ) {
                wp_die( __( 'Permission Denied!', 'sbnepal-ms' ) );
            }

            $errors   = array();
            $page_url = admin_url( 'admin.php?page=sbnepal-ms-agent&action=new' );
            $field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;

            if (isset($_POST['referral_id'])) {
                $data['referral_id'] = !empty($_POST['referral_id']) ? $_POST['referral_id'] : null;

                if (!empty($_POST['referral_id'])) {
                    $getReferID = reset(get_users(array(
                        'meta_key' => 'refer_id',
                        'meta_value' => $data['referral_id'],
                        'fields' => 'ids',
                        'number' => 1
                    )));
                } else {
                    $getReferID = get_current_user_id();
                }

            } else {
                $getReferID = get_current_user_id();
            }

            $data['agent_added_by'] = isset( $_POST['filter'] ) ? $_POST['filter'] : $getReferID;
            $data['name'] = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
            $data['user_email'] = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
            $data['phone_number'] = isset( $_POST['phone_number'] ) ? sanitize_text_field( $_POST['phone_number'] ) : '';
            $data['user_pass'] = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';
            $data['password_confirmation'] = isset( $_POST['password_confirmation'] ) ? sanitize_text_field( $_POST['password_confirmation'] ) : '';
            $data['father_name'] = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
            $data['address'] = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
            $data['qualification'] = isset( $_POST['qualification'] ) ? sanitize_text_field( $_POST['qualification'] ) : '';
            $data['citizenship_no'] = isset( $_POST['citizenship_no'] ) ? sanitize_text_field( $_POST['citizenship_no'] ) : '';
            $data['passport_size_photo'] = !empty( $_FILES['passport_size_photo'] ) ? $_FILES['passport_size_photo'] : '';
            $data['citizenship_photo'] = !empty( $_FILES['citizenship_photo'] ) ? $_FILES['citizenship_photo'] : '';
            $data['signature_photo'] = !empty( $_FILES['signature_photo'] ) ? $_FILES['signature_photo'] : '';

            // some basic validation
            foreach (array_filter($data) as $key => $value) {
                if ( ! $value ) {
                    $errors[] = __( 'Error: '.ucwords(str_replace(['_'], ' ', $key)).' is required', 'sbnepal-ms' );
                }
            }

            // bail out if error found
            if ( $errors ) {
                foreach ($errors as $error) {
                    queue_flash_message($error, 'error');
                }
                // $first_error = reset( $errors );
                $redirect_to = add_query_arg( $data, $page_url );
                wp_safe_redirect( $redirect_to );
                exit;
            }

            // New or edit?
            if ( ! $field_id ) {

                $insert_id = sbnepal_ms_agent_insert_agent( $data );

            } else {

                $fields['id'] = $field_id;

                $insert_id = sbnepal_ms_agent_insert_agent( $fields );
            }

            if ( is_wp_error( $insert_id ) ) {
                $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
            } else {
                $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
            }

            wp_safe_redirect( $redirect_to );
            exit;
        }

        // Updating the agent
        if ($_POST['FORM_HANDLER'] === 'sbnepal-ms-update-agent') {
            if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'wps-frontend-sbnepal-ms-update-agent' ) ) {
                die( __( 'Are you cheating?', 'sbnepal-ms' ) );
            }

            if ( ! current_user_can( 'read' ) ) {
                wp_die( __( 'Permission Denied!', 'sbnepal-ms' ) );
            }

            $errors   = array();
            $field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;
            $page_url = admin_url( 'admin.php?page=sbnepal-ms-agent&action=edit&id='.$field_id );

            if (isset($_POST['referral_id'])) {
                $data['referral_id'] = !empty($_POST['referral_id']) ? $_POST['referral_id'] : null;

                if (!empty($_POST['referral_id'])) {
                    $getReferID = reset(get_users(array(
                        'meta_key' => 'refer_id',
                        'meta_value' => $data['referral_id'],
                        'fields' => 'ids',
                        'number' => 1
                    )));
                } else {
                    $getReferID = get_current_user_id();
                }

            } else {
                $getReferID = get_current_user_id();
            }


            $data['agent_added_by'] = isset( $_POST['filter'] ) ? $_POST['filter'] : $getReferID;
            $data['name'] = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
            $data['user_email'] = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
            $data['phone_number'] = isset( $_POST['phone_number'] ) ? sanitize_text_field( $_POST['phone_number'] ) : '';
            $data['user_pass'] = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';
            $data['password_confirmation'] = isset( $_POST['password_confirmation'] ) ? sanitize_text_field( $_POST['password_confirmation'] ) : '';
            $data['father_name'] = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
            $data['address'] = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
            $data['qualification'] = isset( $_POST['qualification'] ) ? sanitize_text_field( $_POST['qualification'] ) : '';
            $data['citizenship_no'] = isset( $_POST['citizenship_no'] ) ? sanitize_text_field( $_POST['citizenship_no'] ) : '';

            $data['passport_size_photo'] = !empty( $_FILES['passport_size_photo']['tmp_name'] ) ? $_FILES['passport_size_photo'] : null;
            $data['citizenship_photo'] = !empty( $_FILES['citizenship_photo']['tmp_name'] ) ? $_FILES['citizenship_photo'] : null;
            $data['signature_photo'] = !empty( $_FILES['signature_photo']['tmp_name'] ) ? $_FILES['signature_photo'] : null;

            // some basic validation
            foreach (array_filter($data) as $key => $value) {
                if ( ! $value ) {
                    $errors[] = __( 'Error: '.ucwords(str_replace(['_'], ' ', $key)).' is required', 'sbnepal-ms' );
                }
            }

            // bail out if error found
            if ( $errors ) {
                foreach ($errors as $error) {
                    queue_flash_message($error, 'error');
                }
                // $first_error = reset( $errors );
                $redirect_to = add_query_arg( $data, $page_url );
                wp_safe_redirect( $redirect_to );
                exit;
            }

            // New or edit?
            if ( ! $field_id ) {

                $insert_id = sbnepal_ms_agent_insert_agent( $data );

            } else {

                $fields['id'] = $field_id;

                $insert_id = sbnepal_ms_agent_insert_agent( array_merge($fields, $data) );
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

new SBNEPAL_MS_Agent_Form_Handler();