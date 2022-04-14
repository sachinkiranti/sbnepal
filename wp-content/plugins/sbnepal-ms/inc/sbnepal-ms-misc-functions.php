<?php

add_filter( "admin_footer_text" , "sbnepal_ms_custom_admin_footer" );

if (! function_exists('sbnepal_ms_custom_admin_footer')) :

    function sbnepal_ms_custom_admin_footer( $footer_text ) {

        if ( isset( $_GET[ "page" ] ) && strpos($_GET[ "page" ], 'sbnepal-ms') !== false ) {

            $footer_text = __( 'Thanks for using the plugin. Made with <span style="color: #e25555;">♥</span> by <a href="https://raisachin.com.np" target="_blank" rel="nofollow">Sachin kiranti</a>.' );

        }
        return $footer_text;
    }

endif;

// Fixing the color-picker issue
add_action( 'wp_print_scripts', 'sbnepal_ms_deregister_javascript', 99 );

if (! function_exists('sbnepal_ms_deregister_javascript')) :
    function sbnepal_ms_deregister_javascript() {
        if(!is_admin())
        {
            wp_dequeue_script('wp-color-picker');
            wp_deregister_script( 'jquery-ui-datepicker' );
            wp_deregister_script( 'wp-color-picker-js-extra' );
            wp_deregister_script( 'wp-color-picker' );

        }

    }
endif;


if ( ! function_exists('sb_dump') ) :

    function sb_dump(){
        $anything = func_get_args();

        add_action('shutdown', function () use ($anything) {
            echo "<pre>";
            print_r($anything);
            echo "</pre>";
            exit;
        });
    }

endif;