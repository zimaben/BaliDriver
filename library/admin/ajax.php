<?php
namespace <!PLUGINPATH->\ajax;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Theme;

class Ajax extends Theme {

    public static function run(){

        \add_action( 'wp_ajax_ourAjaxFunction', array(get_class(), 'ourAjaxFunction'));
        \add_action( 'wp_ajax_nopriv_ourAjaxFunction', array(get_class(), 'ourAjaxFunction'));
        if(\is_admin()){
            \add_action( 'admin_enqueue_scripts', array(get_class(), 'admin_localize'), 99);
        } else {
            \add_action( 'wp_enqueue_scripts', array(get_class(), 'theme_localize'), 99);
        }

      

    }
    public static function admin_localize(){
        #Localize Admin 
        \wp_localize_script( 'theme-admin-js', 'theme_admin', array(
            'nonce' => \wp_create_nonce('theme-admin'),
            'ajaxurl' => \admin_url('admin-ajax.php'),
            'theme_root' => \get_template_directory_uri(),
        ));
    }
    public static function theme_localize(){ 
        #Localize frontend
        \wp_localize_script( 'sitehead', 'theme_vars', array(
            'nonce' => \wp_create_nonce('theme_vars'),
            'ajaxurl' => \admin_url('admin-ajax.php'),
            'postid'  => \get_the_ID(),
            'userid'  => \get_current_user_id(),
            'theme_root' => \get_template_directory_uri(),
        ));
        
    }
    public static function ourAjaxFunction(){
        #GET and POST requests can be directly accessed
        $nonce = isset($_GET['nonce']) ? \sanitize_text_field($_GET['nonce']) : false;

        #this correlates to your Localize Script Nonce that provides Admin Ajax Url
        $check_nonce = \wp_verify_nonce($nonce, 'Ajax_Request');

        /* Do something Here */

        echo json_encode(array('status'=>200, 'response'=>'the result', 'payload'=>'the payload'));
        
        /* Ajax requests must die - wp_die(); is a broken function that will corrupt JSON response
         * if triggered */
        die();


    }
     
}
//spin it
\<!PLUGINPATH->\ajax\Ajax::run();
