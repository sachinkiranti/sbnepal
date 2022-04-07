<?php

if (! class_exists('SBNepal_MS_Admin_Menu') ) {

    class SBNepal_MS_Admin_Menu {
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        }

        public function admin_menu() {
            add_menu_page(
                __( 'SBNepal MS', 'sbnepal-ms' ),
                __( 'SBNepal MS', 'sbnepal-ms' ),
                'activate_plugins',
                'sbnepal-ms',
                array( $this, 'resolve_dashboard_view' ),
                'dashicons-networking',
                2
            );

            add_submenu_page(
                'sbnepal-ms',
                __( 'Agent', 'sbnepal-ms' ),
                __( 'Agent', 'sbnepal-ms' ),
                'activate_plugins',
                'sbnepal-ms-agent',
                array( $this, 'resolve_views' )
            );

            add_submenu_page(
                'sbnepal-ms',
                __( 'Hierarchy', 'sbnepal-ms' ),
                __( 'Hierarchy', 'sbnepal-ms' ),
                'activate_plugins',
                'sbnepal-ms-hierarchy',
                array( $this, 'resolve_hierarchy_view' )
            );

            add_submenu_page(
                'sbnepal-ms',
                __( 'Wallet', 'sbnepal-ms' ),
                __( 'Wallet', 'sbnepal-ms' ),
                'activate_plugins',
                'sbnepal-ms-wallet',
                array( $this, 'resolve_wallet_view' )
            );

            add_submenu_page(
                'sbnepal-ms',
                __( 'Setting', 'sbnepal-ms' ),
                __( 'Setting', 'sbnepal-ms' ),
                'activate_plugins',
                'sbnepal-ms-setting',
                array( $this, 'resolve_setting_view' )
            );

        }

        public function resolve_views() {
            $action = isset( $_GET['action'] ) ? $_GET['action'] : 'agent-list';
            $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

            switch ($action) {
                case 'view':

                    $template = dirname( __FILE__ ) . '/templates/agent/sbnepal-ms-agent-show.php';
                    break;

                case 'edit':
                    $template = dirname( __FILE__ ) . '/templates/agent/sbnepal-ms-agent-edit.php';
                    break;

                case 'new':
                    $template = dirname( __FILE__ ) . '/templates/agent/sbnepal-ms-agent-new.php';
                    break;

                default:
                    $template = dirname( __FILE__ ) . '/templates/agent/sbnepal-ms-agent-list.php';
                    break;
            }

            if ( file_exists( $template ) ) {
                include $template;
            }
        }

        public function resolve_setting_view()
        {
            $template = dirname( __FILE__ ) . '/templates/setting/index.php';
            if ( file_exists( $template ) ) {
                include $template;
            }
        }

        public function resolve_dashboard_view()
        {
            $template = dirname( __FILE__ ) . '/templates/dashboard.php';
            if ( file_exists( $template ) ) {
                include $template;
            }
        }

        public function resolve_hierarchy_view()
        {
            $template = dirname( __FILE__ ) . '/templates/hierarchy/index.php';
            if ( file_exists( $template ) ) {
                include $template;
            }
        }

        public function resolve_wallet_view()
        {
            $template = dirname( __FILE__ ) . '/templates/wallet/index.php';
            if ( file_exists( $template ) ) {
                include $template;
            }
        }

    }

}