<?php
namespace <!PLUGINPATH->\core;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;
/*
 * The Build class, like all core classes, extends the base class
 * and is run at instantiation. This registers the needed build libraries.
 * 
 */ 

class Build extends Plugin{

    public static function run(){

        //Utility libraries for setup & config
        require_once self::get_plugin_path( 'library/core/pages.php' );
        require_once self::get_plugin_path( 'library/core/taxonomies.php' );
        require_once self::get_plugin_path( 'library/core/post-types.php' );

        \add_action( 'init', array(get_class(), 'run_plugin_setup'));

        #Random php housekeeping functions
        \add_filter( 'upload_mimes', array(get_class(), 'add_svg_support'), 50 );
        \add_filter( 'admin_email_check_interval', '__return_false' );
    }

    public static function add_pages(){
        /*
        A function like this would run statically but only be called
        under certain circumstances like first plugin run - not every reequest load

        example:

        $mypage = new PluginPage( 'slug', 'My Beautiful New Page', 'my_custom_post_type' );
        $mypage->set_taxonomy('mytaxonomy',array( 'parent', 'child' ), true );
        $mypage->set_featured_image( 'theme/assets/' . $myimage . '.jpeg');
        $mypage->set_content('<div>Hi Mom</div>');
        
        */

    }

    public static function run_plugin_setup(){
        /* 
        This function will always be run at each request and registers post types and taxonomies
        */

        #Make Post Type
        /*
        $questions = new PostTypes('question', 'questions', array('show_in_menu'=>'edit.php?post_type=questions'));

        #Make Taxonomy
        $states = new Taxonomy('states', 'US States', array('show_in_rest'=> 0 ) );

        */
    }

    public static function add_svg_support( $mimes ) {
        $mimes['svg'] = isset($mimes['svg']) ? $mimes['svg'] : 'image/svg+xml';
        $mimes['svgz'] = isset($mimes['svgz']) ? $mimes['svgz'] : 'image/svg+xml';
        return $mimes;
    }



}
<!PLUGINPATH->\core\Build::run();