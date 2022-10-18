<?php
use \<!PLUGINPATH->\Config as Config;
use \<!PLUGINPATH->\<!PLUGINNAME-> as Theme;
   #page header
   if(Config::FEATURES['progressive_header'] === true){

        Theme::TemplatePart('progressive-header.php');

    } else {

       Theme::TemplatePart('page-static-header.php');

    }  
    #critical inline styles
    if(Config::FEATURES['critical_css'] === true){

        Theme::doCriticalCSS();

    }

    ?>

    <div id="content" class="site-content">
        <section id="primary" class="content-area">
            <main id="main" class="site-main <?php echo ' ' .$wp_query->post->post_name ?>" role="main">