<?php
namespace <!PLUGINPATH->\core;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;
use \<!PLUGINPATH->\Build as Build;
/*
 * The Build class, like all core classes, extends the base class
 * and is run at instantiation. This registers the needed build libraries.
 * 
 */ 

class Setup extends Plugin{

    public static function run(){

        \add_action( 'init', array(get_class(), 'run_onetime_setup'));

    }

    public static function add_pages(){
        #wrapper to keep the setup functions in the same place
        Build::add_pages();
    }

    public static function run_onetime_setup(){
        #do all one-time setup stuff
        self::add_pages();

        # adds setup tables
        #require_once self::get_plugin_path() . 'library/schema/create-tables.php';
    }

}
