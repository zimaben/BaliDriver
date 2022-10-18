<?php 
namespace <!PLUGINPATH->\setup;
use \<!PLUGINPATH->\Config as Config;

#move to bottom if not hoisted
\<!PLUGINPATH->\setup\Blocks::get_instance();

class Blocks {

    private static $instance = null;

    public static function get_instance(){
        #singletons have feelings too
        if(null==self::$instance) self::$instance = new self;

        return self::$instance;
    }

    private function __construct(){
        \add_action( 'init', array($this, 'theme_blocks'));

        if( isset(Config::INTEGRATIONS['GoogleAnalytics']) && INTEGRATIONS['GoogleAnalytics']) == true )  : 
            #Add Filter on Buttons and Paragraphs to push an Event to the Data Layer
            \add_filter( 'block_editor_settings_all', array($this,  'theme_block_settings_filters'), 10, 2 );
        endif;
        
        \add_action( 'block_categories_all', array($this, 'register_theme_blocktype'));

        #this needs to run to access custom image sizes in the editor
        \add_filter( 'image_size_names_choose', array($this, 'custom_image_sizes' ));

        #REGISTER BLOCKS HERE
        /* 
            $this->registerBlock('my-dope-block', array('wp-dependencies'), 'optional_callback_function' );
        */

    }

    public static function register_theme_blocktype( $categories ){
        return array_merge(
            $categories, array( array('slug'=>'kitelytech', 'title'=>'KitelyTech Blocks', 'icon' => 'kitely'))
        );
    }
    public static function custom_image_sizes( $size_names ) {

        $theme_sizes = array(
            'bm-square-lg' => __( 'Square Large', Config::TEXTDOMAIN ),
            'bm-square-md' => __( 'Square Medium', Config::TEXTDOMAIN ),
            'bm-landscape-md'=> __( 'Landscape Medium', Config::TEXTDOMAIN ),
            'bm-landscape-mobile'=> __( 'Landscape Mobile', Config::TEXTDOMAIN ),
        );
        return array_merge( $size_names, $theme_sizes );
    }
    public function registerBlock( $handle, $dependencies = array('wp-blocks', 'wp-editor', 'wp-i18n'), $callback = null ){
        \wp_register_script(
            $handle, 
            \get_template_directory_uri() . '/theme/dist/js/blocks/' . $handle . 'js', 
            $dependencies
        );
        if($callback){
            \register_block_type(
                '<!PLUGINPATH->/' . $handle,
                'editor_script' => $handle,
                'editor_style' => 'theme_blocks_editor_css',
                'style' => 'theme_blocks_global_css',
                'render_callback' => '<!PLUGINPATH->\core\Methods::' . $callback,
            );
        } else {
            \register_block_type(
                '<!PLUGINPATH->/' . $handle,
                'editor_script' => $handle,
                'editor_style' => 'theme_blocks_editor_css',
                'style' => 'theme_blocks_global_css',
            );
        }
        if(Config::MODE === "development") : 
            if(!file_exists( \get_template_directory() . '/theme/src/js/blocks/' . $handle . '.js' ) ){
				if ( $callback ) {
                    $template = file_get_contents( \get_template_directory() . '/library/core/block_script_callback_template.txt' );
                    $content = preg_replace('/[!PLUGINPATH!]/s','<!PLUGINPATH->',$template);
                    $content = preg_replace('/[!HANDLE!]/s', $handle, $content);
                    file_put_contents( \get_template_directory() . '/theme/src/js/blocks/' . $handle . '.js' , $content);
                } else {
                    $template = file_get_contents( \get_template_directory() . '/library/core/block_script_template.txt' );
                    $content = preg_replace('/[!PLUGINPATH!]/s','<!PLUGINPATH->',$template);
                    $content = preg_replace('/[!HANDLE!]/s', $handle, $content);
                    file_put_contents( \get_template_directory() . '/theme/src/js/blocks/' . $handle . '.js' , $content);
                }
            }
            if(!file_exists( \get_template_directory() . '/theme/src/css/blocks/_' . $handle . '.scss' ) ){
                $template = file_get_contents( \get_template_directory() . '/library/core/block_style_template.txt' );
                $content = preg_replace('/[!PLUGINPATH!]/s','<!PLUGINPATH->',$template);
                $content = preg_replace('/[!HANDLE!]/s', $handle, $content);
                file_put_contents( \get_template_directory() . '/theme/src/css/blocks/_' . $handle . '.scss'  , $content);
                $base_blocks_scss = file_get_contents( \get_template_directory() . '/theme/src/css/_blocks.scss' );
                $base_blocks_updated = $base_blocks_scss . PHP_EOL . '@import \'./blocks/' . $handle . '\';';
                file_put_contents( \get_template_directory() . '/theme/src/css/_blocks.scss'  , $base_blocks_updated);
            }

            if(!file_exists( \get_template_directory() . '/theme/src/css/blocks/_' . $handle . '-editor.scss' ) ){
                $template = file_get_contents( \get_template_directory() . '/library/core/block_style_template.txt' );
                $content = preg_replace('/[!PLUGINPATH!]/s','<!PLUGINPATH->',$template);
                $content = preg_replace('/[!HANDLE!]/s', $handle, $content);
                file_put_contents( \get_template_directory() . '/theme/src/css/blocks/_' . $handle . '-editor.scss'  , $content);
                $base_blocks_scss = file_get_contents( \get_template_directory() . '/theme/src/css/editor.scss' );
                $base_blocks_updated = $base_blocks_scss . PHP_EOL . '@import \'./blocks/' . $handle . '-editor\';';
                file_put_contents( \get_template_directory() . '/theme/src/css/editor.scss'  , $base_blocks_updated);
            }

        endif;
        #@TODO - Figure out Webpack Automation Here too
    }
    public static function theme_blocks(){

        #version is either a random cachebuster or the current version depending on theme mode
        $v =Config::MODE == "development" ? (string) bin2hex(random_bytes(2)) : Config::VERSION;
        $cssstyle = Config::MODE == "development" ? 'style.css' : 'style.min.css';

        #shared js/css
        \wp_register_style( 'theme_blocks_global_css', \get_template_directory_uri() . '/theme/dist/' . $cssstyle, array(), $v, 'all' );
        if(\is_admin()){
            \wp_register_style( 'theme_blocks_editor_css', \get_template_directory_uri() . '/theme/dist/admin_css.css', array(), $v, 'all' );
        } 
       
        #\wp_register_script ( 'theme_blocks_global_js', \get_template_directory_uri() . '/dist/app.js', array('wp-blocks', 'wp-editor', 'wp-components'), $v, false );
        
        #core hooks/filters 
        #\wp_enqueue_script ( 'hooksfilters-js', \get_template_directory_uri() . '/dist/global/core-filters.js', array('wp-blocks', 'wp-editor', 'wp-components'), $v, false );
    }
    public static function theme_block_settings_filters(){
        #@TODO
        error_log("IS STILL NEED TO ADD THEME BLOCK FILTERS IN THE TEMPLATE")
    }


}