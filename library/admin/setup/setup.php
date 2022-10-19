<?php
namespace <!PLUGINPATH->\admin;
use \<!PLUGINPATH->\<!PLUGINNAME-> as Theme;
use \<!PLUGINPATH->\admin\setup\PostTypes as PostTypes;
use \<!PLUGINPATH->\admin\setup\Page as Page;
use \<!PLUGINPATH->\admin\setup\Taxonomy as Taxonomy;
use \<!PLUGINPATH->\Config as Config;

/**
 * The setup file does two things. Class Setup runs on every page load and 
 *  it does the page setup, including:
 *  - Setting up the admin menus (if an admin view)
 *  - Register Post Types
 *  - Register Taxonomies
 *  - Fire the Register Scripts/Blocks files
 *  - Set page templates
 * 
 *  The file also has static functions for running one-time setup actions like checking for and
 *  creating theme tables, adding required pages, or adding creating critical inline CSS for 
 *  new site pages.
 * 
 * @package TPT
 * @subpackage <!PLUGINNAME->
 */
class Setup extends Theme {

    public static function run(){
        \add_action('after_setup_theme', array(get_class(), 'theme_setup'));

        \add_action('init', array(get_class(), 'register_taxonomies'));
        \add_action('init', array(get_class(), 'register_post_types'));
        \add_action('after_setup_theme', array(get_class(), 'register_menus'));

        #WP AJAX FOR SETUP WORK NOT DONE ON EACH PAGE LOAD
        \add_action('wp_ajax_run_setup', array(get_class(), 'run_setup'));
    }
    public static function theme_setup(){

        # \add_theme_support( 'custom-header' );
        \add_theme_support( 'menus' );
        # do dimensions
        \add_theme_support( 'custom-logo' );
        \add_theme_support( 'post-thumbnails' );
        \add_theme_support( 'title_tag');
        \add_theme_support( 'html5', array(
            // Any or all of these.
            # 'comment-list', 
            # 'comment-form',
            'search-form',
            'gallery',
            'caption',
        ) );
        \add_post_type_support( 'locations', 'excerpt' );
         
    }

    public static function register_menus(){

       if(is_array(Config::MENUS)){
            foreach(Config::MENUS as $menu => $props){
                \register_nav_menu($menu, __($props['name'], Config::TEXTDOMAIN));
            }
       }
    }
    public static function run_setup(){
        /* The standard one-time setup routine. This creates pages, adds user roles, 
         * databases, updates meta information...basically anything we need to do 
         * that should not be done on every page load.
         */

        if(!isset($_POST['nonce']) || false === \wp_verify_nonce($_POST['nonce'], 'theme-admin')){
            echo json_encode(array('status' => 400, 'message'=>'Missing or Invalid nonce'));
            die();
        }
       # self::add_pages();
        self::add_new_pages(); //self::add_pages() will force create duplicate pages if a page already exists for that slug
        self::create_menus();
        self::create_roles();
        

       # Config::add_critical_inline_css();
        echo json_encode(array(
            'status' => 200,
            'message' => 'Setup Complete: Added pages, created menus, created roles.'
        ));
        die();
    }
    public static function register_post_types(){
        if(Config::POST_TYPES && is_array(Config::POST_TYPES )) : 
            foreach(Config::POST_TYPES as $name => $props){
                $plural = $name;
                $singular = isset($props['singular']) ? $props['singular'] : $name;
                $args = isset($props['args']) ? $props['args'] : array();

                new PostTypes($plural, $singular, $args);
            }
        endif;
    }
    public static function register_taxonomies(){
        if(Config::TAXONOMIES && is_array(Config::TAXONOMIES)) : 
            foreach(Config::TAXONOMIES as $name => $props){
                $plural = $name;
                $singular = isset($props['singular']) ? $props['singular'] : $name;
                $args = isset($props['args']) ? $props['args'] : array();
                new Taxonomy($plural, $singular, $args);
            }
        endif;
    }
    public static function add_pages(){
        if(Config::PAGES){
            foreach(Config::PAGES as $slug => $args){
                $page = new Page($slug, $args);
            }
        }
    }
    public static function add_new_pages(){
        if(Config::PAGES){
            foreach(Config::PAGES as $slug => $args){
                $args['force_create'] = false;
                $page = new Page($slug, $args);
            }
        }
    }
    public static function add_critical_inline_css(){
        $theme_root = \get_stylesheet_directory();
        if(file_exists($theme_root.'/critical.css')){
            $css = file_get_contents($theme_root.'/critical.css');
            \add_action('wp_head', function() use ($css){
                echo '<style>'.$css.'</style>';
            });
        }
        $output = shell_exec('ls -lart');
        echo "<pre>$output</pre>";

    }
    public static function create_roles(){
        if( Config::ROLES && is_array(Config::ROLES) ) {
            foreach(Config::ROLES as $role => $caps){
                $slug = strtolower( \sanitize_title($role) );
                $role = \get_role($slug);
                if(!$role){
                    $role = \add_role($slug, $role, $caps);
                    if(isset($caps['setdefault']) && $caps['setdefault'] === true){
                        \update_option('default_role','client');
                    }
                }
            }
        }
    }
    public static function create_menus(){
        if(Config::MENUS && is_array(Config::MENUS)) :

        foreach(Config::MENUS as $menu=> $props){
            $locations = \get_theme_mod('nav_menu_locations');
            // Does the menu exist already?
            $menu_exists = \wp_get_nav_menu_object( $props['name'] );
            // If it doesn't exist, let's create it.
            if ( !$menu_exists ) {
                $menu_id = \wp_create_nav_menu($props['name']);
                if(!empty(Config::PAGES)){
                    foreach(Config::PAGES as $slug => $args){
                        if(isset($args['menu']) && $args['menu'] == $props['location'] ){
                 
                            $page_object = \get_page_by_path($slug);
                            \wp_update_nav_menu_item($menu_id, 0, array(
                                'menu-item-title' => $args['title'],
                                'menu-item-object' => 'page',
                                'menu-item-object-id' => $page_object->ID,
                                'menu-item-url' => \get_permalink($page_object->ID),
                                'menu-item-type' => isset($args['type']) ? $args['type'] : 'page',
                                'menu-item-status' => 'publish'
                            ));
                        }
                    }
                } else {
                    // Set up example menu items with pages WP ships with
                    \wp_update_nav_menu_item( $menu_id, 0, array(
                        'menu-item-title'   =>  __( 'Home', Theme::TEXTDOMAIN ),
                        'menu-item-classes' => 'home',
                        'menu-item-url'     => home_url( '/' ), 
                        'menu-item-status'  => 'publish'
                    ) );
                
                    wp_update_nav_menu_item( $menu_id, 0, array(
                        'menu-item-title'  =>  __( 'Sample Page', Theme::TEXTDOMAIN ),
                        'menu-item-url'    => home_url( '/sample-page/' ), 
                        'menu-item-status' => 'publish'
                    ) );
                }
                 
                if(isset($props['location']) && $props['location'] ) {
                    $location_name = $props['location'];
                    $locations[$location_name] = $menu_id;
                    \set_theme_mod('nav_menu_locations', $locations);
                }
            }

        }

        endif;
    }

   

}
Setup::run();