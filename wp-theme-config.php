<?php
namespace rbtddb;
Class Config {
    const VERSION = "1.0.1";
    const MODE = "development";
    const TEXTDOMAIN = "rbt_ddb_DDBali";
    const NICENAME = "Daily Driver Bali";

    const BREAKPOINTS = array(
        'phone' => 576,
        'tablet' => 768,
        'laptop' => 992,
        'desktop' => 1200,
    );


    /* CONFIG */
    const POST_TYPES = array(
        'Trips' => array(
            'singular'=> 'trip'
        )
    );

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
        'trips' => array(
            'title'=> 'Popular Trips',
            'type'=> 'page',
            'menu' => array('primary', 'mobile', 'footer_two' )
        ),
        'monkey-forest-ubud' => array(
            'title'=> 'Monkey Forest Ubud',
            'type'=> 'trips', 
            'content'=> 'Monkeys. Lots and lots of monkeys.',
        ),
        'campuhan-ridge-walk' => array(
            'title'=> 'Campuhan Ridge Walk',
            'type'=> 'trips', 
            'content'=> 'Sunrise and Sunset trekking with scenic forests',
        ),
        'saraswati-temple' => array(
            'title'=> 'Saraswati Temple',
            'type'=> 'trips', 
            'content'=> 'Scenic Hindu temple with a lotus pond',
        ),
        'tegallalang-rice-terrace' => array(
            'title'=> 'Tegallalang Rice Terrace',
            'type'=> 'trips', 
            'content'=> 'Traditionally farmed terraces carved into a scenic hillside',
        ),
        'goa-gajah' => array(
            'title'=> 'Goa Gajah',
            'type'=> 'trips', 
            'content'=> 'Cave famed for its ancient carvings',
        ),
        'ubud-palace' => array(
            'title'=> 'Ubud Palace',
            'type'=> 'trips', 
            'content'=> 'Ancient temple in the center of Ubud',
        ),
        'blanco-renaissance-museum' => array(
            'title'=> 'The Blanco Renaissance Museaum',
            'type'=> 'trips', 
            'content'=> 'Public garden with exotic birds',
        ),
        'hidden-canyon' => array(
            'title'=> 'Hidden Canyon Trek',
            'type'=> 'trips', 
            'content'=> 'An amazing seasonal trek of the narrow canyon with white water running through rocky cliffs',
        ),
        'waterfall-tegenungan' => array(
            'title'=> 'Tegenungan Waterfall',
            'type'=> 'trips', 
            'content'=> 'Popular waterfall with a temple and swimming area',
        ),
        'kanto-lampo-waterfall' => array(
            'title'=> 'Kanto Lampo Waterfall',
            'type'=> 'trips', 
            'content'=> 'Rocky waterfall in the forests of central Bali.',
        ),
        'singsing-waterfall' => array(
            'title'=> 'Singsing Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'banjar-hot-springs' => array(
            'title'=> 'Banjar Hot Springs',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'layana-waterfall' => array(
            'title'=> 'Layana Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'tibumana-waterfall' => array(
            'title'=> 'Tibumana Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'pengibul-waterfall' => array(
            'title'=> 'Pengibul Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'taman-sari-waterfall' => array(
            'title'=> 'Taman Sari Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'suwat-waterfall' => array(
            'title'=> 'Suwat Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'sumampan-waterfall' => array(
            'title'=> 'Sumampan Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'beji-griya-waterfall' => array(
            'title'=> 'Beji Griya Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'nungnung-waterfall' => array(
            'title'=> 'Nungnung Waterfall',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'tanah-lot-temple' => array(
            'title'=> 'Tanah Lot Temple',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'berawa-beach' => array(
            'title'=> 'Berawa Beach',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'kuta-beach' => array(
            'title'=> 'Kuta Beach',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'jimbaran-beach' => array(
            'title'=> 'Jimbaran Beach',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'sanur-beach' => array(
            'title'=> 'Sanur Beach',
            'type'=> 'trips', 
            'content'=> '',
        ),
        'tabanan-beach' => array(
            'title'=> 'Tabanan Beach',
            'type'=> 'trips', 
            'content'=> '',
        ),

    );
    const INTEGRATIONS = array( 
        'ActiveCampaign' => false,
        'GoogleAnalytics' => true,
        'MailChimp' => false,
        'GoogleMaps' => false,
        'Slack' => false,
        'ContactForm7' => true,
        'Figma' => true,
        'WhatsApp'=> true,
        'WooCommerce' => true,
    );

    #Progressive Header needs aspect ratio w & h and minimum mobile height

    const FEATURES = array(
        'critical_css' => false,
        'video_headers' => true,
        'progressive_header' => array(
            'home' => array('w' =>480, 'h'=>227, 'minHeight'=>400),
            'page' => array('w'=>480, 'h'=>161, 'minHeight'=>200),
            'custom' => array('slug'=>'checkout','w'=>40, 'h'=>9 , 'minHeight'=>100, 'filters'=>'darken'),
            'default' => array('w'=>480, 'h'=>'auto', 'minHeight'=>400),
        )
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
       // 'right' => array('login', 'phone', 'cta'),
       'right' => array('cta'=>true),
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