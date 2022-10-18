<?php
namespace <!PLUGINPATH->\api;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Theme;
use \<!PLUGINPATH->\Config as Config;

class Endpoints extends Theme {

    public static function run(){

        \add_action( 'rest_api_init', array(get_class(), 'plugin_endpoints'));

    }

    public static function plugin_endpoints(){
        $register_check = \register_rest_route( '<!PLUGINPATH->/v2', '/our-method/', array(
            'methods'=> 'GET',
            'callback'=> '\<!PLUGINPATH->\api\Methods::our_method',
            'permission_callback'=>'\<!PLUGINPATH->\api\Methods::checkPermission',
        ));
        if(!$register_check && Config::MODE === 'development' ) {
    
            error_log('Could not register Our Method Endpoint');
        }
    }
     
}
//spin it
\<!PLUGINPATH->\api\Endpoints::run();