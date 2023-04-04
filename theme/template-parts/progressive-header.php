<?php
use rbtddb\DDBali as Theme;
use rbtddb\Config as Config;
global $post;
 
if(Config::FEATURES['progressive_header'] && is_array(Config::FEATURES['progressive_header'])){
    ?>
        
        <?php #ProgressiveHeader object delivers the canvas html and aspect ratio placeholder
        include_once( get_template_directory() . '/theme/template-parts/components/progressive-header.php' );
        $type = \is_front_page() ? 'home' : $post->post_type;
        
        //if post type specifically set to false, no page header
        if( Config::FEATURES['progressive_header'] && Config::FEATURES['progressive_header'][$type] !== false){
            $header_args = isset( Config::FEATURES['progressive_header'][$type] ) ? Config::FEATURES['progressive_header'][$type] : Config::FEATURES['progressive_header']['default'];
            if( 
                isset( Config::FEATURES['progressive_header']['custom']) &&
                isset(Config::FEATURES['progressive_header']['custom']['slug']) &&
                Config::FEATURES['progressive_header']['custom']['slug'] === $post->post_name ){

                    $header_args = Config::FEATURES['progressive_header']['custom'];
            }
            $filters = isset($header_args['filters']) ? $header_args['filters'] : false;
            $canvas = new \rbtddb\ProgressiveHeader($post, $header_args['w'],$header_args['h'],$header_args['minHeight'], $filters);
            
            if($canvas->html) {echo $canvas->render();}
        }

} else {
    Theme::TemplatePart('page-static-header.php');
}
?>
