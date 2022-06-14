<?php

add_action( 'phpmailer_init', 'sbnepal_ms_send_smtp_email' );

if (! function_exists('sbnepal_ms_send_smtp_email')) :
 
    function sbnepal_ms_send_smtp_email( $phpmailer ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = get_option("sbnepal-ms_smtp-host", 'server.sbnepal.com');
        $phpmailer->SMTPAuth   = ((int) get_option("sbnepal-ms_smtp-auth", 1) );
        $phpmailer->Port       = get_option("sbnepal-ms_smtp-port", '465');
        $phpmailer->SMTPSecure = get_option("sbnepal-ms_smtp-secure", 'ssl');
        $phpmailer->Username   = get_option("sbnepal-ms_smtp-username", 'sbnepal@gmail.com');
        $phpmailer->Password   = get_option("sbnepal-ms_smtp-password");
        $phpmailer->From       = get_option("sbnepal-ms_smtp-from", 'noreply@sbnepal.com');
        $phpmailer->FromName   = get_option("sbnepal-ms_smtp-from-name", 'Smart Business in Nepal');
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

if ( ! function_exists('sbnepal_ms_upload') ) :

    function sbnepal_ms_upload ( $image, $column ) {
        $wordpress_upload_dir = wp_upload_dir();
        // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
        // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
        $i = 1; // number of tries when the file with the same name is already exists

        $new_file_path = $wordpress_upload_dir['path'] . '/' . $image['name'];
        $new_file_mime = mime_content_type( $image['tmp_name'] );

        if( empty( $image ) )
            die( $column.' is not selected.' );

        if( $image['error'] )
            die( $image['error'] );

        if( $image['size'] > wp_max_upload_size() )
            die( $column.' is too large than expected.' );

        if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
            die( 'WordPress doesn\'t allow this type of uploads.' );

        while( file_exists( $new_file_path ) ) {
            $i++;
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $image['name'];
        }

        if( move_uploaded_file( $image['tmp_name'], $new_file_path ) ) {


            $upload_id = wp_insert_attachment( array(
                'guid'           => $new_file_path,
                'post_mime_type' => $new_file_mime,
                'post_title'     => preg_replace( '/\.[^.]+$/', '', $image['name'] ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            ), $new_file_path );

            // wp_generate_attachment_metadata() won't work if you do not include this file
            require_once( ABSPATH . 'wp-admin/includes/image.php' );

            // Generate and save the attachment metas into the database
            wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );

            return $wordpress_upload_dir['url'] . '/' . basename( $new_file_path );

        }
    }

endif;

if ( ! function_exists('sb_dump') ) :

    function sb_dump(){
        $anything = func_get_args();

        add_action('shutdown', function () use ($anything) {
            echo "<pre id=wpwrap style='text-align: center'>";
            print_r($anything);
            echo "</pre>";
            exit;
        });
    }

endif;