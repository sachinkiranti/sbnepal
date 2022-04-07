<?php

if ( ! class_exists ( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List table class
 */
class Prasadi_Result_Sys_Result_Table extends \WP_List_Table {

    function __construct() {
        parent::__construct( array(
            'singular' => 'result',
            'plural'   => 'results',
            'ajax'     => false
        ) );
    }

    function get_table_classes() {
        return array( 'widefat', 'fixed', 'striped', $this->_args['plural'] );
    }

    /**
     * Message to show if no designation found
     *
     * @return void
     */
    function no_items() {
        _e( 'No Results Added', 'prasadi-result-sys' );
    }

    /**
     * Default column values if no callback found
     *
     * @param  object  $item
     * @param  string  $column_name
     *
     * @return string
     */
    function column_default( $item, $column_name ) {

        switch ( $column_name ) {
            case 'faculty_id':
                return $item->faculty_id;

            case 'symbol_number':
                return $item->symbol_number;

            case 'result':
                return $item->result;

            case 'appointment_date':
                return $item->appointment_date;

            case 'appointment_time':
                if ($item->appointment_time) {
                    $date = str_replace([' AM', ' PM'], '', $item->appointment_time);
                    return date("g:i a", strtotime($date));
                }
                return null;
            case 'meeting_link':
                return $item->meeting_link;

            case 'meeting_id':
                return $item->meeting_id;

            case 'password':
                return $item->password;

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }
    }

    /**
     * Get the column names
     *
     * @return array
     */
    function get_columns() {
        $columns = array(
            'cb'           => '<input type="checkbox" />',
            'symbol_number'      => __( 'Symbol Number', 'prasadi-result-sys' ),
            'result'      => __( 'Result', 'prasadi-result-sys' ),
            'appointment_date'      => __( 'Appointment Date', 'prasadi-result-sys' ),
            'appointment_time'      => __( 'Appointment Time', 'prasadi-result-sys' ),
            'meeting_link'      => __( 'Meeting Link', 'prasadi-result-sys' ),
            'meeting_id'      => __( 'Meeting ID', 'prasadi-result-sys' ),
            'password'      => __( 'Password', 'prasadi-result-sys' ),
            'faculty_id'      => __( 'Faculty', 'prasadi-result-sys' ),
        );

        return $columns;
    }

    function column_faculty_id( $item )
    {
        $item = prasadi_result_sys_faculty_get_faculty( $item->faculty_id );
        if (!is_null($item)) {
            return '<b>'.ucfirst($item->faculty_name).'</b>';
        } else {
            return '<b>UNIDENTIFIED</b>';
        }
    }

    /**
     * Render the designation name column
     *
     * @param  object  $item
     *
     * @return string
     */
    function column_symbol_number( $item ) {

        $actions           = array();

        $actions['edit']   = sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=prasadi-result-sys&action=edit&id=' . $item->id ), $item->id, __( 'Edit this item', 'prasadi-result-sys' ), __( 'Edit', 'prasadi-result-sys' ) );

        return sprintf( '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=prasadi-result-sys&action=view&id=' . $item->id ), $item->symbol_number, $this->row_actions( $actions ) );
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = array(
            'name' => array( 'name', true ),
        );

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'trash'  => __( 'Move to Trash', 'prasadi-result-sys' )
        );

        if ($_GET['faculty-filter'] > 0) {
            $actions = array_merge($actions, array(
                'empty'  => __( 'Empty', 'prasadi-result-sys' )
            ));
        }

        return $actions;
    }

    public function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix.'prasadi_result_sys_results';

        if ('trash' === $this->current_action()) {
            $ids = isset($_REQUEST['result_id']) ? $_REQUEST['result_id'] : array();
            if (is_array($ids)) {
                $ids = implode(',', $ids);
            }

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }

        if ('empty' === $this->current_action() && $_GET['faculty-filter'] > 0) {
//            $wpdb->query("TRUNCATE TABLE $table_name");
            $wpdb->query("DELETE FROM $table_name WHERE faculty_id = ".$_GET['faculty-filter']);
        }
    }

    /**
     * Render the checkbox column
     *
     * @param  object  $item
     *
     * @return string
     */
    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="result_id[]" value="%d" />', $item->id
        );
    }

    /**
     * Set the views
     *
     * @return array
     */
    public function get_views_() {
        $status_links   = array();
        $base_link      = admin_url( 'admin.php?page=prasadi-result-sys' );

        foreach ($this->counts as $key => $value) {
            $class = ( $key == $this->page_status ) ? 'current' : 'status-' . $key;
            $status_links[ $key ] = sprintf( '<a href="%s" class="%s">%s <span class="count">(%s)</span></a>', add_query_arg( array( 'status' => $key ), $base_link ), $class, $value['label'], $value['count'] );
        }

        return $status_links;
    }

    /**
     * Prepare the class items
     *
     * @return void
     */
    function prepare_items() {

        $columns               = $this->get_columns();
        $hidden                = array( );
        $sortable              = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );
        $this->process_bulk_action();

        $per_page              = 25;
        $current_page          = $this->get_pagenum();
        $offset                = ( $current_page -1 ) * $per_page;
        $this->page_status     = isset( $_GET['status'] ) ? sanitize_text_field( $_GET['status'] ) : '2';

        // only ncessary because we have sample data
        $args = array(
            'offset' => $offset,
            'number' => $per_page,
        );

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'] ;
        }

        if( $_GET['faculty-filter'] > 0 ){
            $args['faculty_id'] = $_GET['faculty-filter'];
        }

        $this->items  = prasadi_result_sys_results_get_all_result( $args );

        $this->set_pagination_args( array(
            'total_items' => prasadi_result_sys_results_get_result_count(),
            'per_page'    => $per_page
        ) );
    }

    protected function extra_tablenav( $which ) {
        global $wpdb;
        $move_on_url = '&faculty-filter=';
        $table_name = $wpdb->prefix . 'prasadi_result_sys_faculties';

        if ( $which == "top" ){
            ?>
            <div class="alignleft actions">
                <?php
                $sql = "SELECT * FROM $table_name";

                $faculties = $wpdb->get_results( $sql );
                if( count($faculties)> 0 ){
                    ?>
                    <select name="faculty-filter" class="ewc-filter-faculty">
                        <option value="">Filter by faculty</option>
                        <?php
                        foreach( $faculties as $faculty ){
                            $selected = '';
                            if( $_GET['faculty-filter'] == $faculty->id ){
                                $selected = ' selected = "selected"';
                            }
                                ?>
                                <option value="<?php echo $move_on_url . $faculty->id; ?>" <?php echo $selected; ?>><?php echo $faculty->faculty_name; ?></option>
                                <?php
                        }
                        ?>
                    </select>

                    <?php
                }
                ?>
            </div>

            <script>
                var $prasadiSysAdmin    = jQuery.noConflict();

                $prasadiSysAdmin(window).load(function(){
                    $prasadiSysAdmin(document).on('change', 'select[name=faculty-filter]', function (e) {
                        var filter = $prasadiSysAdmin(this).val();
                        if( filter != '' ){
                            var queryArgs = '&faculty-filter='+filter;
                            document.location.href = 'admin.php?page=prasadi-result-sys'+queryArgs;
                        }
                    });
                });
            </script>
            <?php
        }
        if ( $which == "bottom" ){
            //The code that goes after the table is there

        }
    }
}
