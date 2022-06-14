<?php
/**
 * WP Refers Utilities WPRefersMetaBoxGenerator.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wprefers-core
 *
 * WPRefers WPRefersMetaBoxGenerator
 */

if ( ! class_exists('WPRefersMetaBoxGenerator') ) :

    class WPRefersMetaBoxGenerator
    {

        /* construct function, add meta box and save action hooks */
        function    __construct($options)
        {
            $this->options = $options;
            $this->prefix = $this->options['id'] . '_';
            add_action('add_meta_boxes', array(&$this, 'create'));
            add_action('save_post', array(&$this, 'save'), 1, 2);
        }

        /* function that creates the metabox */
        function create()
        {
//            //Check if post has 'car' term from 'my-tax' taxonomy. If not don't add metabox.
//            global $post;
//
//            if( ! has_term( 'car', 'my-tax', $post ) )
//                return;

            /* for each post type defined */
            foreach ($this->options['post_type'] as $post_type):

                add_meta_box($this->options['id'], $this->options['name'], array(&$this, 'fill'), $post_type, $this->options['position'], $this->options['priority']);

            endforeach;
        }

        /* meta box html */
        function fill()
        {
            global $post;

            if (isset($this->options['args'])):

                $metabox_html = '<table class="form-table"><tbody>';

                /* for each option defined */
                foreach ($this->options['args'] as $param):

                    $metabox_html .= '<tr id="'. $this->prefix . $param['id'] . "_" .$param['radio-value'] .'">';

                    /* get option value and set default parameters */
                    if (!$value = get_post_meta($post->ID, $this->prefix . $param['id'], true))
                        if (isset($param['default']))
                            $value = $param['default'];

                    if (isset($param['required'])) {
                        $required = $param['required'] ? "required" : "";
                    } else {
                        $required = '';
                    }

                    switch ($param['type']) :

                        /* <input type=text> */
                        case 'text':
                        {
                            $metabox_html .= '<th style="font-weight:normal"><label for="' . $this->prefix . $param['id'] . '">' . $param['label'] . '</label></th><td><input placeholder="' . $param['placeholder'] . '" name="' . $this->prefix . $param['id'] . '" class="widefat" type="text" id="' . $this->prefix . $param['id'] . '" value="' . esc_attr($value) . '" ';
                            $metabox_html .= 'class="widefat" /><br />';
                            if (isset($param['description']))
                                $metabox_html .= '<span class="description">' . $param['description'] . '</span>';
                            $metabox_html .= '</td>';
                            break;
                        }

                        /* <input type=url> */
                        case 'url':
                        {
                            $metabox_html .= '<th style="font-weight:normal"><label for="' . $this->prefix . $param['id'] . '">' . $param['label'] . '</label></th><td><input placeholder="' . $param['placeholder'] . '" name="' . $this->prefix . $param['id'] . '" class="widefat"  type="url" id="' . $this->prefix . $param['id'] . '" value="' . esc_attr($value) . '" ';
                            $metabox_html .= 'class="widefat" /><br />';
                            if (isset($param['description']))
                                $metabox_html .= '<span class="description">' . $param['description'] . '</span>';
                            $metabox_html .= '</td>';
                            break;
                        }

                        /* <textarea> */
                        case 'textarea':
                        {
                            $metabox_html .= '<th style="font-weight:normal"><label for="' . $this->prefix . $param['id'] . '">' . $param['label'] . '</label></th><td><textarea placeholder="' . $param['placeholder'] . '" name="' . $this->prefix . $param['id'] . '" class="widefat" id="' . $this->prefix . $param['id'] . '" value="' . esc_attr($value) . '" ';
                            $metabox_html .= 'class="widefat" />'.esc_attr($value).'</textarea><br />';
                            if (isset($param['description']))
                                $metabox_html .= '<span class="description">' . $param['description'] . '</span>';
                            $metabox_html .= '</td>';
                            break;
                        }

                        /* <select> */
                        case 'select':
                        {
                            $metabox_html .= '<th data-id="'.($value).'" style="font-weight:normal"><label for="' . $this->prefix . $param['id'] . '">' . $param['label'] . '</label></th><td><select placeholder="' . $param['placeholder'] . '" name="' . $this->prefix . $param['id'] . '" class="widefat" '. $required .' id="' . $this->prefix . $param['id'] . '">';

                            $metabox_html .= '<option value="" disabled selected>'.$param['placeholder'].'</option>';

                            foreach ($param['select'] as $val => $key) :
                                $status = esc_attr($value) === $val ? "selected" : "";
                                $metabox_html .= '<option value="'.$val.'" '. $status.'>'.$key.'</option>';
                            endforeach;

                            $metabox_html .= '</select><br />';
                            if (isset($param['description']))
                                $metabox_html .= '<span class="description">' . $param['description'] . '</span>';
                            $metabox_html .= '</td>';
                            break;
                        }

                        /* <input type=checkbox> */
                        case 'checkbox':
                        {
                            $metabox_html .= '<th style="font-weight:normal"><label for="' . $this->prefix . $param['id'] . '">' . $param['label'] . '</label></th><td><label for="' . $this->prefix . $param['id'] . '"><input name="' . $this->prefix . $param['id'] . '" class="widefat"  type="checkbox" id="' . $this->prefix . $param['id'] . '"';
                            if ($value == 'on')
                                $metabox_html .= ' checked="checked"';
                            $metabox_html .= ' />';
                            if (isset($param['description']))
                                $metabox_html .= '<span class="description">' . $param['description'] . '</span>';
                            $metabox_html .= '</td>';
                            break;
                        }

                        /* <input type=radio> */
                        case 'radio':
                        {
                            $metabox_html .= '<th style="font-weight:normal"><label for="' . $this->prefix . $param['id'] . '">' . $param['label'] . '</label></th><td><label for="' . $this->prefix . $param['id'] . $param['radio-value'] . '"><input name="' . $this->prefix . $param['id'] . '" class="widefat" '. $required .'  type="radio" id="' . $this->prefix . $param['id'] . $param['radio-value'] . '" value="'. $param['radio-value'] .'"';
                            if ($value == 'on')
                                $metabox_html .= ' checked="checked"';
                            $metabox_html .= ' />';
                            if (isset($param['description']))
                                $metabox_html .= '<span class="description">' . $param['description'] . '</span>';
                            $metabox_html .= '</td>';
                            break;
                        }

                    endswitch;
                    $metabox_html .= '</tr>';

                endforeach;

                $metabox_html .= '</tbody></table>';

                /* echo metabox content*/
                echo $metabox_html;

            endif;
        }


        function save($post_id, $post)
        {

            /* if this post type do not have metabox */
            if (!in_array($post->post_type, $this->options['post_type']))
                return;

            foreach ($this->options['args'] as $param) {

                if (isset($_POST[$this->prefix . $param['id']]) && trim($_POST[$this->prefix . $param['id']])) {
                    update_post_meta($post_id, $this->prefix . $param['id'], $_POST[$this->prefix . $param['id']]);
                } else {
                    delete_post_meta($post_id, $this->prefix . $param['id']);
                }

            }
        }
    }

endif;