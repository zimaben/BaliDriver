<?php 

use rbtddb\Config as Config;
/* Global Prefooter */
$has_image = (isset(Config::FOOTER['prefooter']['image']) && Config::FOOTER['prefooter']['image'] !== false ) ? true : false;
?>
    <div class="prefooter">
        <div class="prefooter-wrap<?php echo $has_image ? ' twocol' : '' ?>">
            <?php 
            if($has_image){
                #Image Found - Prefooter Two-Column Layout
                ?>
                <div class="footer-col left">
                    <?php 
                        $imgurl = \get_theme_mod( 'prefooter_img' );
                        if($imgurl) echo '<div class="prefooter-img"><img src="'.$imgurl.'" /></div>';
                    ?>
                </div>
                <?php
            }
            ?>
            <div class="footer-col<?php echo $has_image ? ' right' : '' ?>">
            <?php 
                if(get_theme_mod('prefooter_title')){
                    echo '<h2 class="prefooter-title">'.\get_theme_mod( 'prefooter_title' ).'</h2>';
                } 
                if(get_theme_mod('prefooter_text')){
                    echo '<p class="prefooter-text">'.\get_theme_mod( 'prefooter_text' ).'</p>';
                } 
                if(get_theme_mod('prefooter_textarea')){
                    echo '<div class="prefooter-textarea">'.\get_theme_mod( 'prefooter_textarea' ).'</div>';
                } 
                if(get_theme_mod('prefooter_shortcode')){
                    $code = \get_theme_mod( 'prefooter_shortcode' );
                    if( \do_shortcode($code) !== $code ){
                        echo '<div class="prefooter-shortcode-wrap">'.\do_shortcode($code).'</div>';
                    }
                    
                } 
            ?>
                
            </div>
        </div>
    </div>