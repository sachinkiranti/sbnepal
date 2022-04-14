<?php

/**
 * Register JS for the register Panel
 */
if ( ! function_exists('sbnepal_ms_register_enqueue_scripts') ) :

    function sbnepal_ms_register_enqueue_scripts () {
        wp_enqueue_script(
            'sbnepal_ms-img-dropify-js',
            plugins_url('sbnepal-ms/assets/js/plugins/dropify/dropify.min.js')
        );

        wp_enqueue_script(
            'sbnepal_ms-toastr-js',
            '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'
        );

        wp_enqueue_script( 'boot4-popper-js',
            'https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js',
            array( 'jquery' ),
            '',
            true
        );

        wp_enqueue_script( 'boot4-js',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js',
            array( 'jquery', 'boot4-popper-js' ),
            '',
            true
        );
    }

endif;

add_action(
    'wp_enqueue_scripts',
    'sbnepal_ms_register_enqueue_scripts'
);

/**
 * Register CSS for the register Panel
 */
if ( ! function_exists('sbnepal_ms_register_enqueue_styles') ) :

    function sbnepal_ms_register_enqueue_styles () {
        wp_enqueue_style(
            'sbnepal_ms-img-dropify-css',
            plugins_url('sbnepal-ms/assets/js/plugins/dropify/dropify.min.css')
        );

        wp_enqueue_style(
            'sbnepal_ms-toastr-css',
            "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        );

        wp_enqueue_style(
            'bootstrap4',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'
        );

    }

endif;

add_action(
    'wp_enqueue_scripts',
    'sbnepal_ms_register_enqueue_styles'
);