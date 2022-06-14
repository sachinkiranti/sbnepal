<?php

if ( ! defined( 'ABSPATH' ) ) die( 'No direct access!' );

add_action("wp_ajax_wprefers_domain_age_checker_xhr_action" , "wprefers_domain_age_checker_xhr_action");
add_action("wp_ajax_nopriv_wprefers_domain_age_checker_xhr_action" , "wprefers_domain_age_checker_xhr_action");

if ( ! function_exists('wprefers_domain_age_checker_xhr_action') ) :

    function wprefers_domain_age_checker_xhr_action () {
        check_ajax_referer( 'wprefers-domain-age-checker-xhr-nonce', 'security' );

        $domains = sanitize_text_field($_POST['domains']);

        wp_send_json(
            wprefers_domain_age_checker_resolve_data(
                $domains
            )
        );
        wp_die();
    }

endif;

include "lib/domain-age.php";

if (! function_exists('wprefers_domain_age_checker_resolve_data')) {

    function wprefers_domain_age_checker_resolve_data ($domains) {
        $domains = array_filter(array_unique(explode(' ', $domains)));

        $response = [];

        $count = 0;

        foreach (array_filter($domains) as $domain) {

            if ($count < 5) {
                // remove http/https
                $domain = preg_replace( "#^[^:/.]*[:/]+#i", "", preg_replace( "{/$}", "", urldecode( $domain ) ) );
                $response[] = (new WPRefersCheckDomainAge)->getInfo(
                    str_replace('www.', '', $domain)
                );
            }

            $count++;
        }

        return array(
            'data'  => $response,
            'html'  => wprefers_domain_age_checker_resolve_html_data($response),
            'total' => count($response)
        );
    }

}

function wprefers_domain_age_checker_resolve_html_data ($data) {
    $html = '';
    foreach ($data as $info) :

        if (count($info) > 1) {
            $html .=  '<tr><td>'.$info['domain_name'].'</td>' .
                '<td>'.$info['age'].'</td>' .
                '<td>'.$info['creation_date'].'</td>' .
                '<td>'.$info['last_update_of_whois_database'].'</td>' .
                '<td>'.$info['registry_expiry_date'].'</td></tr>';
        } else {
            $html .= '<tr><td>'.$info['domain_name'].'</td>' .
                '<td colspan="4">Information could not be found. Try again Later.</td></tr>';
        }

    endforeach;

    return $html;
}