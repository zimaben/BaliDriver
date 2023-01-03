<?php
namespace rbt\admin;


/*/ 
 * The parent and child Classes for deferred loading of Google Maps. We'll load after the page 
 * has loaded instead of using the standard enqueue method.
/*/
class MailChimp {
    public static function run(){
        if( \is_admin() ){
         #   \add_action('wp_ajax_create_deferred_maps', array(get_class(), 'create_deferred_maps'));
         #   \add_action('wp_ajax_nopriv_create_deferred_maps', array(get_class(), 'create_deferred_maps'));
            
        } else {
          #  \add_action('wp_head', array(get_class(), 'defer_google_maps'));
        }

    }

    public static function defer_mailchimp(){
        if(file_exists( \get_template_directory() . '/theme/core/static/GoogleAnalytics.js' )){
             ?>
             <script defer src="<?php \get_template_directory() . '/theme/core/static/GoogleAnalytics.js' ?>"></script> <!-- contains formerly-inline snippet -->
             <script defer src="https://www.google-analytics.com/analytics.js"></script>
             <?php
        }

    }
}
MailChimp::run();
