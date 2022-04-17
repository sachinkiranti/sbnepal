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
        'order'      => 'DESC',
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

function sbnepal_ms_agent_insert_agent( $args = array() ) {
    global $wpdb;

    $defaults = array();

    $args       = wp_parse_args( $args, $defaults );

    $table_name = $wpdb->prefix . 'users';
    $metatable_name = $wpdb->prefix . 'usermeta';


    if (empty($args['referral_id'])){
        unset( $args['referral_id'] );
    }

    foreach ($args as $key => $value) {
        if ( empty( $value ) ) {
            return new WP_Error( 'no-'.$key, __( 'No '.$key.' provided.', 'sbnepal-ms' ) );
        }
    }

    // remove row id to determine if new or update
    $row_id = (int) $args['id'];
    unset( $args['id'] );

    $passport_size_photo = sbnepal_ms_upload($args['passport_size_photo'], 'Passport Size Photo');
    $citizenship_photo = sbnepal_ms_upload($args['citizenship_photo'], 'Citizenship Photo');
    $signature_photo = sbnepal_ms_upload($args['signature_photo'], 'Signature Photo');

    if ( ! $row_id ) {

        $result = wp_create_user(
            str_replace(' ', '',  strtolower($args['name'])),
            $args['user_pass'],
            $args['user_email']
        );

        if(is_wp_error($result)) {
            $error = $result->get_error_message();
            custom_dump($error);
            die;
        } else{
            $user = get_user_by('id', $result);

            $user->set_role('agent');

            // adding user metas for images
            add_user_meta(
                $user->ID,
                'passport_size_photo',
                $passport_size_photo
            );

            add_user_meta(
                $user->ID,
                'citizenship_photo',
                $citizenship_photo
            );

            add_user_meta(
                $user->ID,
                'signature_photo',
                $signature_photo
            );

            add_user_meta(
                $user->ID,
                'refer_id',
                hexdec(uniqid() + mt_rand(1000, 9999))
            );

            foreach (
                array(
                    'referral_id',
                    'father_name',
                    'address',
                    'citizenship_no',
                    'phone_number',
                    'qualification',
                    'is_approved_by_admin',
                    'agent_added_by'
                ) as $metaData) {

                $metaValue = $args[$metaData];

                if ($metaData === 'is_approved_by_admin') {
                    $metaValue = 'no'; // ie. yes = approved else pending, pending cannot login
                }
                elseif ($metaData === 'agent_added_by') {
                    $metaValue = isset( $args['agent_added_by'] ) ? $args['agent_added_by'] : reset(get_users(array(
                        'meta_key' => 'refer_id',
                        'meta_value' => $args['referral_id'],
                        'fields' => 'ids',
                        'number' => 1
                    )));
                }

                if ($metaValue) {
                    add_user_meta(
                        $user->ID,
                        $metaData,
                        $metaValue
                    );
                }

            }

            // Add commission

            sbnepal_ms_insert_hierarchy_with_commission($user->ID);
            return $user;
        }

    } else {

        // do update method here
        if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
            return $row_id;
        }
    }

    return false;
}