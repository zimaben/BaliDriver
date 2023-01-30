<?php
use rbt\FRStarter as Theme;
use rbt\Config as Config;
   #page header
   if(Config::FEATURES['progressive_header']){

    Theme::TemplatePart('progressive-header.php');

} else {
   
   Theme::TemplatePart('page-static-header.php');

}  

?>

<div id="content" class="site-content">
    <section id="primary" class="content-area <?php echo $wp_query->post->post_type ?>">
        <main id="main" class="site-main <?php echo $wp_query->post->post_name ?>" role="main">