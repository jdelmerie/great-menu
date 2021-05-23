<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// function activate_menu($path, $className = 'menu-active')
// {
//     $CI         =& get_instance();
//     $uri_string = $CI->uri->uri_string();

//     // Home is usually at / && has 0 total segments
//     if ($path === '/' && ($CI->uri->total_segments() === 0)) {
//         $ret_val = 'menu-active';
//     } else {
//         $ret_val = ($uri_string === $path) ? $className : '';
//     }

//     return $ret_val;

if (!function_exists('active_link')) {

    function activate_menu($controller)
    {
        // Getting CI class instance.
        $CI = get_instance();
        // Getting router class to active.
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'menu-active' : '';
    }
}
