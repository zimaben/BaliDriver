<?php
namespace <!PLUGINPATH->\api;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;
use \<!PLUGINPATH->\template\View as View;

class Methods extends Plugin{
    /* 
     * Modules: Each endpoint method by method name key and
     * an array of capabilities (or one single string capability) 
     * for the permissions callback.
     * 
     * If the method is public the name key value will be set 
     * to "public"
     */
    public static $supported_methods = array(
        'our_method'=> 'public', 
        'admin-method'=> 'activate_plugins',
    );

    public static function our_method( \WP_REST_Request $request){

        #request is checked for valid structure and permission before it reaches method
       # $url_components = parse_url($request);
        $route = $request->get_route();
        $params = $request->get_params();

        if(!$params || !isset($params) || empty($params)) $params = array();

        #get info
        $params['post_type'] = 'post';
        $params['post_status'] = 'publish';
        if(!isset($params['posts_per_page'])) $params['posts_per_page'] = -1;

        #taxonomy shorthand
        if(isset($params['categories'])){
            
            if(is_array($params['categories'])) $params['categories'] = trim(implode( ',', $params['categories']  ));     
            
        }
    
        $q = new \WP_Query( $params ); 
        if($q->have_posts() ){
            $template = new View( $q, 'filename.php');
        }
        \wp_reset_postdata();
        if($template){
            return new \WP_REST_Response(
                array(
                    'status'=>200,
                    'response' => 'Success',
                    'body_response' => $template->render(),
                )
            );
        } else {
            return new \WP_Error(400, 'Could not load request', '<p class="error">Could not load request.</p>');
        }

    }
    
    private static function mime_from_filename($filename){
        $exploded = explode('.', $filename);
        $ext = array_pop( $exploded );
        $legend = array(
            'mid' => 'audio/midi',
            'midi' => 'audio/midi',
            'mpga' => 'audio/mpeg',
            'mp2' => 'audio/mpeg',
            'mp3' => array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
            'aif' => 'audio/x-aiff',
            'aiff' => 'audio/x-aiff',
            'aifc' => 'audio/x-aiff',
            'ram' => 'audio/x-pn-realaudio',
            'rm' => 'audio/x-pn-realaudio',
            'rpm' => 'audio/x-pn-realaudio-plugin',
            'ra' => 'audio/x-realaudio',
            'rv' => 'video/vnd.rn-realvideo',
            'wav' => array('audio/x-wav', 'audio/wave', 'audio/wav'),
            'mpeg' => 'video/mpeg',
            'mpg' => 'video/mpeg',
            'mpe' => 'video/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            'avi' => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie',
            'mp4' => 'video/mp4',
            'm3u8' => 'application/x-mpegURL',
            'wmv' => 'video/x-ms-wmv'
        );
        return isset($legend[$ext]) ? $legend[$ext] : false;
    }
       
    /* 
     * Generic check permissions callback
     */
    public static function checkPermission( $request ){

        if( Theme::mode === "development" ){
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
        } else {
            $protocol = 'https://';
        }

        $url_no_params = ( strpos($_SERVER["REQUEST_URI"], '?') === false ) ? $_SERVER['REQUEST_URI'] : strtok($_SERVER["REQUEST_URI"], '?');

        $url = $protocol . $_SERVER['HTTP_HOST'] . '/' . $url_no_params;

        #malformed request URL
        if(filter_var($url, FILTER_VALIDATE_URL) === false) return false;

        $method = self::get_method( $url );

        $postid = self::get_postid( $url );

        #request not valid
        if(!$method) return false;

        #request not recognized
        $recognized_request = array_key_exists($method, self::$supported_methods);
        if(!$recognized_request) return false;

        $method_capabilities = self::$supported_methods[$method];

        #nonpublic - request must be logged in
        if($method_capabilities !== "public"){
            $user = \wp_get_current_user();
            if(is_array($method_capabilities)){
                
                $match = array_intersect( $method_capabilities, $user->allcaps );
                if(!is_countable($match)) return false;
                if(count($match) < 1 ) return false;

            } else {
                #only one matching capability unlocks this method
                if(!in_array($method_capabilities, $user->allcaps)) return false;
            }

            #non-public method referencing post_id - does logged in user have permission to read this post?
            if($postid){
                if( !current_user_can( 'read', $postid )) return false;
            }
        }
        return true;
    }
    private static function get_method( string $requested_url ){

        #remove trailing slash
        if( substr($requested_url, strlen($requested_url) - 1)  === '/' ){

            $requested_url = substr($requested_url, 0, strlen($requested_url) - 1 );
        } 
        
        #malformed request string
        if(strpos($requested_url, '/') === false ) return false;

        $url_array = array_reverse( explode( '/', $requested_url) );

        #malformed request string
        if(!isset($url_array[0]) || !isset($url_array[1]) ) return false;

        return is_integer($url_array[0]) ? $url_array[1] : $url_array[0];

    }
    private static function get_postid( string $requested_url ){
        
        #remove trailing slash
        if( substr($requested_url, strlen($requested_url) - 1)  === '/' ){

            $requested_url = substr($requested_url, 0, strlen($requested_url) - 1 );
        } 

        #malformed request string
        if(strpos($requested_url, '/') === false ) return false;

        $url_array = array_reverse( explode( '/', $requested_url) );

        #malformed request string
        if(!isset($url_array[0]) || !isset($url_array[1]) ) return false;

        return is_integer($url_array[0]) ? $url_array[0] : false;

    }
    public static function get_ip() {

        if( !empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
         
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        
        } elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        
        } else {
        
            $ip = $_SERVER['REMOTE_ADDR'];
        
        }
    return $ip;
    }

}