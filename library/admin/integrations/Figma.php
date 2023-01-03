<?php
namespace rbt\admin;
use rbt\Config as Config;

class FigmaRequest{
    /* This class sends a Request to a Figma document
     Accepted Parameters: $request == string, $method == string
     Use: The first parameter takes a supported request, or if the request 
     is not found appends the request as a URL string to the base API URL
     and attempts the request using the optional second method parameter.

     If the request isn't supported and the method isn't provided an error will 
     be thrown. If the request is supported the method parameter will be 
     ignored in favor of the supported method.
     */
    public $err = false;
    public $response = false;
    public $supported_requests = array(
        'test' => array('string'=> 'me', 'method'=> 'GET'),
        'get_logo' => array('string'=>'files')
    );
    public function __construct($request, $method = null){
        $this->connection = new FigmaConnection();
        if($this->connection->err) $this->err = $this->connection->err;
        $this->response = $this->err ? false : $this->doRequest($request, $method);
        error_log(print_r($this,true));

    }
    private function doRequest($request, $method){
        #if supported request
        if(isset($this->supported_requests[$request])){
            $this->connection->setMethod( $this->supported_requests[$request]['method']);
            $this->connection->setRequest($this->supported_requests[$request]['string']);
            if($this->connection->err){
                $this->err = $this->connection->err;
                return false;
            }
            $sent = $this->connection->doRequest();
            if($sent) return $this->connection->response;
            #for some reason we didn't send and 
            #no error was caught
            error_log(print_r($this, true));
            $this->err = 'Something went wrong with the request';
            return false;
        } else {
            #unsupported request
            if(!$method) {
                $this->err = 'Unsupported requests require a method parameter';
                return false;
            }
            $this->connection->setMethod($method);
            if($this->connection->err){
                $this->err = $this->connection->err;
                return false;
            }
            $this->connection->setRequest($request);
            if($this->connection->err){
                $this->err = $this->connection->err;
                return false;
            }
            $sent = $this->connection->doRequest();
            if($sent) return $this->connection->response;
            #for some reason we didn't send and 
            #no error was caught
            error_log(print_r($this, true));
            $this->err = 'Something went wrong with the unsupported request';
            return false;
        }
    } 
}

class FigmaConnection {

    public $err = false;
    public $ready = false;
    private $base = 'https://api.figma.com/v1/';
    private $accepted_methods = array( 'GET', 'POST' );
    public $method = false;
    public $request = false;
    public $response = false;
    public function __construct(){
        $this->apikey = $this->getAPIKey();
        $this->file = $this->getFileID();
        $this->headers = $this->getHeaders();
    }

    public function setRequest( $request = null){
        if(!$request){
            $this->err = 'request: setRequest called without a valid request';
            $this->checkReady();
            return false;
        }
        if($this->err){
            if(substr($this->err, 0, 7) == 'request') $this->err = false;
        }
        $this->request = $request;
        $this->checkReady();
        return true;
    }
    public function setMethod( $method = null){
        if(!$method){
            $this->method = false;
            $this->err = 'method: setMethod called without valid method';
            $this->checkReady();
            return false;
        }
        if( ! in_array(strtoupper($method), $this->accepted_methods) ){
            $this->method = false;
            $this->err = 'method: the method ' . $method . ' is not supported';
            $this->checkReady();
            return false;
        }
        if($this->err){
            if(substr($this->err, 0, 6) == 'method') $this->err = false;
        }
        $this->method = strtoupper($method);
        $this->checkReady();
        return true;
    }

    public function doRequest(){

        if(!$this->ready) return false;

        $url = $this->base . $this->request;error_log("URL: " . $url);
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers); 
        if($this->method === "POST") curl_setopt($ch, CURLOPT_POST, 1);
        $this->response = curl_exec($curl);
        curl_close($curl);
        return true;
    }

    private function checkReady(){
        $this->ready = (
            $this->err === false && 
            $this->method !== false &&
            $this->apikey &&
            $this->file &&
            $this->headers
        ) ? true : false;
    }
    private function getAPIKey(){
        $key = \carbon_get_theme_option( 'figma_api_key' );
        if($key) return $key;
        #carbon fields not loaded for some reason
        return \get_option( '_figma_api_key' );
    }
    private function getFileID(){
        if($this->err) return false;

        $file = \carbon_get_theme_option( 'figma_design_id' );
        if($file) return $file;
        #carbon fields not loaded for some reason
        $no_carbon_file = \get_option( '_figma_design_id' );
        if($no_carbon_file){
            return $no_carbon_file;
        } else {
            $this->err = 'api: Missing Figma filestring';
            return false;
        }
    }
    private function getHeaders(){
        if($this->apikey){
            return [ 'X-Figma-Token: '. $this->apikey, 'Accept: */*' ];
        } else {
            $this->err = 'api: Missing API key';
            return false;
        }

    }
}