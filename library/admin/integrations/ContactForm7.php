<?php
namespace <!PLUGINPATH->\admin;
use <!PLUGINPATH->\Config as Config;

/*/ 
 * Class for Contact Form 7 Hooks and customizations. 
 * 
/*/
class ContactForm7 {
    public static function run(){

        /* Contact Form 7 better validation */
        \add_filter( 'wpcf7_validate_tel*', array(get_class(), 'cf7_telephone_verification'), 20, 2 );

        /* CF7 Turn off JS & CSS loading  for all forms */
        add_filter( 'wpcf7_load_js', '__return_false' );
        add_filter( 'wpcf7_load_css', '__return_false' );

        /* Add Spinner class to all forms */
        add_filter('wpcf7_form_class_attr', array(get_class(), 'add_spinner_class'), 10, 1);

        #add scripts post load
        \add_action('wp_ajax_defer_cf7assets', array(get_class(), 'defer_cf7assets'));
        \add_action('wp_ajax_nopriv_defer_cf7assets', array(get_class(), 'defer_cf7assets'));

    }

    public static function defer_cf7assets(){
        $scriptfile = \get_site_url() . '/wp-content/plugins/contact-form-7/includes/js/scripts.js';
        $stylefile = \get_site_url() . '/wp-content/plugins/contact-form-7/includes/css/styles.css';
        $payload = "<script src='{$scriptfile}'></script>";
        $payload .= "<link rel='stylesheet' type='text/css' href='{$stylefile}' />";
        echo json_encode(array('status'=>200, 'payload'=>$payload));
    }
    
    public static function add_spinner_class($html_class) {
        return $html_class . ' cf7-loading';    
    }

    public static function cf7_telephone_verification( $result, $tag ) {
        $number = $_POST['phone'];
        $valid_regex = "/^\\+?[1-9][0-9]{7,14}$/";
        if(!preg_match($valid_regex, $number)) {
            $result->invalidate( $tag, "Please enter a valid phone number" );
        }
    
        return $result;
    }
    
}
ContactForm7::run();