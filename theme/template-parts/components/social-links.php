<?php

global $post;
switch($post->post_type){
    case("locations") : 
        $fblink = \carbon_get_post_meta('locations_facebook', $post->ID);
        if(!$fblink) $fblink = get_post_meta($post->ID, '_locations_facebook', true);
        $twink = \carbon_get_post_meta('locations_twitter', $post->ID);
        if(!$twink) $twink = \get_post_meta($post->ID, '_locations_twitter', true);
        $lilink = \carbon_get_post_meta('locations_linkedin', $post->ID);
        if(!$lilink) $lilink = \get_post_meta($post->ID, '_locations_linkedin', true);
        $instalink = \carbon_get_post_meta('locations_instagram', $post->ID);
        if(!$instalink) $instalink = \get_post_meta($post->ID, '_locations_instagram', true);
        $ytlink = \carbon_get_post_meta('locations_youtube', $post->ID);
        if(!$ytlink) $ytlink = \get_post_meta($post->ID, '_locations_instagram', true);

    break;

    default: break;
}
#If nothing 
if(!$fblink && !$twink && !$lilink && !$instalink && !$ytlink) :     
    $fblink = \get_theme_mod('facebook_url');
    $twink = \get_theme_mod('twitter_url');
    $lilink = \get_theme_mod('linkedin_url');
    $instalink = \get_theme_mod('instagram_url');
    $ytlink = \get_theme_mod('youtube_url');

endif;

#If something
if($fblink || $twink || $lilink || $instalink || $ytlink) :    

    echo '<ul class="social-links">';
    if($fblink) echo '<a href="'.$fblink.'" target="_blank"><li class="facebook" style="background-image:url('.\get_template_directory_uri() . '/theme/assets/icons/facebook-solid.svg)"></li></a>';
    if($twink) echo '<a href="'.$twink.'" target="_blank"><li class="twitter" style="background-image:url('.\get_template_directory_uri() . '/theme/assets/icons/twitter.svg)"></li></a>';
    if($lilink) echo '<a href="'.$lilink.'" target="_blank"><li class="linkedin" style="background-image:url('.\get_template_directory_uri() . '/theme/assets/icons/linkedin-solid.svg)"></li></a>';
    if($instalink) echo '<a href="'.$instalink.'" target="_blank"><li class="instagram" style="background-image:url('.\get_template_directory_uri() . '/theme/assets/icons/instagram.svg)"></li></a>';
    if($ytlink) echo '<a href="'.$ytlink.'" target="_blank"><li class="youtube" style="background-image:url('.\get_template_directory_uri() . '/theme/assets/icons/youtube.svg)"></li></a>';
    echo '</ul>';

endif;