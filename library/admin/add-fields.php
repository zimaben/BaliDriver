<?php
namespace <!PLUGINPATH->\admin;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;

use \Carbon_Fields\Block;
use \Carbon_Fields\Container;
use \Carbon_Fields\Field;

class AddFields extends Plugin {


    private static $instance = null;

    public static function get_instance() {

        if ( 
            null == self::$instance 
        ) {

            self::$instance = new self;

        }

        return self::$instance;

    }
    
    private function __construct() {

        \add_action('carbon_fields_register_fields', array( get_class(), 'add_meta_fields'), 1 ); //add fields
      #S  \add_action('carbon_fields_register_fields', array( get_class(), 'add_carbon_blocks'), 1); //add blocks

    }

    public static function add_meta_fields(){

        if( class_exists('\Carbon_Fields\Container')){

           # \add_action('carbon_fields_register_fields', array(get_class(), 'add_options_menu_cf' ) );//add options page
           # \add_action('carbon_fields_register_fields', array(get_class(), 'add_page_fields' ) );

        }
        
    }


    public static function add_page_fields(){
        Container::make( 'post_meta', 'Featured Video' )
        ->show_on_post_type(array('page','post'))
        ->set_context('side')
        ->add_fields( array(
            Field::make( 'file', 'crb_featured_video', 'Featured Video' )
                ->set_type( 'video' )
                ->set_value_type( 'url' ),
            Field::make( 'file', 'crb_mobile_featured_video', 'Mobile Featured Video' )
            ->set_type( 'video' )
            ->set_value_type( 'url' )
        ));


        Container::make( 'post_meta', 'News Source' )
        ->show_on_post_type('post')
        ->add_fields( array(
            Field::make( 'text', 'crb_author_name', 'Name of the News Source' )
        ));
    }
    public static function add_options_menu_cf(){


        Container::make( 'theme_options', __( 'Oak Creek Options', self::textdomain ) )
        ->set_icon( 'dashicons-admin-generic' )
        ->set_page_menu_title( 'themeblockhead' . ' API Options' )
        ->add_tab( 'AWS Elastic Transcoder Settings', array(

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

        ))

        ->add_tab( 'Slack', array(

            Field::make( 'complex', 'slack_bots', 'Slack Integrations' )
                ->add_fields( array(
                    Field::make( 'text', 'slack_bot_name', 'Bot Name' )
                    ->set_help_text('Example: Sorce License Bot-Customer'),
                    Field::make( 'text', 'slack_bot_channel', 'Channel to Post to')
                    ->set_help_text('Without the # please'),
                    Field::make( 'text', 'slack_bot_customer_id', 'Customer ID'),
                    Field::make( 'text', 'slack_bot_webhook', 'Webhook')
                ) ),
 
        ))

        ->add_tab( 'Dashboards', array(

            Field::make( 'complex', 'dashboards_company', 'Companies' )
                ->set_help_text( 'Add dashboard settings for each Company' )
                    ->add_fields( array(
                    Field::make( 'text', 'dashboards_company_id', 'Company ID (Must match database)' ),
                    Field::make( 'text', 'dashboards_company_name', 'Company Name'),
                    Field::make( 'text', 'dashboards_dashboard_url', 'URL to the Plotly Dashboard'),
                ) ),
 
        ))
        ->add_tab( 'Utilities', array(


            Field::make('html', 'run_customer_categories')
                ->set_help_text( 'Create Exclusive Content - Customer Categories (Run when we have new Customers)' )
                ->set_html( '<button class="transcode_umeta" " onclick="create_customer_categories(event)">Create Customer Categories</button>' ),
            
            Field::make('html', 'create_meta_files')
                ->set_help_text( 'Choose File Type to generate files for' )
                ->set_html( '
                    <div id="sorceapi_create_meta_wrap">
                    <div id="sorceapi_create_meta_files_area" data-action="check_for_transcriptionfiles"></div>
                    <div id="sorceapi_file_repo"></div>
                      <p>Create Transcriptions and Audio/Video Meta:</p>
                        <input type="radio" id="sorceapi_which_audio" name="sorceapi_which" value="audio">
                        <label for="audio">Audio</label><br>
                        <input type="radio" id="sorceapi_which_video" name="sorceapi_which" value="video">
                        <label for="css">Video</label><br>
                    <button class="transcode_umeta" " onclick="create_meta_files(event)">Create Files (will take a lot of time)</button></div>' )
            

        )); 
                   
    }
}
\<!PLUGINPATH->\admin\AddFields::get_instance();