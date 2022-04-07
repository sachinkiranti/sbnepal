<?php

/**
 * Insert a new faculty
 *
 * @param array $args
 */
function prasadi_result_sys_faculty_insert_faculty( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id'         => null,
        'faculty_name' => '',
        'response_message_passed' => '',
        'response_message_scholarship' => '',
        'response_message_failed' => '',
        'response_message_unidentified' => ''
    );

    $args       = wp_parse_args( $args, $defaults );

    $table_name = $wpdb->prefix . 'prasadi_result_sys_faculties';

    // some basic validation
    if ( empty( $args['faculty_name'] ) ) {
        return new WP_Error( 'no-faculty_name', __( 'No Faculty Name provided.', 'prasadi-result-sys' ) );
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

/**
 * Get all faculty
 *
 * @param $args array
 *
 * @return array
 */
function prasadi_result_sys_faculty_get_all_faculty( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'number'     => 20,
        'offset'     => 0,
        'orderby'    => 'id',
        'order'      => 'ASC',
    );

    $args      = wp_parse_args( $args, $defaults );
    $cache_key = 'faculty-all';
    $items     = wp_cache_get( $cache_key, 'prasadi-result-sys' );

    if ( false === $items ) {
        $items = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'prasadi_result_sys_faculties ORDER BY ' . $args['orderby'] .' ' . $args['order'] .' LIMIT ' . $args['offset'] . ', ' . $args['number'] );

        wp_cache_set( $cache_key, $items, 'prasadi-result-sys' );
    }

    return $items;
}

/**
 * Fetch all faculty from database
 *
 * @return array
 */
function prasadi_result_sys_faculty_get_faculty_count() {
    global $wpdb;

    return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'prasadi_result_sys_faculties' );
}

/**
 * Fetch a single faculty from database
 *
 * @param int   $id
 *
 * @return array
 */
function prasadi_result_sys_faculty_get_faculty( $id = 0 ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'prasadi_result_sys_faculties WHERE id = %d', $id ) );
}

function prasadi_resolve_pattern( $str, $start, $end ) {
    $str = ' ' . $str;
    $ini = strpos($str, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($str, $end, $ini) - $ini;
    return substr($str, $ini, $len);
}

function prasadi_custom_editor($value, $textareaName) {
    $settings = array(
        'wpautop' => true, // use wpautop?
        'media_buttons' => true, // show insert/upload button(s)
        'textarea_name' => $textareaName, // set the textarea name to something different, square brackets [] can be used here
        'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
        'tabindex' => '',
        'editor_css' => '', //  extra styles for both visual and HTML editors buttons,
        'editor_class' => '', // add extra class(es) to the editor textarea
        'teeny' => false, // output the minimal editor config used in Press This
        'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
        'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
        'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
    );
    wp_editor(  $value, $textareaName, $settings );
}

function prasadi_resolve_appointment_data ($result) {
    ob_start();?>
    <?php if  (isset($result->appointment_date) && !empty($result->appointment_date)) {
            ?> <b>Interview Date & Time :  <?php echo $result->appointment_date;
        } ?> <?php if  (isset($result->appointment_time) && !empty($result->appointment_time)) {
            $date = str_replace([ ' AM', ' PM' ], '', $result->appointment_time);
            $appointment_time = date("g:i a", strtotime($date));
            echo ', '. strtoupper($appointment_time);
        } ?></b> <br>
    <?php if  (isset($result->meeting_link) && !empty($result->meeting_link)) {  ?>
        <b>Zoom Link for Interview :</b> <br>
        <a href="<?php echo $result->meeting_link; ?>" target="_blank"><?php echo $result->meeting_link; ?></a> <br>
    <?php } ?>
    <?php if  (isset($result->meeting_id) && !empty($result->meeting_id)) { ?>
        <b>Meeting ID : <?php echo $result->meeting_id; ?></b> <br>
    <?php } ?>
    <?php if  (isset($result->password) && !empty($result->password)) { ?>
        <b>Password : <?php echo $result->password; ?></b> <br>
    <?php }
    return ob_get_clean();
}