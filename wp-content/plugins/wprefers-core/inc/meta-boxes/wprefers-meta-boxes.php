<?php

/**
 * WPRefers MetaBoxes
 *
 * @link https://raisachin.com.np
 * @package wprefers-core
 */

$pluginDirPath = WP_PLUGIN_DIR . ('/wprefers-core/inc/libs/meta-box/meta-box-generator.php');

require_once $pluginDirPath;

const TEXT_DOMAIN = 'wprefers-core';

if (! function_exists('wprefers_core_create_meta_boxes')) :

    function wprefers_core_create_meta_boxes () {
        $meta_boxes = array();

        $meta_boxes[] = array(
            'id' => 'wprefers_core_button',
            'name' => 'WP Refer Featured',
            'post_type' => array( 'page', 'post' ),
            'position' => 'normal',
            'priority' => 'high',

            'args' => array(
                array(
                    'name' => 'Is Featured',
//                    'description' => 'Is Featured',
                    'label' => 'Is Featured',
                    'id'   => 'is_featured',
                    'type'  => 'checkbox',
                    'default' => ''
                ),
            )
        );

        return $meta_boxes;
    }

endif;

foreach (wprefers_core_create_meta_boxes() as $metaBoxOptions) :
    new WPRefersMetaBoxGenerator($metaBoxOptions);
endforeach;