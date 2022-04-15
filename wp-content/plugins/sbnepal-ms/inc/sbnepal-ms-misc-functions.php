<?php

add_action( 'phpmailer_init', 'sbnepal_ms_send_smtp_email' );

if (! function_exists('sbnepal_ms_send_smtp_email')) :

    function sbnepal_ms_send_smtp_email( $phpmailer ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = SMTP_HOST;
        $phpmailer->SMTPAuth   = SMTP_AUTH;
        $phpmailer->Port       = SMTP_PORT;
        $phpmailer->SMTPSecure = SMTP_SECURE;
        $phpmailer->Username   = SMTP_USERNAME;
        $phpmailer->Password   = SMTP_PASSWORD;
        $phpmailer->From       = SMTP_FROM;
        $phpmailer->FromName   = SMTP_FROMNAME;
    }

endif;

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

// Custom Editor

if (! function_exists('sbnepal_ms_custom_editor')) :

    function sbnepal_ms_custom_editor($value, $textareaName) {
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