<?php
namespace <!PLUGINPATH->\blocks;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;
use \<!PLUGINPATH->\template\View as View;

class Blocks extends Plugin{

    public static function run(){

        \add_action( 'init', array(get_class(), 'theme_blocks'));
        add_action( 'enqueue_block_editor_assets', array(get_class(), 'plugin_blocks'));
        \add_action( 'block_categories_all', array($this, 'register_theme_blocktype'));
        #\add_action( 'init', array($this, 'plugin_blocks'));

    }
    public static function register_theme_blocktype( $categories ){
        return array_merge(
            $categories, array( array('slug'=>'kitelytech', 'title'=>'KitelyTech Blocks', 'icon' => 'kitely'))
        );
    }

    public static function plugin_blocks(){
        #version is either a random cachebuster or the current version depending on theme mode
        $v = self::mode == "development" ? (string) bin2hex(random_bytes(2)) : self::version;

        #shared js/css
        \wp_register_style( 'theme_blocks_global_css', \get_template_directory_uri() . '/dist/style.css', array(), $v, 'all' );
        \wp_register_style( 'theme_blocks_editor_css', \get_template_directory_uri() . '/dist/editor.css', array(), $v, 'all' );
        \wp_register_script ( 'theme_blocks_global_js', \get_template_directory_uri() . '/dist/app.js', array('wp-blocks', 'wp-editor', 'wp-components'), $v, false );
        \wp_enqueue_script ( 'footer', \get_template_directory_uri() . '/dist/site-footer.js', array('theme_blocks_global_js'), $v, true );
        \wp_enqueue_script ( 'sitehead', \get_template_directory_uri() . '/dist/site-header.js', array(), $v, false );
        
        #core hooks/filters 
        \wp_enqueue_script ( 'hooksfilters-js', \get_template_directory_uri() . '/dist/global/core-filters.js', array('wp-blocks', 'wp-editor', 'wp-components'), $v, false );
        

        #block script
        \wp_register_script( 'headerlogo', \get_template_directory_uri() . '/dist/blocks/headerlogo.js', array( 'wp-blocks', 'wp-editor'));
        \register_block_type( 'themeblockhead/headerlogo', array(
            'editor_script' => 'headerlogo',
            'editor_style'  => 'theme_blocks_editor_css',
            'style'         => 'theme_blocks_global_css'
                
        ) );

    }
}
//spin it
\<!PLUGINPATH->\blocks\Blocks::run();
