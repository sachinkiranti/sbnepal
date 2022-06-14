<?php

if (! function_exists( 'wprefers_get_my_location' )) :

    function wprefers_get_my_location () {

        //whether ip is from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        $response = wp_remote_request('https://www.iplocate.io/api/lookup/'. $ip_address);
        return json_decode($response['body'], 1);
    }

endif;