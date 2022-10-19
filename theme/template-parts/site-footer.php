<?php 
use \ktdamd\Config as Config;
use \ktdamd\DoctorAtMyDoor as Theme;

if(isset(Config::FOOTER['prefooter']) && Config::FOOTER['prefooter'] !== false ){
    Theme::TemplatePart('prefooter.php');
}
?>
<footer id="pagefooter" class="site-footer">
<?php
if(isset(Config::FOOTER['columns']) && is_array(Config::FOOTER['columns']) ) : 

    if(isset(Config::FOOTER['columns']['footer_one']) && is_array(Config::FOOTER['columns']['footer_one']) ){
        echo '<div class="column column-one">';
        $footerone = Config::FOOTER['columns']['footer_one'];
        foreach($footerone as $section ){
            if(is_array($section)){
                if(isset($section['menu']) && $section['menu'] !== false ){
                    $menu = $section['menu'];
                    if( \has_nav_menu( $menu ) ){
                        \wp_nav_menu(
                            array(
                                'theme_location'  => $menu,
                                'menu_class'      => 'menu-wrapper',
                                'container_class' => 'footer-menu-container',
                                'items_wrap'      => '<ul id="footer-one-menu-list" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => false,
                            )
                        );
                    }
                }
            } else {
                switch($section){
                    
                    case("logo") : 
                        $flogo = \get_theme_mod('footer_one_logo');
                        if( $flogo ){
                
                            echo '<div class="site-logo"><img src="' . $flogo . '" alt="' . Config::NICENAME . '" /></div>';
                        
                        } else if( \has_custom_logo() ) {
                            echo '<div class="site-logo">' . the_custom_logo() . '</div>';
                        }
                    break;
                    case("title") : 
                        $title = \get_theme_mod('footer_one_title');

                        if($title){ echo '<h3 class="footer-title">' . $title . '</h3>'; }
                    break;
                    case("textarea") : 
                        $text = \get_theme_mod('footer_one_textarea');

                        if($text){ echo '<div class="footer-text">' . $text . '</div>'; }
                    break;
                    case("social_links") :
                        if( \get_theme_mod('footer_one_social')) :
                            if(Config::SOCIAL && is_array(Config::SOCIAL)){
                                $social_link_list = array();
                                foreach(Config::SOCIAL as $name => $bool){
                                    if($bool) {
                                        $icon = \get_theme_mod($name . '_icon') ? \get_theme_mod($name . '_icon') : \get_template_directory_uri() . '/theme/assets/icons/' . $name . '.svg';
                                        $link = \get_theme_mod($name . '_url');
                                        if($link) $social_link_list[$name] = array('icon'=>$icon, 'link'=> $link);
                                    }
                                }
                                if(!empty($social_link_list)){
                                    ?>
                                    <ul class="footer-social-links">
                                        <?php foreach($social_link_list as $name => $props){
                                            echo '<li class="' . $name . '"><a target="_blank" href="'. $props['link'] .'"><img class="social-icon" src="'.$props['icon'].'" alt="'.$name.' icon" /></a></li>';
                                        } ?>
                                    </ul>
                                    <?php
                                }
                                
                            }
                    
                        endif;
                    break;
                }
            }
        }
        echo '</div>';
        #End Column One
    }

    if(isset(Config::FOOTER['columns']['footer_two']) && is_array(Config::FOOTER['columns']['footer_two']) ){
        echo '<div class="column column-two">';
        $footertwo = Config::FOOTER['columns']['footer_two'];
        foreach($footertwo as $section ){
            if(is_array($section)){
                if(isset($section['menu']) && $section['menu'] !== false ){
                    $menu = $section['menu'];
                    if( \has_nav_menu( $menu ) ){
                        \wp_nav_menu(
                            array(
                                'theme_location'  => $menu,
                                'menu_class'      => 'menu-wrapper',
                                'container_class' => 'footer-menu-container',
                                'items_wrap'      => '<ul id="footer-one-menu-list" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => false,
                            )
                        );
                    }
                }
            } else {
                switch($section){
                    case("logo") : 
                        $flogo = \get_theme_mod('footer_two_logo');
                        if( $flogo ){
                
                            echo '<div class="site-logo"><img src="' . $flogo . '" alt="' . Config::NICENAME . '" /></div>';
                        
                        } else if( \has_custom_logo() ) {
                            echo '<div class="site-logo">' . the_custom_logo() . '</div>';
                        }
                    break;
                    case("title") : 
                        $title = \get_theme_mod('footer_two_title');

                        if($title){ echo '<h3 class="footer-title">' . $title . '</h3>'; }
                    break;
                    case("textarea") : 
                        $text = \get_theme_mod('footer_two_textarea');

                        if($text){ echo '<div class="footer-text">' . $text . '</div>'; }
                    break;
                    case("social_links") :
                        if( \get_theme_mod('footer_two_social')) :
                            if(Config::SOCIAL && is_array(Config::SOCIAL)){
                                $social_link_list = array();
                                foreach(Config::SOCIAL as $name => $bool){
                                    if($bool) {
                                        $icon = \get_theme_mod($name . '_icon') ? \get_theme_mod($name . '_icon') : \get_template_directory_uri() . '/theme/assets/icons/' . $name . '.svg';
                                        $link = \get_theme_mod($name . '_url');
                                        if($link) $social_link_list[$name] = array('icon'=>$icon, 'link'=> $link);
                                    }
                                }
                                if(!empty($social_link_list)){
                                    ?>
                                    <ul class="footer-social-links">
                                        <?php foreach($social_link_list as $name => $props){
                                            echo '<li class="' . $name . '"><a target="_blank" href="'. $props['link'] .'"><img class="social-icon" src="'.$props['icon'].'" alt="'.$name.' icon" /></a></li>';
                                        } ?>
                                    </ul>
                                    <?php
                                }
                                
                            }
                    
                        endif;
                    break;
                }
            }
        }
        echo '</div>';
        #End Column Two
    }

    if(isset(Config::FOOTER['columns']['footer_three']) && is_array(Config::FOOTER['columns']['footer_three']) ){
        echo '<div class="column column-three">';
        $footerthree = Config::FOOTER['columns']['footer_three'];
        foreach($footerthree as $section ){
            if(is_array($section)){
                if(isset($section['menu']) && $section['menu'] !== false ){
                    $menu = $section['menu'];
                    if( \has_nav_menu( $menu ) ){
                        \wp_nav_menu(
                            array(
                                'theme_location'  => $menu,
                                'menu_class'      => 'menu-wrapper',
                                'container_class' => 'footer-menu-container',
                                'items_wrap'      => '<ul id="footer-one-menu-list" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => false,
                            )
                        );
                    }
                }
            } else {
                switch($section){
                    case("logo") : 
                        $flogo = \get_theme_mod('footer_three_logo');
                        if( $flogo ){
                
                            echo '<div class="site-logo"><img src="' . $flogo . '" alt="' . Config::NICENAME . '" /></div>';
                        
                        } else if( \has_custom_logo() ) {
                            echo '<div class="site-logo">' . the_custom_logo() . '</div>';
                        }
                    break;
                    case("title") : 
                        $title = \get_theme_mod('footer_three_title');

                        if($title){ echo '<h3 class="footer-title">' . $title . '</h3>'; }
                    break;
                    case("textarea") : 
                        $text = \get_theme_mod('footer_three_textarea');

                        if($text){ echo '<div class="footer-text">' . $text . '</div>'; }
                    break;
                    case("social_links") :
                        if( \get_theme_mod('footer_three_social')) :
                            if(Config::SOCIAL && is_array(Config::SOCIAL)){
                                $social_link_list = array();
                                foreach(Config::SOCIAL as $name => $bool){
                                    if($bool) {
                                        $icon = \get_theme_mod($name . '_icon') ? \get_theme_mod($name . '_icon') : \get_template_directory_uri() . '/theme/assets/icons/' . $name . '.svg';
                                        $link = \get_theme_mod($name . '_url');
                                        if($link) $social_link_list[$name] = array('icon'=>$icon, 'link'=> $link);
                                    }
                                }
                                if(!empty($social_link_list)){
                                    ?>
                                    <ul class="footer-social-links">
                                        <?php foreach($social_link_list as $name => $props){
                                            echo '<li class="' . $name . '"><a target="_blank" href="'. $props['link'] .'"><img class="social-icon" src="'.$props['icon'].'" alt="'.$name.' icon" /></a></li>';
                                        } ?>
                                    </ul>
                                    <?php
                                }
                                
                            }
                    
                        endif;
                    break;
                }
            }
        }
        echo '</div>';
        #End Column Three
    }
    if(isset(Config::FOOTER['columns']['footer_four']) && is_array(Config::FOOTER['columns']['footer_four']) ){
        echo '<div class="column column-four">';
        $footerfour = Config::FOOTER['columns']['footer_four'];
        foreach($footerfour as $section ){
            if(is_array($section)){
                if(isset($section['menu']) && $section['menu'] !== false ){
                    $menu = $section['menu'];
                    if( \has_nav_menu( $menu ) ){
                        \wp_nav_menu(
                            array(
                                'theme_location'  => $menu,
                                'menu_class'      => 'menu-wrapper',
                                'container_class' => 'footer-menu-container',
                                'items_wrap'      => '<ul id="footer-one-menu-list" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => false,
                            )
                        );
                    }
                }
            } else {
                switch($section){
                    case("logo") : 
                        $flogo = \get_theme_mod('footer_four_logo');
                        if( $flogo ){
                
                            echo '<div class="site-logo"><img src="' . $flogo . '" alt="' . Config::NICENAME . '" /></div>';
                        
                        } else if( \has_custom_logo() ) {
                            echo '<div class="site-logo">' . the_custom_logo() . '</div>';
                        }
                    break;
                    case("title") : 
                        $title = \get_theme_mod('footer_four_title');

                        if($title){ echo '<h3 class="footer-title">' . $title . '</h3>'; }
                    break;
                    case("textarea") : 
                        $text = \get_theme_mod('footer_four_textarea');

                        if($text){ echo '<div class="footer-text">' . $text . '</div>'; }
                    break;
                    case("social_links") :
                        if( \get_theme_mod('footer_four_social')) :
                            if(Config::SOCIAL && is_array(Config::SOCIAL)){
                                $social_link_list = array();
                                foreach(Config::SOCIAL as $name => $bool){
                                    if($bool) {
                                        $icon = \get_theme_mod($name . '_icon') ? \get_theme_mod($name . '_icon') : \get_template_directory_uri() . '/theme/assets/icons/' . $name . '.svg';
                                        $link = \get_theme_mod($name . '_url');
                                        if($link) $social_link_list[$name] = array('icon'=>$icon, 'link'=> $link);
                                    }
                                }
                                if(!empty($social_link_list)){
                                    ?>
                                    <ul class="footer-social-links">
                                        <?php foreach($social_link_list as $name => $props){
                                            echo '<li class="' . $name . '"><a target="_blank" href="'. $props['link'] .'"><img class="social-icon" src="'.$props['icon'].'" alt="'.$name.' icon" /></a></li>';
                                        } ?>
                                    </ul>
                                    <?php
                                }
                                
                            }
                    
                        endif;
                    break;
                }
            }
        }
        echo '</div>';
        #End Column Four
    }
    


