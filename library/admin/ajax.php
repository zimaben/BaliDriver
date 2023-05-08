<?php
namespace rbtddb\ajax;

use \rbtddb\DDBali as Theme;

class Ajax extends Theme {

    public static function run(){

        if(\is_admin()){
            \add_action( 'admin_enqueue_scripts', array(get_class(), 'admin_localize'), 99);
        } else {
            \add_action( 'wp_enqueue_scripts', array(get_class(), 'theme_localize'), 99);
        }

    }
    public static function admin_localize(){
        #Localize Admin 
        \wp_localize_script( 'theme-admin-js', 'theme_admin', array(
            'nonce' => \wp_create_nonce('theme-admin'),
            'ajaxurl' => \admin_url('admin-ajax.php'),
            'theme_root' => \get_template_directory_uri(),
            'siteurl' => \get_site_url(),
        ));
    }
    public static function theme_localize(){ 
        #Localize frontend
        \wp_localize_script( 'sitehead', 'theme_vars', array(
            'nonce' => \wp_create_nonce('theme_vars'),
            'ajaxurl' => \admin_url('admin-ajax.php'),
            'postid'  => \get_the_ID(),
            'userid'  => \get_current_user_id(),
            'theme_root' => \get_template_directory_uri(),
            'siteurl' => \get_site_url(),
        ));
        
    }
   
     
}
//spin it
Ajax::run();
