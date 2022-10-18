<?php
namespace <!PLUGINPATH->;
Class Config {
    const VERSION = "1.0.1";
    const MODE = "development";
    const TEXTDOMAIN = "<!PLUGINPATH->_<!PLUGINNAME->";
    const NICENAME = "<!HUMANREADABLE->";

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
            'type'=> 'page'
        ),
    );
    const INTEGRATIONS = array( 
        'ActiveCampaign' => false,
        'GoogleAnalytics' => false,
        'MailChimp' => false,
        'GoogleMaps' => false,
        'Slack' => false,
        'ContactForm7' => false,
    );

    const FEATURES = array(
        'critical_css' => false,
        'video_headers' => false,
        'progressive_header' => false,
    );

    #const ROLES = false;
    const ROLES = false;

    const BLOCKS = array(
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
}