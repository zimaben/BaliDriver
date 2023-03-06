<?php
namespace rbtddb\admin\setup;

use \rbtddb\Config as Config;

/**
 * Class PostTypes accepts ucfirst($plural), (optional) ucfirst($singular), (optional) $args.
 * Example: $postTypes = new PostTypes('posts', 'post', array('public' => true));
 * Example: $postTypes = new PostTypes('posts');
 * Example: $postTypes = new PostTypes('posts', array('public' => true));
 * 
 * You must call register_post_type() before the admin_init hook and after the after_setup_theme hook. A good hook to use is the init action hook.
 *
 *
 * @package TPT
 * @subpackage DDBali
 */
class Taxonomy {
    public function __construct( $plural, $singular, $args = null ){
        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name'              => _x( ucfirst($plural), 'taxonomy general name', Config::TEXTDOMAIN ),
            'singular_name'     => _x( ucfirst($singular), 'taxonomy singular name', Config::TEXTDOMAIN ),
            'search_items'      => __( 'Search ' . ucfirst($plural), Config::TEXTDOMAIN ),
            'all_items'         => __( 'All ' . ucfirst($plural), Config::TEXTDOMAIN ),
            'parent_item'       => __( 'Parent ' . ucfirst($singular), Config::TEXTDOMAIN ),
            'parent_item_colon' => __( 'Parent ' . ucfirst($singular) .':', Config::TEXTDOMAIN ),
            'edit_item'         => __( 'Edit ' . ucfirst($singular), Config::TEXTDOMAIN ),
            'update_item'       => __( 'Update '  . ucfirst($singular), Config::TEXTDOMAIN ),
            'add_new_item'      => __( 'Add New ' . ucfirst($singular), Config::TEXTDOMAIN ),
            'new_item_name'     => __( 'New '. ucfirst($singular).' Name', Config::TEXTDOMAIN ),
            'menu_name'         => __(  ucfirst($singular), Config::TEXTDOMAIN ),
        );
     
        $newargs = array(
            'hierarchical'      => isset($args['hierarchical']) ? $args['hierarchical'] : true,
            'labels'            => $labels,
            'show_ui'           => isset($args['show_ui']) ? $args['show_ui'] : true,
            'public'            => isset($args['public']) ? $args['public'] : true,
            'show_in_rest'      => true,
            'rest_base'         => $plural,
            'show_admin_column' => isset($args['show_admin_column']) ? $args['show_admin_column'] : true,
            'query_var'         => isset($args['query_var']) ? $args['query_var'] : true,
            'rewrite'           => array( 'slug' => $plural ),
        );

        $posttypes = isset($args['posttypes']) ? $args['posttypes'] : array();
     
        \register_taxonomy( $plural, $posttypes, $newargs );
    }
    
}