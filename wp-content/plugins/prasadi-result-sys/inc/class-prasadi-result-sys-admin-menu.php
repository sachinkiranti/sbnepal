<?php

class Prasadi_Result_Sys_Admin_Menu {

    /**
     * Kick-in the class
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    /**
     * Add menu items
     *
     * @return void
     */
    public function admin_menu() {

        /** Top Menu **/
        add_menu_page( __( 'Prasadi Result Sys', 'prasadi-result-sys' ), __( 'Prasadi Result Sys', 'prasadi-result-sys' ), 'activate_plugins', 'prasadi-result-sys', array( $this, 'resolve_result_views' ), 'dashicons-star-half', null );

        add_submenu_page( 'prasadi-result-sys', __( 'Result', 'prasadi-result-sys' ), __( 'Result', 'prasadi-result-sys' ), 'activate_plugins', 'prasadi-result-sys', array( $this, 'resolve_result_views' ) );

        add_submenu_page( 'prasadi-result-sys', __( 'Faculty', 'prasadi-result-sys' ), __( 'Faculty', 'prasadi-result-sys' ), 'activate_plugins', 'prasadi-result-sys-faculty', array( $this, 'resolve_faculty_views' ) );

        add_submenu_page( 'prasadi-result-sys', __( 'Import', 'prasadi-result-sys' ), __( 'Import', 'prasadi-result-sys' ), 'activate_plugins', 'prasadi-result-sys-importer', 'prasadi_result_sys_import_handler' );
    }

    /**
     * Handles the plugin page
     *
     * @return void
     */
    public function resolve_result_views() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ($action) {
            case 'view':

                $template = dirname( __FILE__ ) . '/templates/result/prasadi-result-sys-result-show.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/templates/result/prasadi-result-sys-result-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/templates/result/prasadi-result-sys-result-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/templates/result/prasadi-result-sys-result-list.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Handles the plugin page
     *
     * @return void
     */
    public function resolve_faculty_views() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

        switch ($action) {
            case 'view':

                $template = dirname( __FILE__ ) . '/templates/faculty/prasadi-result-sys-faculty-show.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/templates/faculty/prasadi-result-sys-faculty-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/templates/faculty/prasadi-result-sys-faculty-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/templates/faculty/prasadi-result-sys-faculty-list.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

}
