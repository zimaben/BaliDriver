#!/bin/bash
echo "Class name for new Plugin?"
read classname
echo "Text domain (plugin namespace)"
read classprefix


if [ -z "$classname" ] || [ -z "$classprefix" ] 
then echo "Missing required information. Aborted"

else 
#create base file
  cat > $classprefix.php <<EOF
<?php
namespace $classprefix;
/* 
 * $classname Plugin
 *
 * @package         $classprefix
 * @author          Ben Toth
 * @license         Proprietary License
 * @link            https://thefriendlyrobot.com
 * @copyright       2022 thefriendlyrobot.com
 *
 * @wordpress-plugin
 * Plugin Name:     $classname Full Name
 * Plugin URI:      https://github.com/zimaben
 * Description:     Write your Plugin Description Here
 * Version:         1.0.0
 * Author:          Ben Toth / Friendly Robot
 * Author URI:      https://thefriendlyrobot.com
 * License:         Proprietary License 
 * Copyright:       $classprefix
 * Class:           $classprefix
 * Text Domain:     $classprefix
 * Domain Path:     /languages
 * Repo: https://github.com/zimaben/self-ctrl-assessment
*/

defined( 'ABSPATH' ) OR exit;

if ( ! class_exists( '$classprefix\\$classname' ) ) {

    \register_activation_hook( __FILE__, array ( '$classprefix\\$classname', 'register_activation_hook' ) );    

    \add_action( 'plugins_loaded', array ( '$classprefix\\$classname', 'get_instance' ), 1);

    class $classname {
 
        private static \$instance = null;

        // Plugin Settings Generic
        const version = '1.0.0';
        static \$mode = 'development'; //development & production
        const textdomain = '$classprefix'; // for translation ##

        //Plugin Options
        /**
         * Returns a singleton instance
         */
        public static function get_instance() 
        {
            
            if ( 
                null == self::\$instance 
            ) {

                self::\$instance = new self;

            }

            return self::\$instance;

        }
        
        private function __construct() {

            // actvation ##
            \register_activation_hook( __FILE__, array ( \$this, 'register_activation_hook' ) );

            // deactivation ##
            \register_deactivation_hook( __FILE__, array ( \$this, 'register_deactivation_hook' ) );

            // set text domain ##
            \add_action( 'init', array( \$this, 'load_plugin_textdomain' ), 1 );

            #execute deactivation options
            \add_action( 'wp_ajax_deactivate', array( \$this, 'deactivate_callback') );

            // load libraries ##
            self::load_libraries();
            

        }
        
        private static function load_libraries() {

            //Carbon Fields
			require_once self::get_plugin_path( 'vendor/autoload.php' );
    		\Carbon_Fields\Carbon_Fields::boot();
            require_once self::get_plugin_path( 'library/admin/add_fields.php' );

			#Templating (Backend PHP Templating)
            require_once self::get_plugin_path( 'library/template/view.php' );

			//The Build File sets up plugin pages, taxonomies, & post types
			require_once self::get_plugin_path( 'library/core/build.php' );

			\$has_plugin_run_setup = \get_option( self::textdomain . '-run-setup' );
			if(!\$has_plugin_run_setup) require_once self::get_plugin_path( 'library/core/setup.php');

            #REST Api
            require_once self::get_plugin_path( 'library/api/endpoints.php');
			require_once self::get_plugin_path( 'library/api/methods.php');
			require_once self::get_plugin_path( 'library/admin/ajax.php');

			#Frontend (Enqueue & Localize Scripts, Handle Blocks )
			require_once self::get_plugin_path( 'library/blocks/blocks.php');
            
        }

        public static function register_activation_hook() {

            \$option = self::textdomain . '-version';
            \update_option( \$option, self::version );     

            
            #Cron
			/*
            if ( ! wp_next_scheduled( 'my_plugin_daily' ) ) {
                if(self::\$mode ==="development") error_log('schedule event fired for theme daily');
                \wp_schedule_event( time(), 'daily', 'my_plugin_daily' );
              
            } else {
                if(self::\$mode === "development") error_log('Scheduled event already there: plugin daily');
            }
			*/

        }

        public function register_deactivation_hook() 
        {
            
            \$option = self::textdomain . '-version';
			\$setup = self::textdomain . '-run-setup';
            \delete_option( \$option );
            \delete_option( \$setup );

			#Cron
            #\wp_clear_scheduled_hook( 'my_plugin_daily' );
        }

        public function load_plugin_textdomain() 
        {
            
            // set text-domain ##
            \$domain = self::textdomain;
            
            // The "plugin_locale" filter is also used in load_plugin_textdomain()
            \$locale = apply_filters('plugin_locale', get_locale(), \$domain);

            // try from global WP location first ##
            \load_textdomain( \$domain, WP_LANG_DIR.'/plugins/'.\$domain.'-'.\$locale.'.mo' );
            
            // try from plugin last ##
            \load_plugin_textdomain( \$domain, FALSE, plugin_dir_path( __FILE__ ).'library/language/' );
            
        }

        public static function get_plugin_url( \$path = '' ) 
        {

            return plugins_url( \$path, __FILE__ );

        }
        
        public static function get_plugin_path( \$path = '' ) 
        {

            return plugin_dir_path( __FILE__ ).\$path;

        }
    }
}
EOF

#create installer

  cat > installer.php <<EOF
<?php
\$pn = "$classname";
\$pp = "$classprefix";

\$files = array(
	'/library/admin/add-fields.php',
    '/library/admin/ajax.php',
    '/library/api/endpoints.php',
	'/library/api/methods.php',
    '/library/blocks/blocks.php',
	'/library/core/build.php',
    '/library/core/pages.php',
    '/library/core/post-types.php',
    '/library/core/setup.php',
    '/library/core/taxonomies.php',
	'/library/template/view.php',
	'/package.json'
);
\$replacements = array(
	'<!PLUGINNAME->' => \$pn,
	'<!PLUGINPATH->' => \$pp,
);
function runsetup(\$files, \$replacements){
	foreach(\$files as \$file){
		\$path = __DIR__ .  \$file;
		foreach(\$replacements as \$key=>\$val){
			if(file_exists(\$path)){
				\$writable = ( is_writable(\$path) ) ? TRUE : chmod(\$path, 0775);
				if ( \$writable ) {
						\$target = file_get_contents(\$path);
						\$content = preg_replace('/' . \$key . '/s',\$val,\$target);
				    file_put_contents(\$path, \$content);
				} else {
				    echo 'Failed to overwrite ' . \$path . PHP_EOL;
				}
			}
		}
	}
}
runsetup(\$files, \$replacements);
EOF

fi

if [ $? -eq 0 ]
then
PHP=`which php`
$PHP installer.php

else 
echo "Could not set up Plugin" >&2 

fi

if [ $? -eq 0 ] 
then 
  echo "Successfully ran Plugin Installer"  
  rm installer.php
else 
  echo "Could not create Plugin" >&2 
  rm installer.php
fi

if [ $? -eq 0 ] 
then 
  echo "Downloading Sass/Javascript Tooling"  
  npm install

else 
  echo "Please look over files and fix" >&2 
fi


echo "Script successfully ran"
exit