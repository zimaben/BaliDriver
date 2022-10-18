<?php 
use \<!PLUGINPATH->\Config as Config;

if(\get_theme_mod('footer_bgcolor') && \get_theme_mod('footer_is_bgcolor')){
    $style = ' style="background-color: ' . \get_theme_mod('footer_bgcolor') .'"';
} else {
    $style = '';
}
?>
<footer id="pagefooter" class="site-footer"<?php echo $style; ?>>
    <div class="column-one">
        <!-- logo -->
        <!-- start with Customizer -->
        <?php 
        $flogo = \get_theme_mod('footer_img');
        if( $flogo ){

            echo '<div class="site-logo"><img src="' . $flogo . '" alt="' . \get_bloginfo('name') . '" /></div>';
        
        } else if( \has_custom_logo() ) {
            echo '<div class="site-logo">' . the_custom_logo() . '</div>';
        }

        $text = \get_theme_mod('footer_text');

        if($text){ echo '<div class="footer-copy">' . $text . '</div>'; }

        if( \get_theme_mod('footer_add_social')) :
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

        ?>
    </div>
    <div class="column-two">
        <div class="column-two-content">
            <?php if(\get_theme_mod('footer_two_title')) echo '<h3>'. \get_theme_mod('footer_two_title') . '</h3>'; ?>
            <!-- nav -->
            <?php if ( \has_nav_menu( 'footer' ) ) : ?>
            <nav class="footer-navigation">
                <ul class="footer-navigation-list">
                    <?php
                        \wp_nav_menu(
                            array(
                                'theme_location' => 'footer',
                                'items_wrap'     => '%3$s',
                            #    'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'container'      => false,
                                'depth'          => 1,
                                'link_before'    => '<span>',
                                'link_after'     => '</span>',
                                'fallback_cb'    => false,
                            )
                        );
                        ?>
                </ul><!-- .footer-navigation-wrapper -->
            </nav><!-- .footer-navigation -->
            <?php endif; ?>
        </div>

    </div>
    <div class="column-three">
        <div class="column-three-content">
        <?php if(\get_theme_mod('footer_three_title')) echo '<h3>'. \get_theme_mod('footer_three_title') . '</h3>'; ?>
            <!-- nav -->
            <?php if ( \has_nav_menu( 'footer_three' ) ) : ?>
            <nav class="footer-navigation">
                <ul class="footer-navigation-list">
                    <?php
                        \wp_nav_menu(
                            array(
                                'theme_location' => 'footer_three',
                                'items_wrap'     => '%3$s',
                            #    'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'container'      => false,
                                'depth'          => 1,
                                'link_before'    => '<span>',
                                'link_after'     => '</span>',
                                'fallback_cb'    => false,
                            )
                        );
                        ?>
                </ul><!-- .footer-navigation-wrapper -->
            </nav><!-- .footer-navigation -->
            <?php endif; ?>

        </div>
    </div>
    <div class="column-four">
        <div class="column-four-content">
        <?php if(\get_theme_mod('footer_four_title')) echo '<h3>'. \get_theme_mod('footer_four_title') . '</h3>'; ?>
            <!-- nav -->
            <?php if ( \has_nav_menu( 'footer_four' ) ) : ?>
            <nav class="footer-navigation">
                <ul class="footer-navigation-list">
                    <?php
                        \wp_nav_menu(
                            array(
                                'theme_location' => 'footer_four',
                                'items_wrap'     => '%3$s',
                            #    'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'container'      => false,
                                'depth'          => 1,
                                'link_before'    => '<span>',
                                'link_after'     => '</span>',
                                'fallback_cb'    => false,
                            )
                        );
                        ?>
                </ul><!-- .footer-navigation-wrapper -->
            </nav><!-- .footer-navigation -->
            <?php endif;
            #contact Form
            $contactform = \get_theme_mod( 'footer_default_contact_shortcode', true);
            
            if( $contactform ) : 
                $html = \do_shortcode($contactform);
                if($html !== $contactform){ # if the shortcode produced markup, show it
                    ?>
                        <div class="contact">
                            <?php echo \do_shortcode($contactform); ?>
                        </div>
                    <?php
                }
            endif;

            ?>
        </div>
    </div>
</footer>
<div class="row footer-menu-bottom">
    <ul class="footerbottom">
        <?php 
        if( \get_theme_mod('footer_add_copyright')){
            echo '<li>Copyright ©' . Date('Y') . ' Beyond Menu</li>';
            # bloginfo( 'name' );
        }
        
        if( \get_theme_mod( 'footer_add_privacy_policy' ) ) {
            echo '<li><a href="' . \get_privacy_policy_url() . '">' . __( 'Privacy Policy', Config::TEXTDOMAIN ) . '</a></li>';
        }
        if (!function_exists('is_plugin_active')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        if( \is_plugin_active( 'wordpress-seo' )) : 

            if( \get_theme_mod( 'footer_add_sitemap' ) ){
                echo '<li><a href="' . \get_home_url() . '/sitemap_index.xml">' . __( 'Sitemap', Config::TEXTDOMAIN ) . '</a></li>';
            }
        
        endif;

        ?>
    </ul>
</div>