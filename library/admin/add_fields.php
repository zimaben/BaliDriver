<?php
namespace rbt\admin; 
use \rbt\FRStarter as Theme;
use \Carbon_Fields\Field as Field;
use \Carbon_Fields\Container as Container;
use \rbt\Config as Config;

/* 
 * The Builder is for Shared Resources like Options pages where 
 * we need to assemble content types into a shared view.
 *
*/
    
class AddFields extends Theme {


    private static $instance = null;

    public static function get_instance() {

        if ( null == self::$instance ) {

            self::$instance = new self;
        }

        return self::$instance;
    }
    
    private function __construct() {

        \add_action('carbon_fields_register_fields', array( get_class(), 'add_meta_fields'), 1 ); //add fields

    }

    public static function add_meta_fields(){

        if( class_exists('\Carbon_Fields\Container')){

            \add_action('carbon_fields_register_fields', array(get_class(), 'add_options_menu_cf' ) );//add options page
            \add_action('carbon_fields_register_fields', array(get_class(), 'add_page_fields' ) );

            

        }
        
    }
    public static function add_page_fields(){
        if(
            ( isset(Config::FEATURES['progressive_header']) && Config::FEATURES['progressive_header'] !== false ) ||
            ( isset(Config::FEATURES['video_header']) && Config::FEATURES['video_header'] == true ) ) : 
  
            Container::make( 'post_meta', 'Page Header Fields' )
            ->show_on_post_type(array('page'))
            ->set_context('side')
            ->add_fields( array(
                Field::make( 'checkbox', 'crb_prefooter', 'Add The PreFooter Form?' )
                ->set_option_value( 'yes' ),
                Field::make( 'image', 'crb_mobile_image', 'Mobile Featured Image'), 
                Field::make( 'file', 'crb_featured_video', 'Featured Video' )
                    ->set_type( 'video' )
                    ->set_value_type( 'url' ),
                Field::make( 'file', 'crb_mobile_featured_video', 'Mobile Featured Video' )
                    ->set_type( 'video' )
                    ->set_value_type( 'url' ),
                Field::make( 'textarea', 'crb_header_text', 'Header Overlay'),

                Field::make( 'text', 'crb_button_text', 'Button Text (Optional)'),
                Field::make( 'text', 'crb_button_url', 'Button URL'),
                
                
            ));

        endif;

        Container::make( 'post_meta', 'Reviews' )
        ->show_on_post_type(array('page','post'))
        ->add_fields( array(
            Field::make( 'complex', 'page_review', 'Review Module' )
            ->add_fields( array(
                Field::make( 'text', 'reviewer_name', 'Reviewer Name' )
                ->set_help_text('Full Name - Ex: Dr. Howard MD'),
                Field::make( 'text', 'reviewer_title', 'Job Title'),
                Field::make( 'image', 'reviewer_photo', 'Photo' )
                ->set_value_type( 'url' ),
                Field::make( 'text', 'review_title', 'Review Title'),
                Field::make( 'select', 'review_stars', 'Stars' )
                ->add_options( array(
                    'one' => '1 Star',
                    'two' => '2 Star',
                    'three' => '3 Star',
                    'four' => '4 Star',
                    'five' => '5 Star',
                ) ),
                Field::make( 'textarea', 'review_body', 'Review'),
            ))
        ));

        Container::make( 'post_meta', 'Scroll Links' )
        ->show_on_post_type(array('page','post'))
        ->add_fields( array(
            Field::make( 'complex', 'page_scroll_links', 'Scroll Links' )
            ->add_fields( array(
                Field::make( 'text', 'scroll_link_title', 'Link Title' ),
                Field::make( 'text', 'scroll_anchor', 'Link Anchor')
                ->set_help_text('Ex: #about-us'),

            ))
        ));

        Container::make( 'post_meta', 'Pre-Footer Contact Form' )
        ->show_on_post_type(array('page','post', 'locations'))
        ->add_fields( array(
            Field::make( 'text', 'prefooter_contactform', 'Pre-Footer Contact Form Shorcode' )
                ->set_help_text( 'Paste the Shortcode for the Contact Form that you see in the Contact Form tab in the admin' ),
        ));
    }
    public static function add_options_menu_cf(){

       $optionsPage =  Container::make( 'theme_options', __( Config::NICENAME . ' Options', Config::TEXTDOMAIN ) )
        ->set_icon( 'dashicons-admin-generic' )
        ->set_page_menu_title( Config::NICENAME . ' Options' );

        if( isset(Config::INTEGRATIONS['AWS']) && Config::INTEGRATIONS['AWS'] == true) : 

        $optionsPage->add_tab( 'AWS Settings', array(

            Field::make( 'text', 'aws_etc_region', 'Region' )
                ->set_help_text( 'Region key ( ex: us-east-1 )' ),
            Field::make( 'text', 'aws_etc_pipeline', 'Pipeline ID' )
                ->set_help_text( 'Key to the Elastic Transcoder Pipeline to use' ),

            Field::make( 'text', 'aws_etc_user_name', 'User Name' )
                ->set_help_text( 'The user name is not used programatically, but is included here for easy reference' ),
            Field::make( 'text', 'aws_etc_user_key', 'Key' )
                ->set_help_text( 'Key for the User account using the Elastic Transcoder' ),
            Field::make( 'text', 'aws_etc_user_secret', 'Secret Key' )
                ->set_help_text( 'Secret Key ' )
                ->set_attribute( 'type', 'password' ),

        ));
        endif;
        if( isset(Config::INTEGRATIONS['Slack']) && Config::INTEGRATIONS['Slack'] == true) : 
   
        $optionsPage->add_tab( 'Slack', array(

            Field::make( 'complex', 'slack_bots', 'Slack Integrations' )
                ->add_fields( array(
                    Field::make( 'text', 'slack_bot_name', 'Bot Name' )
                    ->set_help_text('Example: Sorce License Bot-Flexport'),
                    Field::make( 'text', 'slack_bot_channel', 'Channel to Post to')
                    ->set_help_text('Without the # please'),
                    Field::make( 'text', 'slack_bot_customer_id', 'Sorce Customer ID'),
                    Field::make( 'text', 'slack_bot_webhook', 'Webhook')
                ) ),
 
        ));
        endif;
        if( isset(Config::INTEGRATIONS['ActiveCampaign']) && Config::INTEGRATIONS['ActiveCampaign'] == true) : 
        $optionsPage->add_tab( 'Active Campaign', array(

            Field::make( 'text', 'ac_api_key', 'ActiveCampaign API Key')
            ->set_attribute( 'type', 'password' ),
            Field::make( 'text', 'ac_account_name', 'Account Name'),
            Field::make( 'text', 'ac_custom_field_id', 'Custom Field ID (Leave Empty to Create)')
                ->set_help_text( 'Leave this field empty and give Custom Field Title a value to create a new custom field' ),
            Field::make( 'text', 'ac_custom_field_title', 'Custom Field Title'),
            Field::make( 'textarea', 'ac_custom_field_description', 'Custom Field description (optional)'),
            Field::make( 'text', 'ac_custom_field_default', 'Custom Field default value (optional)')
 
        ));

        endif;
        if( isset(Config::INTEGRATIONS['Figma']) && Config::INTEGRATIONS['Figma'] == true) : 
        $optionsPage->add_tab( 'Figma', array(
            Field::make( 'text', 'figma_api_key', 'Figma API Key')
            ->set_attribute( 'type', 'password' ),
            Field::make( 'text', 'figma_design_id', 'Design File ID (text string inside URL)'),
            Field::make('html', 'figma_test_connection')
            ->set_help_text( 'Test Figma Connection' )
            ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="figmatest">Test Connection</button></div>' ),
            Field::make('html', 'figma_import_styleguide')
            ->set_help_text( 'Import Figma Design File' )
            ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="figmaimportbutton" data-item="Colors">Import File</button></div>' ),
            // Field::make('html', 'figma_test_colors')
            // ->set_help_text( 'Test Colors' )
            // ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="figmatestitem" data-item="Colors">Test Colors</button></div>' ),
            // Field::make('html', 'figma_get_colors')
            // ->set_help_text( 'Get Colors' )
            // ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="figmagetitem" data-item="Colors">Get Colors</button></div>' ),
            // Field::make('html', 'figma_get_typography')
            // ->set_help_text( 'Get Typography' )
            // ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="temptypographybutton" data-item="Typography">Get Typography</button></div>' ),
            // Field::make('html', 'figma_get_logo')
            // ->set_help_text( 'Get Logo' )
            // ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="templogobutton" data-item="Logo">Get Logo</button></div>' ),
        ));
        endif;
        if( isset(Config::INTEGRATIONS['GoogleAnalytics']) && Config::INTEGRATIONS['GoogleAnalytics'] == true) : 
        $optionsPage->add_tab( 'GoogleAnalytics', array(
            Field::make( 'text', 'ga_api_key', 'GoogleAnalytics API Key')
            ->set_attribute( 'type', 'password' ),
            Field::make( 'textarea', 'ga_code_snippet', 'Analytics Code Snippet'),
        ));
        endif;

        if( isset(Config::INTEGRATIONS['GoogleMaps']) && Config::INTEGRATIONS['GoogleMaps'] == true) : 
            $optionsPage->add_tab( 'GoogleMaps', array(
                Field::make( 'text', 'gmap_api_key', 'GoogleMaps API Key')
                ->set_attribute( 'type', 'password' ),
                Field::make('html', 'figma_test_connection')
                ->set_help_text( 'Sync maps data from the database to theme.json' )
                ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="gmap_sync">Sync Map Info</button></div>' ),
            ));
            endif;

        if( isset(Config::INTEGRATIONS['MailChimp']) && Config::INTEGRATIONS['MailChimp'] == true) :
        $optionsPage->add_tab( 'MailChimp', array(
            Field::make( 'text', 'mailchimp_api_key', 'MailChimp API Key')
            ->set_attribute( 'type', 'password' ),
            Field::make( 'textarea', 'gmaps_code_snippet', 'MailChimp Code Snippet'),
        ));         
        endif;

        $optionsPage->add_tab( 'Utilities', array(

            Field::make('html', 'run_first_setup')
            ->set_help_text( 'Run First-time setup (create theme pages, menus, etc.)' )
            ->set_html( '<div class="buttonwrap"><div class="responsearea"></div><button type="button" class="adminbutton btn" id="setupbutton">Run Setup</button></div>' ),

            Field::make('html', 'run_critical_css')
                ->set_help_text( 'Create inline Critical CSS files' )
                ->set_html( '<div class="buttonwrap"><div class="responsearea"><button type="button" class="adminbutton btn" id="criticalcssbutton">Create Critical CSS</button></div>' ),
            
        ));
    }
}
AddFields::get_instance();