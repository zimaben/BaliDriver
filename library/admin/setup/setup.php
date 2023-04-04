<?php
namespace rbtddb\admin;
use \rbtddb\DDBali as Theme;
use \rbtddb\admin\setup\PostTypes as PostTypes;
use \rbtddb\admin\setup\Page as Page;
use \rbtddb\admin\setup\Taxonomy as Taxonomy;
use \rbtddb\Config as Config;

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
 * @subpackage DDBali
 */
class Setup extends Theme {

    public static function run(){
        \add_action('after_setup_theme', array(get_class(), 'theme_setup'), 99);

        \add_action('init', array(get_class(), 'register_taxonomies'));
        \add_action('init', array(get_class(), 'register_post_types'));
        \add_action('after_setup_theme', array(get_class(), 'register_menus'));

        #WP AJAX FOR SETUP WORK NOT DONE ON EACH PAGE LOAD
        \add_action('wp_ajax_run_setup', array(get_class(), 'run_setup'));
        \add_action('wp_ajax_run_critical_css', array(get_class(), 'run_critical_css'));
    }
    public static function theme_setup(){
        # \add_theme_support( 'custom-header' );
        if(isset(Config::INTEGRATIONS['WooCommerce']) && Config::INTEGRATIONS['WooCommerce']) :
            \add_theme_support('woocommerce');
        endif;
        \add_theme_support( 'menus' );
        \add_theme_support( 'align-wide' );
        # do dimensions
        \add_theme_support( 'custom-logo' );
        \add_theme_support( 'post-thumbnails' );
        \add_theme_support( 'title_tag');
        \add_theme_support( 'wp-block-styles' );

        \add_theme_support( 'responsive-embeds' );
        \add_theme_support( 'html5', array(
            // Any or all of these.
            # 'comment-list', 
            # 'comment-form',
            'search-form',
            'gallery',
            'caption',
        ) );
         
    }

    public static function register_menus(){

       if(is_array(Config::MENUS)){
            foreach(Config::MENUS as $menu => $props){
                \register_nav_menu($menu, __($props['name'], Config::TEXTDOMAIN));
            }
       }
    }
    public static function set_up_home_page( $archetype = null){ 
        $HomeContentString = '<!-- wp:latest-posts {"postsToShow":3,"displayPostContent":true,"excerptLength":30,"displayPostDate":true,"postLayout":"grid","displayFeaturedImage":true,"featuredImageSizeSlug":"large","align":"wide","className":"tw-mt-8 tw-img-ratio-3-2 tw-stretched-link is-style-default"} /-->';
        $HomePageContent = \do_blocks($HomeContentString);
        #add the new page if it doesn't already exist
        $HomePage = new Page( 'home', array('title'=>'Home', 'type'=>'page', 'content'=>$HomePageContent ));
        #set the new page to home page;
        $HomePage->setToHomePage();
        #return the home page ID or false;
        return $HomePage->ID;
    }
    private static function set_critical_css(){
        $string = file_get_contents( get_template_directory() . '/theme/dist/critical.css');
        $replacement_array = explode("../../theme/", $string);
        $filestring = '<style type="text/css" id="inlinecss">';
        #replace webpack-abbreviated image paths with correct absolute paths
        for($i=0;$i < count($replacement_array); $i++){
            $chunk = $replacement_array[$i];
            if(isset($replacement_array[$i + 1])){
                $chunk.= \get_template_directory_uri() . '/theme/';
            }
            $filestring.=$chunk;

        }

        $filestring.='</style>';
        return file_put_contents( get_template_directory() . '/theme/template-parts/static/critical-css.php', $filestring);
    }
    public static function run_critical_css(){
        if(!isset($_POST['nonce']) || false === \wp_verify_nonce($_POST['nonce'], 'theme-admin')){
            echo json_encode(array('status' => 400, 'message'=>'Missing or Invalid nonce'));
            die();
        }
        //do critical CSS above
        if( self::set_critical_css() ) {
            echo json_encode(array('status' => 200, 'message'=>'Updated Critical CSS'));
            die();
        } else {
            echo json_encode(array('status' => 500, 'message'=>'Something went wrong writing the file'));
            die();
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
                        if(isset($args['menu']) ){
                            if(is_array($args['menu'])){
                                $check = in_array($props['location'], $args['menu']);
                            } else {
                                $check = ($args['menu'] == $props['location']);
                            }
                            if($check) {
                                $page_object = \get_page_by_path($slug);
                                
                                $menu_args = array(
                                    'menu-item-title' => $args['title'],
                                    'menu-item-type' => 'post_type',
                                    'menu-item-object-id' => $page_object->ID,
                                    'menu-item-object' => $page_object->post_type,
                                    'menu-item-url' => \get_permalink($page_object->ID),     
                                    'menu-item-status' => 'publish'
                                );

                                
                                \wp_update_nav_menu_item($menu_id, 0, $menu_args );
                            }
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
                        'menu-item-status' => 'publish',
                        'menu-item-type' => 'page',
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