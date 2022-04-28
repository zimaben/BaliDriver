<?php
namespace <!-PLUGINPATH->\template;


class View extends \<!-PLUGINPATH->\<!-PLUGINNAME-> {
    private $file;
    private $args = array();

    public function __construct( $input, $file ) {//template only renders files in the templates filetree
        $this->args = is_array($input) ? $this->bring_array_params_into_self($input) : $this->bring_object_keys_into_self($input);
        $this->doesfileexist = $this->args ? $this->isfile( $file ) : false;
        $this->file = $this->doesfileexist ? self::get_plugin_path() . '/library/template/templates/'. $file : false;
    }
    public function __set( $key, $val) {
        $this->{$key} = $val;
    }
    public function __get( $key ){
         return (isset($this->{$key}) ) ? $this->{$key} : null;
    }
    private function isfile( $file ){
        return file_exists( self::get_plugin_path() . '/library/template/templates/'. $file );
    }
    private function bring_array_params_into_self($args){
        #magic methods are insurance policy
        foreach($args as $k => $v) {
            $this->{$k} = $v;
        }
        return $args;
    }
    private function bring_object_keys_into_self($object){
        
        if(!is_object($object)) return false;

        foreach( (array) $object as $k => $v){
            $this->{$k} = $v;
        }
        return array($object);
    }
    public function render(){
        //buff
        ob_start();
        //get template for view
        if( $this->doesfileexist ) include( $this->file );

        $output_str = ob_get_contents();
        ob_end_clean();
        return $output_str;
    }
      
}
