<?php
namespace rbt;
Class Config {
    const VERSION = "1.0.1";
    const MODE = "development";
    const TEXTDOMAIN = "rbt_FRStarter";
    const NICENAME = "Starter";

    const BREAKPOINTS = array(
        'phone' => 576,
        'tablet' => 768,
        'laptop' => 992,
        'desktop' => 1200,
    );


    /* CONFIG */
    const POST_TYPES = false;

    const SOCIAL = array(
        'facebook' => true,
        'linkedin' => true,
        'instagram' => true,
        'youtube' => false,
        'twitter' => true, 
        'github' => false,
    );

    const TAXONOMIES = false;

    const TABLES = false;

    const PAGES = array(
        'contact-us' => array(
            'title'=> 'Contact Us',
            'type'=> 'page',
            'menu' => array('primary', 'mobile', 'footer_two' ),
        ),
        'about' => array(
            'title'=> 'About Us',
            'type'=> 'page',
            'menu' => array('primary', 'mobile', 'footer_two' )
        ),
    );
    const INTEGRATIONS = array( 
        'ActiveCampaign' => false,
        'GoogleAnalytics' => true,
        'MailChimp' => false,
        'GoogleMaps' => false,
        'Slack' => false,
        'ContactForm7' => true,
    );

    const FEATURES = array(
        'critical_css' => false,
        'video_headers' => false,
        'progressive_header' => true,
    );

    #@TODO - CUSTOMIZER (PREFOOTER, HEADER, FOOTER fields)

    #const ROLES = false;
    const ROLES = false;

    const BLOCKS = array(
       # 'cta-cards' => 'Call to Action Cards'
    );
    /* THIS WORKS WITH THE CUSTOMIZER MENU TO DESCRIBE THE SITE FOOTER */
    const FOOTER = array(
        'prefooter' => array('title', 'image', 'textarea','shortcode'),
        'columns'=>array(
            'footer_one'=> array('logo', 'textarea', 'social_links'),
            'footer_two'=> array('title', array('menu'=>'footer_two') ),
            'footer_three'=>array('title', array('menu'=>'footer_three') ),
          #  'footer_four'=> array('title', 'textarea')
        ),
        'bottom' => array(
            'copyright', 
            array('menu'=> 'footer_bottom'), 
            
        ),
    );
    /* THIS WORKS WITH THE CUSTOMIZER CLASS TO DESCRIBE THE SITE HEADER */
    const HEADER = array(
        'logo' => true,
        'menu' => array('primary', 'mobile'),
        'right' => array('login', 'phone', 'cta'),
    );
    const MENUS = array(
        'primary' => array(
            'name'=> 'Top Menu',
            'location'=> 'primary',
            'bootstrap_markup' => false,
            'fulltime_hamburger' => false,
            'depth' => 1,
            'header' => true,
            'footer' => false,
            'sidebar' => false
        ),
        'mobile' => array(
            'name'=> 'Mobile',
            'location'=> 'mobile',
            'bootstrap_markup' => false,
            'fulltime_hamburger' => false,
            'depth' => 1,
            'header' => true,
            'footer' => false,
            'sidebar' => false
        ),
        'footer_two' => array(
            'name'=> 'Footer Two',
            'location'=> 'footer_two',
            'bootstrap_markup' => false,
            'depth' => 1,
            'header'=> false,
            'footer'=> true,
            'sidebar'=> false
        ),
        'footer_bottom' => array(
            'name' => 'Footer Bottom',
            'location'=> 'footer_bottom',
            'bootstrap_markup' => false,
            'depth' => 1,
            'header'=> false,
            'footer'=> true,
            'sidebar'=> false
        )

    );
    /* ROUTING */

    const TEMPLATES = false;
}