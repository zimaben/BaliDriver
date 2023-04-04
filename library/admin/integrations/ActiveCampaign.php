<?php

namespace rbtddb\admin;
use rbtddb\Config as Config;

Class ActiveCampaignIntegration {

	public $err = false;
    public $baseURL = false;
    public $data = false;
    public $ready = false;
    private $accepted_methods = array('new_contact' => 'post');
    
	public function __construct(  $method, $args = array() ){
        $this->method = $this->checkMethod( $method );
        $this->apiKey = $this->getApiKey();
        if($this->apiKey) $this->setHeaders();
        $this->baseURL = $this->getBaseURL();
		$this->args = $this->checkArgs($args);


	}
    private function checkMethod( $method ){
        if(!isset($this->accepted_methods[$method])){
            $this->err = 'Invalid method';
            return false;
        } else {
            if($this->err === 'Invalid method') $this->err = false;
            return $method;
        }

    }
    private function isReady(){
        if($this->method &&
           $this->apiKey &&
           $this->header &&
           $this->baseURL){
            $this->ready = 1; 
           } else {
            $this->ready = 0;
           }
    }
    public function doRequest(){
        if($this->ready){
            switch($this->accepted_methods[$this->method]){
                case "post":
                    $resource = false;
                    if($this->method === 'new_contact'){
                        $resource = "contacts";
                        #can do more as needed
                    }
                    $this->post( $resource );
                    break;
                default :
                    #@todo
                   
                    break;

            }
        } else {
            $this->data = "Request not ready";
        }
        
    }
    private function getApiKey(){
        $key = \carbon_get_theme_option('ac_api_key');
        if(!$key){
            $key = \get_option('_ac_api_key');
        }
        if(!$key){
            $this->err = "API Key not set";
            return false;
        } else {
            if($this->err === "API Key not set") $this->err = false;
            return $key;
        }
        
    }
    private function getBaseURL(){
        $account_name = \carbon_get_theme_option('ac_account_name');
        if(!$account_name){
            $account_name = \get_option('_ac_account_name');
        }
        if(!$account_name){
            $this->err = "Account Name not set";
            return false;
        } else {
            if($this->err === "Account Name not set") $this->err = false;
            return 'https://'.$account_name.'.api-us1.com/api/3/';
        }    
    }
    private function setHeaders(){
        $this->createProp('header', array('Api-Token: ' . $this->apiKey));
        $this->header[] = 'Content-Type: application/json';
        $this->header[] = 'Accept: application/json';

    }
	private function createProp($prop, $value){
        #only creates - doesn't overwrite
        if(!property_exists($this, $prop)) $this->{$prop} = $value;     
    }
    private function addProp($prop, $value){
        if(property_exists($this, $prop)){
            if(is_array($this->{$prop})){
                $this->{$prop}[] = $value;
            } else {
                $this->{$prop} = array($this->{$prop});
                $this->{$prop}[] = $value;
            }
        } else {
            $this->{$prop} = $value;  
        }
    }
    private function updateProp($prop, $value){
        $this->{$prop} = $value;  
    }
    private function post( $resource ){
        $payload = json_encode($this->args);
        $curl = curl_init();
        $authenticate = 
        curl_setopt_array($curl, array(
            CURLOPT_URL=> $this->baseURL . $resource,
            CURLOPT_HTTPHEADER => $this->header,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $payload
        ));
        $response = curl_exec($curl);
        #if(Config::MODE === "development")  error_log(print_r($response, true));
        curl_close($curl);
        $response_array = json_decode($response, true);
       
       $this->data = $response_array;

    }
	public function checkArgs( $args ){
        #maybe convert dashes and underscores to camel case
        $this->isReady();
        return $args;
	}
}