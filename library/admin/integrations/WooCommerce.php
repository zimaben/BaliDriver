<?php
namespace rbtddb\admin;

class WooCommerceAdmin {
    public static function run(){
        if( \is_admin() ){
         #   \add_action('wp_ajax_create_deferred_maps', array(get_class(), 'create_deferred_maps'));
         #   \add_action('wp_ajax_nopriv_create_deferred_maps', array(get_class(), 'create_deferred_maps'));
            
        } else {
            \add_filter( 'woocommerce_enqueue_styles', array(get_class(), 'remove_woo_styles' ));
            \add_filter('woocommerce_billing_fields', array(get_class(), 'remove_company_name'));
        }

    }

    public static function defer_woo(){
        #defer any enqueued requests
    }
    public static function remove_company_name($fields){
        error_log(print_r($fields, true));
        unset( $fields['billing_company'] );
        return $fields;
    }
    public static function remove_woo_styles(){
        #remove woocommerce styles
        # equivalent of '__return_empty_array'
        return [];
    }
}
WooCommerceAdmin::run();