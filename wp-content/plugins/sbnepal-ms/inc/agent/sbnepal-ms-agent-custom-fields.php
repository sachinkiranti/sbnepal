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
        $fatherName = ! empty( $_POST['father_name'] ) ? sanitize_text_field($_POST['father_name']) : '';
        $address = ! empty( $_POST['address'] ) ? sanitize_text_field($_POST['address']) : '';

        ?>
        <div class="sbnepal-ms_agent_information" style="display: none">
            <h3><?php esc_html_e( 'Agent Information', 'sbnepal-ms' ); ?></h3>
            <p><?php esc_html_e( 'Please enter the below mandatory fields for the agent.', 'sbnepal-ms' ); ?></p>
            <table class="table-sbnepal-ms-agent">  <!-- form-table-->

                <tr>
                    <th><label for="passport_size_image">
                            <?php esc_html_e( 'Passport Size Image', 'sbnepal-ms' ); ?></label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?></span>
                        <br>
                        <input type="file"
                               step="1"
                               id="passport_size_image"
                               name="passport_size_image"
                               class="regular-text"
                        />
                    </th>
                </tr>
                <tr>
                    <th><label for="referral_id">
                            <?php esc_html_e( 'Referral ID', 'sbnepal-ms' ); ?>
                        </label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?>
                    </span> <br>
                        <input type="number"
                               step="1"
                               id="referral_id"
                               name="referral_id"
                               value="<?php echo esc_attr( $referralId ); ?>"
                               class="regular-text"
                        />
                    </th>

                    <th>
                        <label for="father_name">
                            <?php esc_html_e( 'Father Name', 'sbnepal-ms' ); ?>
                        </label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?>
                    </span> <br>

                        <input type="text"
                               step="1"
                               id="father_name"
                               name="father_name"
                               value="<?php echo esc_attr( $fatherName ); ?>"
                               class="regular-text"
                        />
                    </th>
                </tr>

                <tr>
                    <th><label for="citizenship_no">
                            <?php esc_html_e( 'Citizenship No', 'sbnepal-ms' ); ?>
                        </label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?>
                    </span> <br>
                        <input type="number"
                               step="1"
                               id="citizenship_no"
                               name="citizenship_no"
                               value="<?php echo esc_attr( $referralId ); ?>"
                               class="regular-text"
                        />
                    </th>

                    <th>
                        <label for="qualification">
                            <?php esc_html_e( 'Qualification', 'sbnepal-ms' ); ?>
                        </label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?>
                    </span> <br>

                        <input type="text"
                               step="1"
                               id="qualification"
                               name="qualification"
                               value="<?php echo esc_attr( $fatherName ); ?>"
                               class="regular-text"
                        />
                    </th>
                </tr>

                <tr>
                    <th>
                        <label for="phone_number">
                            <?php esc_html_e( 'Phone Number', 'sbnepal-ms' ); ?>
                        </label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?>
                    </span> <br>

                        <input type="number"
                               step="1"
                               id="phone_number"
                               name="phone_number"
                               value="<?php echo esc_attr( $phoneNumber ); ?>"
                               class="regular-text"
                        />
                    </th>

                    <th>
                        <label for="address">
                            <?php esc_html_e( 'Address', 'sbnepal-ms' ); ?>
                        </label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?>
                    </span> <br>

                        <input type="text"
                               step="1"
                               id="address"
                               name="address"
                               value="<?php echo esc_attr( $address ); ?>"
                               class="regular-text"
                        />
                    </th>
                </tr>

                <tr>

                    <th><label for="citizenship_image">
                            <?php esc_html_e( 'Citizenship Image', 'sbnepal-ms' ); ?></label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?></span>
                        <br>
                        <input type="file"
                               step="1"
                               id="citizenship_image"
                               name="citizenship_image"
                               class="regular-text"
                        />
                    </th>

                    <th><label for="signature_image">
                            <?php esc_html_e( 'Signature Image', 'sbnepal-ms' ); ?></label>
                        <span class="description">
                        <?php esc_html_e( '(required)', 'sbnepal-ms' ); ?></span>
                        <br>
                        <input type="file"
                               step="1"
                               id="signature_image"
                               name="signature_image"
                               class="regular-text"
                        />
                    </th>

                </tr>
            </table>
        </div>
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

        // Validate the agent fields if only the role is agent
        if ( $_POST['role'] === 'agent' ) {
            if ( empty( $_POST['referral_id'] ) ) {
                $errors->add(
                    'referral_id',
                    __( '<strong class="sbnepal-ms-errors sbnepal-ms_referral_id">Error</strong>: The referral id is required.', 'sbnepal-ms' )
                );
            }

            if ( empty( $_POST['phone_number'] ) ) {
                $errors->add(
                    'phone_number',
                    __( '<strong class="sbnepal-ms-errors sbnepal-ms_phone_number">Error</strong>: The phone number is required.', 'sbnepal-ms' )
                );
            }
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
        <h3><?php esc_html_e( 'Personal Information', 'sbnepal-ms' ); ?></h3>

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

# Adding a custom field column at USER table

if (! function_exists('sbnepal_ms_modify_user_columns')) :

    function sbnepal_ms_modify_user_columns($column_headers) {
        $column_headers['refer_id'] = 'Refer ID';
        $column_headers['referral_id'] = 'Referral ID';
        return $column_headers;
    }

endif;

add_filter('manage_users_columns', 'sbnepal_ms_modify_user_columns');

if (! function_exists('sbnepal_ms_modified_columns')) :

    function sbnepal_ms_modified_columns( $value, $column_name, $user_id ) {
        if ( 'refer_id' === $column_name ) {
            return hexdec(uniqid() + mt_rand(1000, 9999));
        } elseif ('referral_id' === $column_name) {
            return hexdec(uniqid() + mt_rand(1000, 9999));
        } else {
            return $value;
        }
    }

endif;

add_action( 'manage_users_custom_column', 'sbnepal_ms_modified_columns', 10, 3 );

// Adding custom css to user-new hook
//add_action('admin_enqueue_scripts', function ($hook) {
//    custom_dump($hook);
//});

add_action("admin_print_styles-user-new.php", function () {
    wp_enqueue_style(
        'sbnepal_ms-toastr-css',
        plugins_url('sbnepal-ms/assets/css/user-new.css')
    );
});

add_action("admin_print_scripts-user-new.php", function () {
    wp_enqueue_script(
        'sbnepal_ms-toastr-js',
        plugins_url('sbnepal-ms/assets/js/user-new.js'),
        array( 'jquery' )
    );
});