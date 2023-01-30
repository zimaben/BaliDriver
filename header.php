<?php
use rbt\FRStarter as Theme;
use rbt\Config as Config;
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TPT
 * @subpackage TPT_Gardens_Care
 */

?>
<!doctype html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php \wp_head(); global $post; $slug = ($post instanceof WP_Post ) ? $post->post_name : "404" ?>
    <?php
        if(Config::INTEGRATIONS['GoogleAnalytics'] === true){
            
            Theme::Integration('GoogleAnalytics', 'deferredAnalytics'); 
        
        }

        if(Config::INTEGRATIONS['GoogleMaps'] === true){
            
            Theme::Integration('GoogleMaps', 'deferredGoogleMaps');
        
        }
        #critical inline styles
        if(Config::FEATURES['critical_css'] === true){

            Theme::TemplatePart('static/critical-css.php');

        }
    ?>
</head>

<body <?php \body_class(); ?>>
<?php \wp_body_open(); ?>
<div id="page" class="site <?php echo $slug ?>">
        
	<?php Theme::TemplatePart('site-header'); 