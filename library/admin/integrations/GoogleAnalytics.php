<?php
namespace <!PLUGINPATH->\admin;
use \Carbon_Fields\Container;
use \Carbon_Fields\Field;
use <!PLUGINPATH->\Config as Config;

/*/ 
 * Class for deferring ALL google analytics. This also plays nicely with 
 * GDPR requirements 
 * For Reference: https://pagespeedchecklist.com/defer-google-analytics#all-together
 * 
/*/
class GoogleAnalytics {
    public static function run(){
        if( \is_admin() ){
            \add_action('wp_ajax_create_deferred_scripts', array(get_class(), 'create_deferred_scripts'));
            \add_action('wp_ajax_nopriv_create_deferred_scripts', array(get_class(), 'create_deferred_scripts'));
            
        } else {
            \add_action('wp_head', array(get_class(), 'defer_google_analytics'));
        }

    }
    
    public static function create_deferred_scripts(){
        #get script from Carbon Fields theme option
        #gzip and save to .js file named after class in /theme/core/static/
        ?>

        <?php
    }
    public static function defer_google_analytics(){
        if(file_exists( \get_template_directory() . '/theme/core/static/GoogleAnalytics.js' )){
            ?>
            <script defer src="<?php \get_template_directory() . '/theme/core/static/GoogleAnalytics.js' ?>"></script> <!-- contains formerly-inline snippet -->
            <script defer src="https://www.google-analytics.com/analytics.js"></script>
            <?php
        }

    }
}
GoogleAnalytics::run();