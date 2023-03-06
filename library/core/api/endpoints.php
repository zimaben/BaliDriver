<?php
namespace rbtddb\api;

use \rbtddb\DDBali as Theme;
use \rbtddb\Config as Config;

class Endpoints extends Theme {

    public static function run(){

        \add_action( 'rest_api_init', array(get_class(), 'plugin_endpoints'));

    }

    public static function plugin_endpoints(){
        $register_check = \register_rest_route( 'rbt/v2', '/our-method/', array(
            'methods'=> 'GET',
            'callback'=> '\rbtddb\api\Methods::our_method',
            'permission_callback'=>'\rbtddb\api\Methods::checkPermission',
        ));
        if(!$register_check && Config::MODE === 'development' ) {
    
            error_log('Could not register Our Method Endpoint');
        }
    }
     
}
//spin it
\rbtddb\api\Endpoints::run();