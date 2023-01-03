<?php
namespace rbt\admin\setup;
use \rbt\Config as Config;

/**
 * Class PostTypes accepts $plural, (optional) $singular, (optional) $args.
 * Example: $postTypes = new PostTypes('posts', 'post', array('public' => true));
 * Example: $postTypes = new PostTypes('posts');
 * Example: $postTypes = new PostTypes('posts', array('public' => true));
 * 
 * You must call register_post_type() before the admin_init hook and after the after_setup_theme hook. A good hook to use is the init action hook.
 *
 *
 * @package TPT
 * @subpackage FRStarter
 */
class PostType {
    public static function add_posttype( $plural, $singular, $args = null ){

        $labels = array(
            'name'               => _x( ucfirst($plural), 'post type general name', Config::TEXTDOMAIN ),
            'singular_name'      => _x( ucfirst($singular), 'post type singular name', Config::TEXTDOMAIN ),
            'menu_name'          => _x( ucfirst($plural), 'admin menu', Config::TEXTDOMAIN ),
            'name_admin_bar'     => _x( ucfirst($plural), 'add new on admin bar', Config::TEXTDOMAIN ),
            'add_new'            => _x( 'New', ucfirst($singular), Config::TEXTDOMAIN ),
            'add_new_item'       => __( 'New ' . ucfirst($singular), Config::TEXTDOMAIN ),
            'new_item'           => __( 'New ' . ucfirst($singular), Config::TEXTDOMAIN ),
            'edit_item'          => __( 'Edit '. ucfirst($singular), Config::TEXTDOMAIN ),
            'view_item'          => __( 'View '. ucfirst($singular), Config::TEXTDOMAIN ),
            'all_items'          => __( 'All ' . ucfirst($plural), Config::TEXTDOMAIN ),
            'search_items'       => __( 'Search '. ucfirst($plural), Config::TEXTDOMAIN ),
            'not_found'          => __( 'No '.ucfirst($plural).' found.', Config::TEXTDOMAIN ),
            'not_found_in_trash' => __( 'No '.ucfirst($plural).' found in Trash.', Config::TEXTDOMAIN )
        );
        
        $default = array(
            'labels'             => $labels,
            'description'        => __( ucfirst($plural), Config::TEXTDOMAIN ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => trim(strtolower($plural)) ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => isset($args['hierarchical']) ? $args['hierarchical'] : false,
            'show_in_menu'       => true,
            'menu_icon'          => isset($args['menu_icon']) ? $args['menu_icon'] : 'dashicons-pressthis',
            'menu_position'      => 5,
            'show_in_rest'       => true,
            'rest_base'          => trim(strtolower($plural)),
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'supports'           => array( 'editor','title', 'custom-fields', 'page-attributes','thumbnail', 'excerpt'),
            'taxonomies'         => isset($args['taxonomies']) ? $args['taxonomies'] : array()       
        );
        if(is_array($args)){
            #merge the defaults
            $default = array_merge($default, $args);
        }
    
        \register_post_type( $plural, $default );
    }
}
class PostTypes {
    public function __construct($plural, $singular = '', $args = array() ) {
        $this->plural = $this->checkname($plural);
        #if the object arguments are out of order
        if(is_array($singular) && empty($args)) {$args = $singular; $singular = '';}
        $this->singular = strlen($singular) ? $this->checkname($singular) : $this->getSingular($this->plural);
        if($this->plural && $this->singular) {
           PostType::add_posttype($this->plural, $this->singular, $args);
        }    
    }
    
    private function checkname($name){
        $cased = str_replace(' ', '-', strtolower($name));
        $scrub_invalid_characters = preg_replace("/[^A-Za-z_\- ]/", '', $cased);
        return strlen($scrub_invalid_characters) ? $scrub_invalid_characters : false;
    }
    private function getSingular($plural){
        if( substr($plural, -1) == 's' ){
            return substr($plural, 0, -1);
        }
        return strlen($plural) ? $plural : false;
    }
}