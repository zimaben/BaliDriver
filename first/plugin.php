<?php
namespace <!PLUGINPATH->;
/* 
 * <!PLUGINNAME-> Plugin
 *
 * @package         <!PLUGINPATH->
 * @author          Ben Toth
 * @license         Proprietary License
 * @link            https://thefriendlyrobot.com
 * @copyright       2022 thefriendlyrobot.com
 *
 * @wordpress-plugin
 * Plugin Name:     <!PLUGINNAME-> Full Name
 * Plugin URI:      https://github.com/zimaben
 * Description:     Write your Plugin Description Here
 * Version:         1.0.0
 * Author:          Ben Toth / Friendly Robot
 * Author URI:      https://thefriendlyrobot.com
 * License:         Proprietary License 
 * Copyright:       <!PLUGINNAME-> 
 * Class:           <!PLUGINNAME->
 * Text Domain:     <!PLUGINPATH->
 * Domain Path:     /languages
 * Repo: https://github.com/zimaben/self-ctrl-assessment
*/

defined( 'ABSPATH' ) OR exit;

if ( ! class_exists( 'selfctrl\assessment\SelfCTRL_Assessment' ) ) {

    \register_activation_hook( __FILE__, array ( 'selfctrl\assessment\SelfCTRL_Assessment', 'register_activation_hook' ) );    

    \add_action( 'plugins_loaded', array ( 'selfctrl\assessment\SelfCTRL_Assessment', 'get_instance' ), 1);

    class <!PLUGINNAME-> {
 
        private static $instance = null;

        // Plugin Settings Generic
        const version = '1.0.0';
        static $mode = 'development'; //development & production
        const textdomain = '<!PLUGINPATH->'; // for translation ##

        //Plugin Options
        /**
         * Returns a singleton instance
         */
        public static function get_instance() 
        {
            
            if ( 
                null == self::$instance 
            ) {

                self::$instance = new self;

            }

            return self::$instance;

        }
        
        private function __construct() {

            // actvation ##
            \register_activation_hook( __FILE__, array ( $this, 'register_activation_hook' ) );

            // deactivation ##
            \register_deactivation_hook( __FILE__, array ( $this, 'register_deactivation_hook' ) );

            // set text domain ##
            \add_action( 'init', array( $this, 'load_plugin_textdomain' ), 1 );

            #execute deactivation options
            \add_action( 'wp_ajax_deactivate', array( $this, 'deactivate_callback') );

            // load libraries ##
            self::load_libraries();
            

        }
        
        private static function load_libraries() {

            //Carbon Fields
            require_once self::get_plugin_path( 'admin/add_fields.php' );

			#Templating (Backend PHP Templating)
            require_once self::get_plugin_path( 'library/template/view.php' );

			//The Build File sets up plugin pages, taxonomies, & post types
			require_once self::get_plugin_path( 'library/core/build.php' );

			$has_plugin_run_setup = \get_option( self::textdomain . '-run-setup' );
			if(!$has_plugin_run_setup) require_once self::get_plugin_path( 'library/core/setup.php');

            #REST Api
            require_once self::get_plugin_path( 'library/api/endpoints.php');
			require_once self::get_plugin_path( 'library/api/methods.php');
			require_once self::get_plugin_path( 'library/admin/ajax.php');

			#Frontend (Enqueue & Localize Scripts, Handle Blocks )
			require_once self::get_plugin_path( 'library/blocks/blocks.php');
            
        }

        public static function register_activation_hook() {

            $option = self::textdomain . '-version';
            \update_option( $option, self::version );     

            
            #Cron
			/*
            if ( ! wp_next_scheduled( 'my_plugin_daily' ) ) {
                if(self::$mode ==="development") error_log('schedule event fired for theme daily');
                \wp_schedule_event( time(), 'daily', 'my_plugin_daily' );
              
            } else {
                if(self::$mode === "development") error_log('Scheduled event already there: plugin daily');
            }
			*/

        }

        public function register_deactivation_hook() 
        {
            
            $option = self::textdomain . '-version';
			$setup = self::textdomain . '-run-setup';
            \delete_option( $option );
            \delete_option( $setup );

			#Cron
            #\wp_clear_scheduled_hook( 'my_plugin_daily' );
        }

        public function load_plugin_textdomain() 
        {
            
            // set text-domain ##
            $domain = self::textdomain;
            
            // The "plugin_locale" filter is also used in load_plugin_textdomain()
            $locale = apply_filters('plugin_locale', get_locale(), $domain);

            // try from global WP location first ##
            \load_textdomain( $domain, WP_LANG_DIR.'/plugins/'.$domain.'-'.$locale.'.mo' );
            
            // try from plugin last ##
            \load_plugin_textdomain( $domain, FALSE, plugin_dir_path( __FILE__ ).'library/language/' );
            
        }

        public static function get_plugin_url( $path = '' ) 
        {

            return plugins_url( $path, __FILE__ );

        }
        
        public static function get_plugin_path( $path = '' ) 
        {

            return plugin_dir_path( __FILE__ ).$path;

        }
    }
}