endif;
?>
</footer>
<div class="row footer-menu-bottom">
    <ul class="footerbottom">
        <?php 
        if( \get_theme_mod('footer_bottom_add_copyright')){
            echo '<li>Copyright ©' . Date('Y') . ' Beyond Menu</li>';
            # bloginfo( 'name' );
        }
        
        if( \get_theme_mod( 'footer_bottom_add_privacy_policy' ) ) {
            echo '<li><a href="' . \get_privacy_policy_url() . '">' . __( 'Privacy Policy', Config::TEXTDOMAIN ) . '</a></li>';
        }
        if (!function_exists('is_plugin_active')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        if( \is_plugin_active( 'wordpress-seo' )) {

            if( \get_theme_mod( 'footer_bottom_add_sitemap' ) ){
                echo '<li><a href="' . \get_home_url() . '/sitemap_index.xml">' . __( 'Sitemap', Config::TEXTDOMAIN ) . '</a></li>';
            }
        }
        echo '</ul>';
        #Check for Menus
        if(isset(Config::FOOTER['bottom']) && is_array(Config::FOOTER['bottom']) ){
            foreach(Config::FOOTER['bottom'] as $section ){
                if(is_array($section)){
                    if(isset($section['menu'])){
                        $menu = $section['menu'];
                        if($menu){
                            if( \has_nav_menu( $menu ) ){
                                \wp_nav_menu(
                                    array(
                                        'theme_location'  => $menu,
                                        'menu_class'      => 'menu-wrapper',
                                        'container_class' => 'footer-bottom-container',
                                        'items_wrap'      => '<ul id="footer-bottom-menu-list" class="%2$s">%3$s</ul>',
                                        'fallback_cb'     => false,
                                    )
                                );
                            }                            
                        }
                    }
                }
            }
        }

        ?>
</div>