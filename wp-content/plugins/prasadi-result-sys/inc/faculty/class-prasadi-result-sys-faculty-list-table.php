<?php

if ( ! class_exists ( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List table class
 */
class Prasadi_Result_Sys_Faculty_Table extends \WP_List_Table {

    function __construct() {
        parent::__construct( array(
            'singular' => 'faculty',
            'plural'   => 'faculties',
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
        _e( 'No Faculty Found', 'prasadi-result-sys' );
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
            case 'faculty_name':
                return $item->faculty_name;

            case 'shortcode':
                return '[prasadi-result-sys title="Prasadi Result" faculty="'.$item->faculty_name.'"]';
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
            'faculty_name'      => __( 'Faculty Name', 'prasadi-result-sys' ),
            'shortcode'      => __( 'Short code', 'prasadi-result-sys' ),
        );

        return $columns;
    }

    /**
     * Render the designation name column
     *
     * @param  object  $item
     *
     * @return string
     */
    function column_faculty_name( $item ) {

        $actions           = array();
        $actions['edit']   = sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=prasadi-result-sys-faculty&action=edit&id=' . $item->id ), $item->id, __( 'Edit this item', 'prasadi-result-sys' ), __( 'Edit', 'prasadi-result-sys' ) );

        return sprintf( '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=prasadi-result-sys-faculty&action=view&id=' . $item->id ), $item->faculty_name, $this->row_actions( $actions ) );
    }

    function column_shortcode( $item )
    {
        return '<small><b>[prasadi-result-sys title="Prasadi Result - '.$item->faculty_name.'" faculty="'.$item->faculty_name.'"]</b></small>';
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
            'trash'  => __( 'Move to Trash', 'prasadi-result-sys' ),
            'empty'  => __( 'Empty', 'prasadi-result-sys' )
        );
        return $actions;
    }

    public function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix.'prasadi_result_sys_faculties';

        if ('trash' === $this->current_action()) {
            $ids = isset($_REQUEST['faculty_id']) ? $_REQUEST['faculty_id'] : array();

            if (is_array($ids)) {
                $ids = implode(',', $ids);
            }

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }

        if ('empty' === $this->current_action()) {
            $wpdb->query("TRUNCATE TABLE $table_name");
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
            '<input type="checkbox" name="faculty_id[]" value="%d" />', $item->id
        );
    }

    /**
     * Set the views
     *
     * @return array
     */
    public function get_views_() {
        $status_links   = array();
        $base_link      = admin_url( 'admin.php?page=prasadi-result-sys-faculty' );

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

        $this->items  = prasadi_result_sys_faculty_get_all_faculty( $args );

        $this->set_pagination_args( array(
            'total_items' => prasadi_result_sys_faculty_get_faculty_count(),
            'per_page'    => $per_page
        ) );
    }
}