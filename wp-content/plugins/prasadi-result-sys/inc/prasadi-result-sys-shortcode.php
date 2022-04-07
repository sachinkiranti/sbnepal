<?php
// prasadi_result_sys
if ( ! function_exists( 'prasadi_result_sys_frontend_shortcode' ) ) :

    function prasadi_result_sys_frontend_shortcode ( $atts ) {
        global $prasadiBaseDir;
        extract( shortcode_atts(
            array(
                'title'       => 'Result Management',
                'tel_title'   => 'Tel',
                'tel'         => '010-86460349',
                'faculty'     => 'N/A'
            ), $atts ) );

        $file_path = dirname(__FILE__) . '/templates/prasadi-result-sys-frontend.php';

        ob_start();

        include($file_path);

        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

endif;

add_shortcode( 'prasadi-result-sys', 'prasadi_result_sys_frontend_shortcode' );
wp_enqueue_script('jquery');