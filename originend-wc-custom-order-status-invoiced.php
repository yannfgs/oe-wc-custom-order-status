<?php
/*
Plugin Name: WooCommerce Custom Order Status - Invoiced
Plugin URI: http://www.originend.com
Description: Adds a custom order status 'Invoiced' to WooCommerce.
Version: 1.0
Author: Yann Szilagyi
Author URI: https://www.originend.com.br
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Check if WooCommerce is active
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    // Register the custom order status
    function register_originend_custom_order_status() {
        register_post_status('wc-invoiced', array(
            'label'                     => _x('Invoiced', 'Order status', 'text_domain'),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop('Invoiced <span class="count">(%s)</span>', 'Invoiced <span class="count">(%s)</span>', 'text_domain')
        ));
    }
    add_action('init', 'register_originend_custom_order_status');

    // Add to list of WC Order statuses
    function add_originend_custom_order_status_to_woocommerce($order_statuses) {
        $order_statuses['wc-invoiced'] = _x('Invoiced', 'Order status', 'text_domain');
        return $order_statuses;
    }
    add_filter('wc_order_statuses', 'add_originend_custom_order_status_to_woocommerce');

}
