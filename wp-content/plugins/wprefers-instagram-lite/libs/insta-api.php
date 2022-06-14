<?php

if ( ! defined( 'ABSPATH' ) ) die( 'No direct access!' );

add_action("wp_ajax_wprefers_instagram_lite_xhr_action" , "wprefers_instagram_lite_xhr_action");
add_action("wp_ajax_nopriv_wprefers_instagram_lite_xhr_action" , "wprefers_instagram_lite_xhr_action");

if ( ! function_exists('wprefers_instagram_lite_xhr_action') ) :

    function wprefers_instagram_lite_xhr_action () {
        check_ajax_referer( 'wprefers-instagram-lite-xhr-nonce', 'security' );

        $username = sanitize_text_field($_POST['username']);
        $query = sanitize_text_field($_POST['query']);

        wp_send_json(
            wprefers_instagram_lite_resolve_data(
                $username, $query
            )
        );
        wp_die();
    }

endif;

function wprefers_instagram_lite_resolve_data ($username, $query) {
    $instaQuery = wp_remote_request(sprintf('https://www.instagram.com/%s/?__a=1', $username) );

    wp_send_json($instaQuery);
    $data = isset($instaQuery) ? json_decode($instaQuery['body'], true) : [];

    if (!empty($data)){
        wp_send_json("Something went wrong!");
        wp_die();
    }

    wp_send_json($data);

    $domainsArray = isset($suggestions['results']) ? $suggestions['results'] : [];

    return array(
        'html' => wprefers_instagram_lite_resolve_html_data($domainsArray, $url),
        'total' => count($domainsArray)
    );
}

function wprefers_instagram_lite_resolve_html_data ($domains, $url = null) {
    $html = '';
    foreach ($domains as $domain) :
        $button = $domain['availability'] === 'available' ? '<a target="_blank" class="wprefers-referral-link" href="'.$url.'">Buy</a>' : '';
        $html .= '<tr><td>'.strtolower($domain['name']).'<span class="wprefers-domain-status-'.$domain['availability'].'">'.
            ucfirst($domain['availability']).$button.'</span></td></tr>';
    endforeach;

    return $html;
}