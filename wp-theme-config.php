<?php
namespace tpt;
Class Config {
    const VERSION = "1.0.2";
    const MODE = "development";
    const TEXTDOMAIN = "beyond_menu";
    const NICENAME = "Beyond Menu";

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

    const PAGES = array(
        'phone-ordering' => array(
            'title'=> 'Phone Ordering',
            'type'=> 'page'
        ),
        'online-ordering' => array(
            'title'=> 'Online Ordering',
            'type'=> 'page'
        ),
        'qr-codes' => array(
            'title'=> 'QR Codes',
            'type'=> 'page'
        ),
        'contact-us' => array(
            'title'=> 'Contact Us',
            'type'=> 'page'
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
        'critical_css' => true,
        'video_headers' => true,
        'progressive_header' => false
    );

    #const ROLES = false;
    const ROLES = false;

    const BLOCKS = array(
        'twocolums' => 'Two Columns Image Right or Left',
        'twocol-left' => 'Single Image and Text Two Columns',
        'how-it-works' => 'How it Works',
        'how-it-works-step' => 'How it Works Step',
        'info-carts' => 'Info Cards',
        'info-icons' => 'Info Icons',
        'accordions' => 'Accordions',
        'gallery-strip' => 'Gallery Strip',
        'cta-cards' => 'Call to Action Cards'
    );
    const MENUS = array(
        'primary' => array(
            'name'=> 'Top Menu',
            'location'=> 'primary',
            'bootstrap_markup' => true,
            'fulltime_hamburger' => false,
            'depth' => 1,
            'header' => true,
            'footer' => false,
            'sidebar' => false
        ),
        'footer' => array(
            'name'=> 'Footer Menu',
            'location'=> 'footer',
            'bootstrap_markup' => true,
            'depth' => 1,
            'header'=> false,
            'footer'=> true,
            'sidebar'=> false
        ),
        'footer_two' => array(
            'name'=> 'Footer Two',
            'location'=> 'footer_two',
            'bootstrap_markup' => true,
            'depth' => 1,
            'header'=> false,
            'footer'=> true,
            'sidebar'=> false
        ),
        'footer_three' => array(
            'name'=> 'Footer Three',
            'location'=> 'footer_three',
            'bootstrap_markup' => true,
            'depth' => 1,
            'header'=> false,
            'footer'=> true,
            'sidebar'=> false
        ),
    );
    /* ROUTING */

    const TEMPLATES = false;
    const HAS_DESKTOP_MENU_BUTTON = true;
}