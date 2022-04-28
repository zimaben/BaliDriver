<?php
namespace <!PLUGINPATH->\core;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;
/*
 * The PostTypes class, like all core classes, extends the base class
 * and is run at instantiation. This registers the needed post types.
 * 
 *  example: 
 *  $register_post_type = new PostTypes('question', 'questions', array('show_in_menu' => 'assessment_admin.php'));
 */ 

class PostTypes extends Plugin{
    public function __construct($singular, $plural, $args = array() ){
        $this->labels = $this->set_labels($singular, $plural);
        $this->args = $this->merge_defaults($this->labels, $plural, $args);
        
        \register_post_type( strtolower($plural), $this->args );
    }
    private static function set_labels($singular, $plural){
        $labels = array(
            'name'               => _x( ucfirst($plural), 'post type general name', self::textdomain ),
            'singular_name'      => _x( ucfirst($singular), 'post type singular name', self::textdomain ),
            'menu_name'          => _x( ucfirst($plural), 'admin menu', self::textdomain ),
            'name_admin_bar'     => _x( ucfirst($plural), 'add new on admin bar', self::textdomain ),
            'add_new'            => _x( 'New', ucfirst($singular), self::textdomain ),
            'add_new_item'       => __( 'New ' . ucfirst($singular), self::textdomain ),
            'new_item'           => __( 'New ' . ucfirst($singular), self::textdomain ),
            'edit_item'          => __( 'Edit '. ucfirst($singular), self::textdomain ),
            'view_item'          => __( 'View '. ucfirst($singular), self::textdomain ),
            'all_items'          => __( ucfirst($plural), self::textdomain ),
            'search_items'       => __( 'Search '. ucfirst($plural), self::textdomain ),
            'not_found'          => __( 'No '.ucfirst($plural).' found.', self::textdomain ),
            'not_found_in_trash' => __( 'No '.ucfirst($plural).' found in Trash.', self::textdomain )
        );
        return $labels;
    }
    private static function merge_defaults( $labels, $plural, $args = array() ){
        
        $args = array(
            'labels'             => $labels,
            'description'        => (isset($args['description'])) ? $args['description'] : ucfirst($plural),
            'public'             => (isset($args['public'])) ? $args['public'] : true,
            'publicly_queryable' => (isset($args['publicly_queryable'])) ? $args['publicly_queryable'] : true,
            'show_ui'            => (isset($args['show_ui'])) ? $args['show_ui'] : true,
            'show_in_menu'       => (isset($args['show_in_menu'])) ? $args['show_in_menu'] : true,
            'query_var'          => (isset($args['query_var'])) ? $args['query_var'] : true,
            'rewrite'            => array( 'slug' => trim(strtolower($plural)) ),
            'capability_type'    => (isset($args['capability_type'])) ? $args['capability_type'] : 'post',
            'has_archive'        => (isset($args['has_archive'])) ? $args['has_archive'] : true,
            'hierarchical'       => (isset($args['hierarchical'])) ? $args['hierarchical'] : false,
            'show_in_menu'       => (isset($args['show_in_menu'])) ? $args['show_in_menu'] : true,
            'menu_icon'          => (isset($args['menu_icon'])) ? $args['menu_icon'] : 'dashicons-pressthis',
            'menu_position'      => (isset($args['menu_position'])) ? $args['menu_position'] : 5,
            'show_in_rest'       => (isset($args['show_in_rest'])) ? $args['show_in_rest'] : true,
            'rest_base'          => trim(strtolower($plural)),
            'rest_controller_class' => (isset($args['rest_controller_class'])) ? $args['rest_controller_class'] : 'WP_REST_Posts_Controller',
            'supports'           => (isset($args['supports'])) ? $args['supports'] : array( 'editor','title', 'custom-fields', 'page-attributes','thumbnail'),
            'taxonomies'         => (isset($args['taxonomies'])) ? $args['taxonomies'] : array()       
        );
        return $args;
    }
}
