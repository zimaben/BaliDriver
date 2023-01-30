<?php
namespace <!PLUGINPATH->\admin\setup;
use \<!PLUGINPATH->\<!PLUGINNAME-> as Theme;
/*
 * Page Class to wrap a simple create page function. If the $args['force_create'] is not
 * set or set to true a new page will be created with a slug like my-page-2.
 * If force_create is set to false and a page with the slug already exists will
 * return the existing page ID
 * 
 * ACCEPTS: 
 *  $slug - the slug of the page to create, 
 *  $args - array of arguments
 *      * title
 *      * type
 *      * force_create 
 *      * content
 * RETURNS: the page ID of the page created or the existing page ID depending on 
 * the force_create setting
 */


 class Page {
    private static $accepted_args = array('title', 'type', 'force_create', 'content', 'post_type', 'post_title', 'post_content', 'post_status', 'post_author');
    public function __construct( $slug, $args = array() ){
        $this->slug = \sanitize_title($slug);
        $this->args = $this->checkArgs($args);
        $this->ID = (isset($this->args['force_create']) && $this->args['force_create'] === false) ? $this->add_new_page() : $this->add_page();
    }
    private function title_from_slug($slug){
        return ucwords(str_replace('-', ' ', $slug));
    }
    private function checkArgs($args){
        $sanitized_args = array();
        foreach($args as $key=>$value){
            #be compatible with WordPress standard args
            if(strtolower(trim($key)) === 'post_title') $key = 'title';
            if(strtolower(trim($key)) === 'post_content') $key = 'content';
            if(strtolower(trim($key)) === 'post_type') $key = 'type';

            if(in_array(strtolower(trim($key)), self::$accepted_args)){
                $sanitized_args[ strtolower(trim($key)) ] = $value;
            }
        }
        return $sanitized_args;
    }
    private function add_new_page(){

        $title = isset($this->args['title']) ? $this->args['title'] : $this->title_from_slug($this->slug);
        $posttype = isset($this->args['type']) ? $this->args['type'] : 'page';
        $page_check = \get_page_by_path($this->slug, OBJECT, $posttype );
        $page = array(
                'post_type' => $posttype,
                'post_title' => $title,
                'post_content' => isset($this->args['content']) ? $this->args['content'] : '',
                'post_status' => isset($this->args['post_status']) ? $this->args['post_status'] : 'publish',
                'post_name' => $this->slug
        );
        if( isset($args['post_author']) ){
            $page['post_author'] = $args['post_author'];
        }
        if( !isset($page_check->ID) ){
            return \wp_insert_post($page);
        } else {
            return $page_check->ID;
        } 
    }
    private function add_page(){

        $title = isset($this->args['title']) ? $this->args['title'] : $this->title_from_slug($this->slug);
        $posttype = isset($this->args['type']) ? $this->args['type'] : 'page';
        $page_check = \get_page_by_path($this->slug, OBJECT, $posttype );
        $page = array(
                'post_type' => $posttype,
                'post_title' => $title,
                'post_content' => isset($this->args['content']) ? $this->args['content'] : '',
                'post_status' => isset($this->args['post_status']) ? $this->args['post_status'] : 'publish',
                'post_name' => $this->slug
        );
        if( isset($args['post_author']) ){
            $page['post_author'] = $args['post_author'];
        }
        if( !isset($page_check->ID) ){
            $new_page_id = \wp_insert_post($page);
        } else {
            $offset = 1;
            while(isset($page_check->ID)){
                $page_check = \get_page_by_path($this->slug . '-' . $offset, OBJECT, $posttype );
                $offset++;
            }
            $page['post_name'] = $this->slug . '-' . $offset;
            $new_page_id = \wp_insert_post($page);
        }
        return $new_page_id;
        
    }
    public function setToHomePage(){
        if( \get_option('show_on_front') === 'posts') \update_option( 'show_on_front', 'page' );
        \update_option( 'page_for_posts', $this->slug );
    }
    public function setCarbonMeta( $field, $value){
        return \carbon_set_post_meta( $this->ID, $field, $value );
    }
    public function updateTaxonomy( $taxonomy, $terms ){
        #updateTaxonomy will append new taxonomy terms without deleting old ones
        return \wp_set_object_terms( $this->ID, $terms, $taxonomy, true );
    }
    public function setTaxonomy( $taxonomy, $terms ){
        #setTaxonomy will delete all existing terms and set new ones
        return \wp_set_object_terms( $this->ID, $terms, $taxonomy, false );
    }
    public function updateTitle( $newtitle ){
        $args = array(
            'ID'           => $this->ID,
            'post_title'   => $newtitle,
        );
        return \wp_update_post( $args );
    }
    public function updateContent( $newcontent ){
        $args = array(
            'ID'           => $this->ID,
            'post_content'   => $newcontent,
        );
        return \wp_update_post( $args );
    }
}