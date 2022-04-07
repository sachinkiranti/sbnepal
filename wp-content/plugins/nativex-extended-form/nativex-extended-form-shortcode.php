<?php
// native_xtended_form
if ( ! function_exists( 'nativex_extended_form_shortcode' ) ) :

    function nativex_extended_form_shortcode ( $atts ) {

        global $nativex_base_dir;
        extract( shortcode_atts(
            array(
                'title'       => 'Contact Us',
                'tel_title'   => 'Tel',
                'tel'         => '010-86460349'
            ), $atts ) );

        $file_path = dirname(__FILE__) . '/partials/nativex-extended-form-design.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'native_xtended_form', 'nativex_extended_form_shortcode' );
wp_enqueue_script('jquery');