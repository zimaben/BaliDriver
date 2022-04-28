<?php
namespace <!PLUGINPATH->\ajax;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;

class Ajax extends Plugin {

    public static function run(){

        \add_action( 'wp_ajax_ourAjaxFunction', array(get_class(), 'ourAjaxFunction'));
        \add_action( 'wp_ajax_nopriv_ourAjaxFunction', array(get_class(), 'ourAjaxFunction'));

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
