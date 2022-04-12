<?php

add_action( 'register_form', 'sbnepal_ms_registration_form' );

if (! function_exists('sbnepal_ms_registration_form')) :
    function sbnepal_ms_registration_form() {

        $referralId = ! empty( $_POST['referral_id'] ) ? intval( $_POST['referral_id'] ) : '';
        $phoneNumber = ! empty( $_POST['phone_number'] ) ? intval( $_POST['phone_number'] ) : '';

        ?>
        <p>
            <label for="referral_id"><?php esc_html_e( 'Referral ID', 'sb-nepal' ) ?><br/>
                <input type="number"
                       step="1"
                       id="referral_id"
                       name="referral_id"
                       value="<?php echo esc_attr( $referralId ); ?>"
                       class="input"
                />
            </label>
        </p>

        <p>
            <label for="phone_number"><?php esc_html_e( 'Phone Number', 'sb-nepal' ) ?><br/>
                <input type="number"
                       step="1"
                       id="phone_number"
                       name="phone_number"
                       value="<?php echo esc_attr( $phoneNumber ); ?>"
                       class="input"
                />
            </label>
        </p>
        <?php
    }
endif;

add_action( 'user_register', 'sbnepal_ms_user_register' );

if (! function_exists('sbnepal_ms_user_register')) :

    function sbnepal_ms_user_register( $user_id ) {
        if ( ! empty( $_POST['referral_id'] ) ) {
            update_user_meta( $user_id, 'referral_id', intval( $_POST['referral_id'] ) );
        }

        if ( ! empty( $_POST['phone_number'] ) ) {
            update_user_meta( $user_id, 'phone_number', intval( $_POST['phone_number'] ) );
        }
    }

endif;

/**
 * Admin
 */
add_action( 'user_new_form', 'sbnepal_ms_admin_registration_form' );

if (! function_exists('sbnepal_ms_admin_registration_form')) :
    function sbnepal_ms_admin_registration_form( $operation ) {
        if ( 'add-new-user' !== $operation ) {
            // $operation may also be 'add-existing-user'
            return;
        }

        $referralId = ! empty( $_POST['referral_id'] ) ? intval( $_POST['referral_id'] ) : '';
        $phoneNumber = ! empty( $_POST['phone_number'] ) ? intval( $_POST['phone_number'] ) : '';

        ?>
        <h3><?php esc_html_e( 'Personal Information', 'sbnepal-ms' ); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="referral_id">
                        <?php esc_html_e( 'Referral ID', 'sbnepal-ms' ); ?></label>
                    <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?></span></th>
                <td>
                    <input type="number"
                           step="1"
                           id="referral_id"
                           name="referral_id"
                           value="<?php echo esc_attr( $referralId ); ?>"
                           class="regular-text"
                    />
                </td>
            </tr>

            <tr>
                <th><label for="phone_number">
                        <?php esc_html_e( 'Phone Number', 'sbnepal-ms' ); ?></label>
                    <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?></span></th>
                <td>
                    <input type="number"
                           step="1"
                           id="phone_number"
                           name="phone_number"
                           value="<?php echo esc_attr( $phoneNumber ); ?>"
                           class="regular-text"
                    />
                </td>
            </tr>
        </table>
        <?php
    }
endif;

// Validating fields
add_action( 'user_profile_update_errors', 'sbnepal_ms_user_profile_update_errors', 10, 3 );

if ( ! function_exists('sbnepal_ms_user_profile_update_errors') ) :

    function sbnepal_ms_user_profile_update_errors( $errors, $update, $user ) {
        if ( $update ) {
            return;
        }

        if ( empty( $_POST['referral_id'] ) ) {
            $errors->add(
                    'referral_id',
                    __( '<strong>Error</strong>: The referral id is required.', 'sbnepal-ms' )
            );
        }

        if ( empty( $_POST['phone_number'] ) ) {
            $errors->add(
                'phone_number',
                __( '<strong>Error</strong>: The phone number is required.', 'sbnepal-ms' )
            );
        }
    }
endif;

add_action( 'edit_user_created_user', 'sbnepal_ms_user_register' );

// Displaying
add_action( 'show_user_profile', 'sbnepal_ms_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'sbnepal_ms_show_extra_profile_fields' );

if (! function_exists('sbnepal_ms_show_extra_profile_fields') ) :
    function sbnepal_ms_show_extra_profile_fields( $user ) {
        ?>
        <h3><?php esc_html_e( 'Personal Information', 'crf' ); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="referral_id"><?php esc_html_e( 'Referral ID', 'sbnepal-ms' ); ?></label></th>
                <td><?php echo esc_html( get_the_author_meta( 'referral_id', $user->ID ) ); ?></td>
            </tr>

            <tr>
                <th><label for="phone_number"><?php esc_html_e( 'Phone Number', 'sbnepal-ms' ); ?></label></th>
                <td><?php echo esc_html( get_the_author_meta( 'phone_number', $user->ID ) ); ?></td>
            </tr>
        </table>
        <?php
    }
endif;