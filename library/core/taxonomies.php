<?php
namespace <!PLUGINPATH->\core;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;
/*
 * The Taxonomy class, like all core classes, extends the base class
 * and is run at instantiation. This registers the needed taxonomies.
 * 
 */ 

class Taxonomy extends Plugin{
    public function __construct( $singular = null, $plural = null, $args = array() ){
        $this->args = $args;
        $this->ready = $this->checkparams($singular, $plural, $args);
        $this->id = $this->ready ? $this->add_plugin_taxonomy($slug, $name, $args) : false;
    }
    public static function add_plugin_taxonomy( $singular, $plural, $args ) {
        $nicesingular = ucwords(str_replace('_', ' ', $singular));
        $niceplural = ucwords(str_replace('_', ' ', $plural));
        $content_types = ( isset($args['content_types']) && is_array($args['content_types'])) ? $args['content_types'] : array();
        \register_taxonomy( $plural, $content_types, array(
        'hierarchical' => isset($args['hierarchical']) ? $args['hierarchical'] : false,
        'labels' => array(
            'name' => _x( ucwords($plural), 'taxonomy general name' ),
            'singular_name' => _x( $nicesingular, 'taxonomy singular name' ),
            'search_items' =>  __( 'Search ' . $niceplural ),
            'all_items' => __( 'All ' . $niceplural ),
            'edit_item' => __( 'Edit '. $nicesingular ),
            'update_item' => __( 'Update '. $nicesingular),
            'add_new_item' => __( 'Add New '. $nicesingular ),
            'new_item_name' => __( 'New '. $nicesingular ),
            'menu_name' => __( $niceplural ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => $plural, // This controls the base slug that will display before each term
            'with_front' => false,
            'hierarchical' => false
            
        ),
        'show_in_rest' => isset($args['show_in_rest']) ? $args['show_in_rest'] : true,
        'query_var' => isset($args['query_var']) ? $args['query_var'] : true,
        'public' => isset($args['public']) ? $args['public'] : true,
        'show_ui' => isset($args['show_ui']) ? $args['show_ui'] : true,
        'show_in_menu' => isset($args['show_in_menu']) ? $args['show_in_menu'] : true,
        'show_admin_column' => isset($args['show_admin_column']) ? $args['show_admin_column'] : true
        ));
    } 
}
