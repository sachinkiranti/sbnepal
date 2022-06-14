<?php

if ( ! defined( 'ABSPATH' ) ) die( 'No direct access!' );

add_action("wp_ajax_wprefers_domain_availability_checker_xhr_action" , "wprefers_domain_availability_checker_xhr_action");
add_action("wp_ajax_nopriv_wprefers_domain_availability_checker_xhr_action" , "wprefers_domain_availability_checker_xhr_action");

if ( ! function_exists('wprefers_domain_availability_checker_xhr_action') ) :

    function wprefers_domain_availability_checker_xhr_action () {
        check_ajax_referer( 'wprefers-domain-availability-checker-xhr-nonce', 'security' );

        $domain = sanitize_text_field($_POST['domain']);
        $url = sanitize_text_field($_POST['url']);
        $whoIsKey = sanitize_text_field($_POST['whoisKey']);

        wp_send_json(
            wprefers_domain_availability_checker_resolve_data(
                $domain, $url, $whoIsKey // 'at_MFHOBOy3IcpSWqNU3merT39zAYrIW'
            )
        );
        wp_die();
    }

endif;

function wprefers_domain_availability_checker_resolve_data ($domain, $url = null, $whoIsApiKey = null) {

    if ($whoIsApiKey) {
        $args = array(
            'domainName'   => $domain,
            'apiKey'       => $whoIsApiKey,
            'outputFormat' => 'json',
            'credits'      => 'DA'
        );

        $response = wp_remote_request('https://domain-availability.whoisxmlapi.com/api/v1?' . build_query($args));
    }

    $suggestionResponse = wp_remote_request('https://sugapi.verisign-grs.com/ns-api/2.0/suggest?name=' . $domain);

    $data = isset($response) ? json_decode($response['body'], true) : [];
    $suggestions = json_decode($suggestionResponse['body'], true);
    $suggestionResponseCode = $suggestionResponse['response']['code'];

    if (!empty($suggestionResponseCode) && $suggestionResponseCode !== 200){
        wp_send_json("Something went wrong!");
        wp_die();
    }

    $domainsArray = isset($suggestions['results']) ? $suggestions['results'] : [];

    return array(
        'html' => wprefers_domain_availability_checker_resolve_html_data($domainsArray, $url),
        'total' => count($domainsArray)
    );
}

function wprefers_domain_availability_checker_resolve_html_data ($domains, $url = null) {
    $html = '';
    foreach ($domains as $domain) :
        $button = $domain['availability'] === 'available' ? '<a target="_blank" class="wprefers-referral-link" href="'.$url.'">Buy</a>' : '';
        $html .= '<tr><td>'.strtolower($domain['name']).'<span class="wprefers-domain-status-'.$domain['availability'].'">'.
            ucfirst($domain['availability']).$button.'</span></td></tr>';
    endforeach;

    return $html;
}