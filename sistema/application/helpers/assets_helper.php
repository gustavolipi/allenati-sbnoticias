<?php
if (!function_exists('load_css')) {

    function load_css($data)
    {
        $CI =& get_instance();
        $CI->load->helper('html');
        $CI->config->load('assets');
        if (!$CI->config->item('css_path')) {
            $CI->config->set_item('css_path', 'assets/css/');
        }
        $csspath = base_url() . $CI->config->item('css_path');

        if (!is_array($data)) {
            return link_tag($csspath . $data, 'stylesheet', 'text/css');
        } else {
            $return = '';
            foreach ($data as $item) {
                if (!is_array($item)) {
                    $return .= link_tag($csspath . $item, 'stylesheet', 'text/css');
                } else {
                    $return .= link_tag($csspath . $item[0], 'stylesheet', 'text/css', '', $item[1]);
                }
            }
        }

        return $return;
    }

}
if (!function_exists('load_js')) {

    function load_js($js)
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        if (!is_array($js)) {
            $js = (array)$js;
        }
        $CI->config->load('assets');
        if (!$CI->config->item('js_path')) {
            $CI->config->set_item('js_path', 'assets/js/');
        }
        $jspath = base_url() . $CI->config->item('js_path');
        $return = '';
        foreach ($js as $j) {
            $return .= '<script type="text/javascript" src="' . $jspath . $j . '" charset="utf-8"></script>' . "\n";
        }

        return $return;
    }

}
if (!function_exists('load_img')) {

    function load_img($img)
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->config->load('assets');
        if (!$CI->config->item('image_path')) {
            $CI->config->set_item('image_path', 'public/image/');
        }
        $imagepath = base_url() . $CI->config->item('image_path');

        return $imagepath . $img;
    }

}
