<?php
/*
* Plugin Name: WPPB Dokan Addon
* Plugin URI: http://www.murshidalam.com/plugins/wppb-dokan
* Author: Fahim Murshed
* Author URI: https://profiles.wordpress.org/fahimmurshed/
* License: GNU/GPL V2 or Later
* Description: Simple Portfolio for WP Page Builder
* Version: 1.0.2
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Add CSS for WPPB Dokan Addon 
add_action( 'wp_enqueue_scripts', 'dokan_style' );
if(!function_exists('dokan_style')):
    function dokan_style(){
        // CSS
        wp_enqueue_style('dokan-css',plugins_url('css/dokan.css',__FILE__));
        wp_enqueue_style('dokan-bootstrap',plugins_url('/css/bootstrap.min.css',__FILE__));

        // JS
        wp_enqueue_script('rhino-custom',plugins_url('/js/bootstrap.bundle.min.js',__FILE__), array('jquery'));
    }
endif;

// Define Dir URL
define('WPPB_DIR_URL', plugin_dir_url(__FILE__));

// Addon List Item
require 'addons/dokan.php';

// WPPB Hook
add_filter( 'wppb_available_addons', 'prefix_custom_addon_include' );
if ( ! function_exists('prefix_custom_addon_include')){
    function prefix_custom_addon_include($addons){
        $addons[] = 'wppb_dokan_shortcode';
        // Add Other Custom Addon class name in here, at a time.
        return $addons;
    }
}