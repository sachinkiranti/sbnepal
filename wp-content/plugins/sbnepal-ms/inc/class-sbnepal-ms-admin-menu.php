<?php

if (! class_exists('SBNepal_MS_Admin_Menu') ) {

    class SBNepal_MS_Admin_Menu {
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        }

        public function admin_menu() {
            add_menu_page(
                __( 'Smart Business In Nepal', 'sbnepal-ms' ),
                __( 'Smart Business In Nepal', 'sbnepal-ms' ),
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

//            add_submenu_page(
//                'sbnepal-ms',
//                __( 'Hierarchy', 'sbnepal-ms' ),
//                __( 'Hierarchy', 'sbnepal-ms' ),
//                'activate_plugins',
//                'sbnepal-ms-hierarchy',
//                array( $this, 'resolve_hierarchy_view' )
//            );

            add_submenu_page(
                'sbnepal-ms',
                __( 'Wallet', 'sbnepal-ms' ),
                __( 'Wallet', 'sbnepal-ms' ),
                'activate_plugins',
                'sbnepal-ms-wallet',
                array( $this, 'resolve_wallet_view' )
            );

            //  smart-business-in-nepal_page_sbnepal-ms-setting
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
            global $sbNepalBaseDir;

            $template = dirname( __FILE__ ) . '/templates/setting/index.php';

            if ($_GET['action'] === 'smtp') {
                $template = dirname( __FILE__ ) . '/templates/setting/smtp-setting.php';
            }

            if ($_GET['action'] === 'redirect') {
                $template = dirname( __FILE__ ) . '/templates/setting/redirect-setting.php';
            }

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

// Adding toastr to setting sb page
add_action("admin_print_styles-smart-business-in-nepal_page_sbnepal-ms-setting", function () {
    wp_enqueue_style(
        'sbnepal_ms-toastr-css',
        "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    );
});

add_action("admin_print_scripts-smart-business-in-nepal_page_sbnepal-ms-setting", function () {
    wp_enqueue_script(
        'sbnepal_ms-toastr-js',
        '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
        array( 'jquery' )
    );
});

// Adding modal to wallet

add_action("admin_print_styles-smart-business-in-nepal_page_sbnepal-ms-wallet", function () {
    wp_enqueue_style( 'wp-jquery-ui-dialog' );
    wp_enqueue_style('thickbox');
    wp_enqueue_style(
        'sbnepal_ms-toastr-css',
        "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    );
});

add_action("admin_print_scripts-smart-business-in-nepal_page_sbnepal-ms-wallet", function () {
    wp_enqueue_script( 'jquery-ui-dialog' );
    wp_enqueue_script('plugin-install');
    wp_enqueue_script(
        'sbnepal_ms-toastr-js',
        '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
        array( 'jquery' )
    );
    wp_register_script(
        'smart-business-in-nepal-custom-wallet-js',
        plugins_url('sbnepal-ms/assets/js/agent-list.js'),
        array( 'jquery' )
    );

    global $sbNepalBaseDir;

    wp_localize_script(
        'smart-business-in-nepal-custom-wallet-js',
        'sbnepal_ajax_object', array(
        'ajax_nonce' => wp_create_nonce('wps-frontend-sbnepal-ms-pay-agent'),
        'sbnepal_ms_paying_agent_url' => $sbNepalBaseDir.'inc/xhr/sbnepal-ms-pay-agent-xhr.php'
    ) );

    wp_enqueue_script(
        'smart-business-in-nepal-custom-wallet-js'
    );
});

// Adding toastr to agent list
add_action("admin_print_styles-smart-business-in-nepal_page_sbnepal-ms-agent", function () {
    wp_enqueue_style(
        'sbnepal_ms-toastr-css',
        "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    );

    if ($_GET['action'] === 'new' || $_GET['action'] === 'edit') {
        wp_enqueue_style(
            'sbnepal_ms-img-dropify-css',
            plugins_url('sbnepal-ms/assets/js/plugins/dropify/dropify.min.css')
        );
    }
});

add_action("admin_print_scripts-smart-business-in-nepal_page_sbnepal-ms-agent", function () {
    wp_enqueue_script(
        'sbnepal_ms-toastr-js',
        '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
        array( 'jquery' )
    );

    if ($_GET['action'] === 'new' || $_GET['action'] === 'edit') {
        wp_enqueue_script(
            'sbnepal_ms-img-dropify-js',
            plugins_url('sbnepal-ms/assets/js/plugins/dropify/dropify.min.js')
        );
    }


    // Adding localize js script for agent
    wp_register_script(
        'smart-business-in-nepal-custom-js',
        plugins_url('sbnepal-ms/assets/js/agent-list.js'),
        array( 'jquery', 'sbnepal_ms-toastr-js' )
    );

    global $sbNepalBaseDir;

    wp_localize_script(
        'smart-business-in-nepal-custom-js',
        'sbnepal_ajax_object', array(
        'ajax_nonce' => wp_create_nonce('wps-frontend-sbnepal-ms-agent-activation'),
        'ajax_nonce_reject' => wp_create_nonce('wps-frontend-sbnepal-ms-agent-reject'),
        'sbnepal_ms_active_agent_url' => $sbNepalBaseDir.'inc/xhr/sbnepal-ms-activate-agent-xhr.php',
        'sbnepal_ms_reject_agent_url' => $sbNepalBaseDir.'inc/xhr/sbnepal-ms-reject-agent-xhr.php'
    ) );

    wp_enqueue_script(
        'smart-business-in-nepal-custom-js'
    );
});
