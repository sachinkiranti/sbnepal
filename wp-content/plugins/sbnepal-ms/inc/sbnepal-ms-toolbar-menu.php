<?php

if (! function_exists('sbnepal_ms_toolbar_link')) :

    function sbnepal_ms_toolbar_link($wp_admin_bar) {
        $args = array(
            'id' => 'sbnepal_ms',
            'title' => 'Smart Business In Nepal',
            'href' => admin_url( "admin.php?page=sbnepal-ms" ),
            'meta' => array(
                'class' => 'sbnepal_ms',
                'title' => 'Visit Dashboard'
            )
        );
        $wp_admin_bar->add_node($args);

        $args = array(
            'id' => 'sbnepal_ms-agents',
            'title' => 'Agent',
            'href' => admin_url( "admin.php?page=sbnepal-ms-agent" ),
            'parent' => 'sbnepal_ms',
            'meta' => array(
                'class' => 'sbnepal_ms-agents',
                'title' => 'Visit Agent'
            )
        );
        $wp_admin_bar->add_node($args);

        $args = array(
            'id' => 'sbnepal_ms-agents-new',
            'title' => 'Add Agent',
            'href' => admin_url( "admin.php?page=sbnepal-ms-agent&action=new" ),
            'parent' => 'sbnepal_ms-agents',
            'meta' => array(
                'class' => 'sbnepal_ms-agents',
                'title' => 'Add Agent'
            )
        );

        $wp_admin_bar->add_node($args);

        $args = array(
            'id' => 'sbnepal_ms-agents-list',
            'title' => 'List Agent',
            'href' => admin_url( "admin.php?page=sbnepal-ms-agent" ),
            'parent' => 'sbnepal_ms-agents',
            'meta' => array(
                'class' => 'sbnepal_ms-agents-list',
                'title' => 'List Agent'
            )
        );

        $wp_admin_bar->add_node($args);

//        $args = array(
//            'id' => 'sbnepal_ms-hierarchy',
//            'title' => 'Hierarchy',
//            'href' => admin_url( "admin.php?page=sbnepal-ms-hierarchy" ),
//            'parent' => 'sbnepal_ms',
//            'meta' => array(
//                'class' => 'sbnepal_ms-hierarchy',
//                'title' => 'Visit Hierarchy'
//            )
//        );
//        $wp_admin_bar->add_node($args);

        $args = array(
            'id' => 'sbnepal_ms-wallet',
            'title' => 'Wallet',
            'href' => admin_url( "admin.php?page=sbnepal-ms-wallet" ),
            'parent' => 'sbnepal_ms',
            'meta' => array(
                'class' => 'sbnepal_ms-wallet',
                'title' => 'Visit Wallet'
            )
        );
        $wp_admin_bar->add_node($args);

        $args = array(
            'id' => 'sbnepal_ms-setting',
            'title' => 'Setting',
            'href' => admin_url( "admin.php?page=sbnepal-ms-setting" ),
            'parent' => 'sbnepal_ms',
            'meta' => array(
                'class' => 'sbnepal_ms-setting',
                'title' => 'Visit Setting'
            )
        );
        $wp_admin_bar->add_node($args);

        $args = array(
            'id' => 'sbnepal_ms-setting-general',
            'title' => 'General',
            'href' => admin_url( "admin.php?page=sbnepal-ms-setting" ),
            'parent' => 'sbnepal_ms-setting',
            'meta' => array(
                'class' => 'sbnepal_ms-setting-general',
                'title' => 'Visit SMTP Setting'
            )
        );
        $wp_admin_bar->add_node($args);

        $args = array(
            'id' => 'sbnepal_ms-setting-smtp',
            'title' => 'SMTP Setting',
            'href' => admin_url( "admin.php?page=sbnepal-ms-setting&action=smtp" ),
            'parent' => 'sbnepal_ms-setting',
            'meta' => array(
                'class' => 'sbnepal_ms-setting-smtp',
                'title' => 'Visit SMTP Setting'
            )
        );
        $wp_admin_bar->add_node($args);
    }

endif;

add_action('admin_bar_menu', 'sbnepal_ms_toolbar_link', 999);