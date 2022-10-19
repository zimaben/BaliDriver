<?php
namespace <!PLUGINPATH->;
use \Carbon_Fields\Container;
use \Carbon_Fields\Field;
use \<!PLUGINPATH->\Config as Config;

#Theme::Assets
#Theme::TemplatePart
#Theme::Optimizations
#Theme::Pages
#Theme::Customizer
#theme::Taxonomies
#Theme::PostTypes
#Theme::Menus
#Theme::Carousel
#Theme::Tabs
#Theme::SocialLinks
#Theme::ProgressiveHeader
#Theme::ShareLinks



defined( 'ABSPATH') OR exit;

if( !class_exists( '\<!PLUGINPATH->\<!PLUGINNAME->')) {

    class <!PLUGINNAME-> {

        private static $instance = null;


        /* CONFIG FILE DEFINES YOUR CONSTANTS */

        public static function get_instance(){
            #singletons have feelings too
            if(null==self::$instance) self::$instance = new self;

            return self::$instance;
        }

        private function __construct(){

            #CONFIG - Load theme constants and config
            require_once( \get_template_directory() . '/wp-theme-config.php');
           
            require_once( \get_template_directory() . '/library/admin/setup/pages.php');
            if(Config::POST_TYPES) :
                require_once( \get_template_directory() . '/library/admin/setup/posttypes.php');
            endif;

            if(Config::TAXONOMIES) : 
                require_once( \get_template_directory() . '/library/admin/setup/taxonomies.php');
            endif;

            if(is_array(Config::MENUS)){
                $bsmenu = false;
                foreach(Config::MENUS as $menu => $options){
                    if($options['bootstrap_markup'] === true) $bsmenu = true; break;
                }
                if($bsmenu) require_once( \get_template_directory() . '/library/admin/setup/bootstrap_navwalker.php');
            }

            #custom theme actions
            \add_action( 'wp_head', array($this, 'theme_wp_head'));
            \add_action( 'wp_footer', array($this, 'theme_wp_footer'));
            \add_filter( 'body_class', array($this, 'theme_body_classes'), 10, 2);
            \add_action( 'after_setup_theme', array($this, 'add_image_sizes'));
            
            \add_action( 'init', array($this, 'theme_support_init'));
            
            #misc and utilities
            \add_filter( 'upload_mimes', array($this, 'svg_support'));
            \add_filter( 'show_admin_bar', '__return_false' );
            
            
            /* Carbon Fields - just boot it as soon as we can */
            require_once( 'vendor/autoload.php' );
            \Carbon_Fields\Carbon_Fields::boot();
            require_once \get_template_directory() . '/library/admin/add_fields.php';

            #add themes, hooks, & libraries

            #LOAD CORE
            # - view templates accept arrays or objects as arguments and dynamically render the view
            require_once \get_template_directory() . '/library/core/view.php';
            require_once \get_template_directory() . '/library/core/methods.php';
            require_once \get_template_directory() . '/library/core/api/endpoints.php';

            /* Customizer */
            require_once \get_template_directory() . '/library/admin/customize.php';

            #LOAD INTEGRATIONS
            if(Config::INTEGRATIONS){
                foreach(Config::INTEGRATIONS as $filename => $enabled){
                    if($enabled){
                        require_once \get_template_directory() . '/library/admin/integrations/' . $filename . '.php';
                    }
                }
            }

            #theme setup (menus, taxonomies, pages, page templates, etc.)
            require_once \get_template_directory() . '/library/admin/setup/setup.php';

            if( \is_admin()){
                \add_action( 'admin_enqueue_scripts', array($this, 'theme_admin_enqueue'));
            } else {
                \add_action( 'wp_enqueue_scripts', array($this, 'theme_enqueue'));
            }

            #ROUTE TEMPLATES
            if( Config::TEMPLATES) : 
                \add_filter( 'page_template', array($this, 'theme_route_templates' ));
            endif;

            #LOAD THEME BLOCKS
            require_once \get_template_directory() . '/library/admin/setup/blocks.php';
            require_once \get_template_directory() . '/library/admin/ajax.php';


            /* THEME LOAD OPTIMIZATIONS BLOCK - PLEASE UNDERSTAND WHAT YOU ARE DOING BEFORE YOU TOUCH THIS 
             * CODE. THE CRITICAL CSS IS GENERATED VIA GULP BEFOREHAND AND INCLUDED IN THE PHPCORE BY
             * FILE NAME WITH SLUG. IF SOMETHING CHANGES THAT AFFECTS THE INITIAL LOAD RUN THE GULP TASK
             * FROM THE TERMINAL TO REGENERATE THESE FILES. */
            
              #Critical CSS Functions 
             if( Config::FEATURES['critical_css'] === true){
                \add_action( 'wp_head', array($this, 'doCriticalCSS'), 2);
             }
            
            \add_filter( 'style_loader_tag', array($this, 'add_preload_tag'), 10, 4 );
            \add_filter( 'clean_url', array($this, 'defer_javascript'), 11, 1 );

            /* stop FSE inline container nonsense */
            \remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
            \add_filter( 'render_block', function( $block_content, $block ) {
                if ( $block['blockName'] === 'core/group' ) {
                    return $block_content;
                }
        
                return \wp_render_layout_support_flag( $block_content, $block );
            }, 10, 2 );


            
            
        } /* END THEME INSTANTIATE */


        /* THEME STATIC METHODS - MOST OF THESE ARE JUST SYNTAX SUGAR FOR INCLUDING FROM DIFFERENT
        FOLDERS  */
        public static function Assets( $filename, $path = 'icons'){
            if( file_exists( \get_template_directory() . '/theme/assets/' . $path . '/' . $filename)){
                return \get_template_directory_uri() . '/theme/assets/' . $path . '/' . $filename;
            }
            return false;
        }
        public static function TemplatePart( $file ){
           # if(strpos($file, '.php') === false) $file .= '.php';
           $file = str_replace('.php', '', $file);
            #load a template part
            \get_template_part( 'theme/template-parts/' . $file );
        }
        public static function TemplatePartExists( $file ){
            if(strpos($file, '.php') === false) $file .= '.php';
            if(substr($file, 0,1) !== '/' ) $file = '/' . $file;
            return file_exists( \get_template_directory() . '/theme/template-parts/' . $file );
        }
        public static function StaticHeaderExists( $id ){
            return \file_exists( \get_template_directory() . '/theme/template-parts/static/header-' . $id . '.php');
        }
        public static function StaticHeader( $id ){
            include_once( \get_template_directory() . '/theme/template-parts/static/header-' . $id . '.php');
        }
        public static function StaticFooterExists( $id ){
            return \file_exists( \get_template_directory() . '/theme/template-parts/static/footer-' . $id . '.php');
        }

        public static function Integration( $file ){
            if(strpos($file, '.php') === false) $file .= '.php';
            #load a template part
            \get_template_part( 'library/admin/integrations/' . $file );
        }


        /* Critical CSS Functions */
        public static function doCriticalCSS(){
            /* Add inline CSS to the head */
            self::TemplatePart('static/critical-css');
        }

        public static function add_preload_tag( $html, $handle, $href, $media ) {
            /* credit to https://www.namehero.com/startup/how-to-inline-and-defer-css-on-wordpress-without-plugins/ */
            if (is_admin()) return $html;
    
            $html = '<link rel="preload" href="' . $href . '" as="style" id="' . $handle . '" media="'.$media.'" onload="this.media=\''.$media.'\';this.rel=\'stylesheet\'">'
            . '<noscript>' . $html . '</noscript>';
            return $html;
        }

        public static function defer_javascript( $url ){
            if ( FALSE === strpos( $url, '.js' ) ) return $url;
            if ( \is_admin() ) return $url;
            if ( strpos( $url, 'jquery.js' ) ) return $url;
         //   if ( strpos( $url, 'site-footer.js' ))  return $url;
            if ( strpos( $url, 'site-header.js' ))  return $url;
            if ( strpos( $url, 'plugins/gutenberg')) return $url;
            
            if ( strpos( $url, 'wp-includes' ) ){

               return $url;
            } 

            return "{$url}' defer ";
        }

        public static function theme_enqueue(){
            $v =Config::MODE == "development" ? (string) bin2hex(random_bytes(2)) : Config::VERSION;
            \wp_enqueue_script ( 'footer', \get_template_directory_uri() . '/theme/dist/js/footer.js', array(), $v, true );
            \wp_enqueue_script ( 'sitehead', \get_template_directory_uri() . '/theme/dist/js/main.js', array(), $v, false );
            \wp_enqueue_style( 'theme-css', \get_template_directory_uri() . '/theme/dist/style.css', array(), $v, 'all');
        }

        public static function theme_admin_enqueue(){
            $v = bin2hex(random_bytes(2)); #never cache any javascript in admin view
            \wp_enqueue_script( 'theme-admin-js', \get_template_directory_uri() . '/theme/dist/js/admin.js', array(), $v, false);
        }   

        public static function theme_route_templates( $template ){
            global $post;
            $post_slug = is_object($post) ? $post->post_name : '';
            if($post_slug){
                isset(Config::TEMPLATES[$post_slug]) ? $template = Config::TEMPLATES[$post_slug] : $template;
            }
            return $template;
        }
        public static function theme_body_classes( $classes ) {
            // global $post;
            // if($post && $post->post_name) {

            // }
            return $classes;
        }
        /* This is in General not Setup because I think it's a no-brainer every site should have */
        public static function theme_support_init(){
            \register_taxonomy_for_object_type('post_tag', 'page');
            \register_taxonomy_for_object_type('category', 'page');  

            // \register_taxonomy_for_object_type('Amenities', 'locations');
            // \register_taxonomy_for_object_type('Services', 'locations');
            // \register_taxonomy_for_object_type('Experiences', 'locations');
            // \register_taxonomy_for_object_type('Resources', 'locations');
        }


        


        public static function theme_wp_head(){
            # do header stuff
        }
        public static function theme_wp_footer(){
            #do footer server-side scripts
        }

        public static function add_image_sizes(){

            if(Config::FEATURES['progressive_header']){
                #normal page header
                $page_image_x = 1512; $page_image_y = 432;
                \add_image_size('ph-page-one', floor($page_image_x / 4), floor($page_image_y / 4), array('top', 'center'));
                \add_image_size('ph-page-two', floor($page_image_x / 2), floor($page_image_y / 2), array('top', 'center'));
                \add_image_size('ph-page-three', floor($page_image_x * .75), floor($page_image_y * .75), array('top', 'center'));
                \add_image_size('ph-page-full', $page_image_x, $page_image_y, array('top', 'center'));
                #location header
                $location_image_x = 1512; $location_image_y = 624;
                \add_image_size('ph-locations-one', floor($page_image_x / 4), floor($page_image_y / 4), array('top', 'center'));
                \add_image_size('ph-locations-one', floor($page_image_x / 4), floor($page_image_y / 4), array('top', 'center'));
                \add_image_size('ph-locations-one', floor($page_image_x / 4), floor($page_image_y / 4), array('top', 'center'));
                \add_image_size('ph-locations-one', floor($page_image_x / 4), floor($page_image_y / 4), array('top', 'center'));
            }
            	
            \add_image_size( 'bm-square-lg', 545, 545, array('center', 'center') );
            \add_image_size( 'bm-square-md', 480, 480, array('center', 'center') );
            \add_image_size( 'bm-landscape-md', 505, 466, array('center', 'center') );
            \add_image_size( 'bm-landscape-mobile', 375, 346, array('center', 'center') );

        }

        
        public static function svg_support($filetypes){
            return array_merge($filetypes, [
                'svg' => 'image/svg+xml'
                ] );
        }

    }
}
<!PLUGINNAME->::get_instance();