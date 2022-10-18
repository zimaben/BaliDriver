<?php
namespace <!PLUGINPATH->\customizer;
use <!PLUGINPATH->\<!PLUGINNAME-> as Theme;
use \<!PLUGINPATH->\Config as Config;
/**
 * Customizer settings for this theme.
 *
 * @package startertheme
 * 
 * https://wordpress.stackexchange.com/questions/71404/creating-a-rotating-header-image-slider-using-theme-customization 
 * 
 * 
 */

if ( ! class_exists( '\<!PLUGINPATH->\customizer\Theme_Customizer' ) ) {
    add_action( 'init', array('\<!PLUGINPATH->\customizer\Theme_Customizer', 'get_instance'), 10 );

	class Theme_Customizer extends Theme {
        private static $instance = null;
        public static function get_instance(){
            if (self::$instance == null){
                self::$instance = new self;
            }
            return self::$instance;
        }
        
      /* CONTRUCTOR */
		public function __construct() {
			add_action( 'customize_register', array( get_class(), 'register' ) );
		}

		/**
		 * Register customizer options.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * De-facto this extends the WP_Customizer object
		 */
		public static function register( $wp_customize ) {

			/* REMOVE THE STUFF WE DONT WANT */
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section('header_image');


			//Add excerpt or full text for indexes
			$wp_customize->add_section(
				'excerpt_settings',
				array(
					'title'    => esc_html__( 'Excerpt Settings', Config::TEXTDOMAIN ),
					'priority' => 120,
				)
			);
            //excerpt setting
			$wp_customize->add_setting(
				'display_excerpt_or_full_post',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'excerpt',
					'sanitize_callback' => function( $value ) {
						return ('excerpt' === $value || 'full' === $value) ? $value : 'excerpt';
					},
				)
			);
            //excerpt control
			$wp_customize->add_control(
				'display_excerpt_or_full_post',
				array(
					'type'    => 'radio',
					'section' => 'excerpt_settings',
					'label'   => esc_html__( 'On Archive Pages, posts show:', Config::TEXTDOMAIN ),
					'choices' => array(
						'excerpt' => esc_html__( 'Summary', Config::TEXTDOMAIN ),
						'full'    => esc_html__( 'Full text', Config::TEXTDOMAIN ),
					),
				)
			);

        // /* Global Consent Section */
        // $wp_customize->add_panel( 'consent', array(
		// 	'title'          => ucfirst(Config::NICENAME).' Consent Settings',
		// 	'priority'       => 65,
		// 	'description'	=>		__('Consent settings for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
		// ) );
        // /* sections */
        // $wp_customize->add_section( 'consent_one', array(
        //     'title'          => 'Consent Options',
        //     'priority'       => 30,
        //     'panel'			 => 'consent'
        // ) );
        // /* settings */
        // $wp_customize->add_setting( 'consent_add_gdpr_consent', array(
        //     'default'           => false,
        //     'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
        // ) );
        // /* controls */
        // $wp_customize->add_control(
        //     'consent_add_gdpr_consent',
        //     array(
        //         'type'    => 'checkbox',
        //         'section' => 'consent_one',
        //         'label'   => esc_html__( 'Add GDPR Cookies Consent to first visit?', Config::TEXTDOMAIN ),
        //         'description' => 'Privacy Page slug must be "privacy-policy" for link to be added.'
        //     )
        // );

		/* Global Menu SECTION */
		$wp_customize->add_panel( 'additional_menus', array(
			'title'          => ucfirst(Config::NICENAME).' Menu',
			'priority'       => 65,
			'description'	=>		__('Menu options for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
		) );
		$wp_customize->add_section( 'menu_one', array(
			'title'          => 'Menu Options',
			'priority'       => 30,
			'panel'			 => 'additional_menus'
		) );

		$wp_customize->add_setting( 'main_menu_style', array(
			'default'           => 'hamburger',
			'sanitize_callback' => array( get_class(), 'sanitize_radio' ),
			'description' => 'What kind of main menu does the site use?',

		) );
		$wp_customize->add_setting( 'header_telephone', array(
			'default'           => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'description' => 'Telephone number to display in header',
		) );

		$wp_customize->add_setting( 'menu_bootstrap_markup', array(
			'default'           => true,
			'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
			'description' => 'Should the menu use Bootstrap navigation markup? (default yes)',
		) );
		$wp_customize->add_control( 'header_telephone', array(
			'type'    => 'text',
			'section' => 'menu_one',
			'label'   => esc_html__( 'Telephone number to display in header', Config::TEXTDOMAIN ),
		) );
		$wp_customize->add_control(
			'menu_bootstrap_markup',
			array(
				'type'    => 'checkbox',
				'section' => 'menu_one',
				'label'   => esc_html__( 'Add Bootstrap Menu CSS & Markup?', Config::TEXTDOMAIN ),
				'description' => 'Do you want Bootstrap markup in your nav menu? Note:This will override the wp-theme-config.php file.'
			)
		);
		$wp_customize->add_control(
			'main_menu_style', array(
			'type' => 'radio',
			'section' => 'menu_one',
			'label' => __( 'What type of main menu?' ),
			'choices' => array(
			  'hamburger' => __( 'Always Hamburger (both Desktop and Mobile)' ),
			  'top' => __( 'Horizontal (inline) top menu, mobile hamburger' ),
			  'side' => __( 'Side menu Desktop, mobile hamburger' ),
			))
		);
		/* Global Social Links */
		$wp_customize->add_panel( 'social-links', array(
			'title'          => ucfirst(Config::NICENAME).' Social Links',
			'priority'       => 65,
			'description'	=>		__('Social Links for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
		) );
		/* sections */
		$wp_customize->add_section( 'sl_linkedin', array(
			'title'          => 'LinkedIn',
			'priority'       => 30,
			'panel'			 => 'social-links'
		) );
		$wp_customize->add_section( 'sl_facebook', array(
			'title'          => 'Facebook',
			'priority'       => 30,
			'panel'			 => 'social-links'
		) );
		$wp_customize->add_section( 'sl_instagram', array(
			'title'          => 'Instagram',
			'priority'       => 30,
			'panel'			 => 'social-links'
		) );
		$wp_customize->add_section( 'sl_twitter', array(
			'title'          => 'Twitter',
			'priority'       => 30,
			'panel'			 => 'social-links'
		) );
		$wp_customize->add_section( 'sl_youtube', array(
			'title'          => 'YouTube',
			'priority'       => 30,
			'panel'			 => 'social-links'
		) );
		/* settings */
		$wp_customize->add_setting( 'linkedin_url', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'description' => 'Enter your LinkedIn URL.',
		) );
		$wp_customize->add_setting( 'linkedin_icon', array(
			'default'           => '',
			'description' => 'Upload your LinkedIn Icon (SVG or PNG.)',
		) );
		$wp_customize->add_setting( 'facebook_url', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'description' => 'Enter your Facebook URL.',
		) );
		$wp_customize->add_setting( 'facebook_icon', array(
			'default'           => '',
			'description' => 'Upload your Facebook Icon (SVG or PNG.)',
		) );
		$wp_customize->add_setting( 'instagram_url', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'description' => 'Enter your Instagram URL.',
		) );
		$wp_customize->add_setting( 'instagram_icon', array(
			'default'           => '',
			'description' => 'Upload your Instagram Icon (SVG or PNG.)',
		) );
		$wp_customize->add_setting( 'twitter_url', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'description' => 'Enter your Twitter URL.',
		) );
		$wp_customize->add_setting( 'twitter_icon', array(
			'default'           => '',
			'description' => 'Upload your Twitter Icon (SVG or PNG.)',
		) );
		$wp_customize->add_setting( 'youtube_url', array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'description' => 'Enter your YouTube URL.',
		) );
		$wp_customize->add_setting( 'youtube_icon', array(
			'default'           => '',
			'description' => 'Upload your LinkedIn Icon (SVG or PNG.)',
		) );
		/* Controls */
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'linkedin_url', array(
				'label'    => __( 'URI for your LinkedIn Account', Config::TEXTDOMAIN ),
				'section'  => 'sl_linkedin',
				'settings' => 'linkedin_url',
				'type'     => 'text'
			))
		);
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'linkedin_icon', array(
			'label'   => 'LinkedIn Icon',
			'section' => 'sl_linkedin',
			'settings'   => 'linkedin_icon',
		) ) );
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'facebook_url', array(
				'label'    => __( 'URI for your Facebook Account', Config::TEXTDOMAIN ),
				'section'  => 'sl_facebook',
				'settings' => 'facebook_url',
				'type'     => 'text'
			))
		);
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'facebook_icon', array(
			'label'   => 'Facebook Icon',
			'section' => 'sl_facebook',
			'settings'   => 'facebook_icon',
		) ) );
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'instagram_url', array(
				'label'    => __( 'URI for your Instagram Account', Config::TEXTDOMAIN ),
				'section'  => 'sl_instagram',
				'settings' => 'instagram_url',
				'type'     => 'text'
			))
		);
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'instagram_icon', array(
			'label'   => 'Instagram Icon',
			'section' => 'sl_instagram',
			'settings'   => 'instagram_icon',
		) ) );
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'twitter_url', array(
				'label'    => __( 'URI for your Twitter Account', Config::TEXTDOMAIN ),
				'section'  => 'sl_twitter',
				'settings' => 'twitter_url',
				'type'     => 'text'
			))
		);
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'twitter_icon', array(
			'label'   => 'Twitter Icon',
			'section' => 'sl_twitter',
			'settings'   => 'twitter_icon',
		) ) );
		$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'youtube_url', array(
				'label'    => __( 'URI for your YouTube Account', Config::TEXTDOMAIN ),
				'section'  => 'sl_youtube',
				'settings' => 'youtube_url',
				'type'     => 'text'
			))
		);
		$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'youtube_icon', array(
			'label'   => 'YouTube Icon',
			'section' => 'sl_youtube',
			'settings'   => 'youtube_icon',
		) ) );
		/* End Social Links */

		/* Global Footer SECTION */
		$wp_customize->add_panel( 'footer', array(
			'title'          => ucfirst(Config::NICENAME).' Footer',
			'priority'       => 65,
			'description'	=>		__('Footer options for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
		) );

			/* sections */
			// $wp_customize->add_section( 'pre_footer', array(
			// 	'title'          => 'Pre Footer',
			// 	'priority'       => 10,
			// 	'description'	=>		__('Pre Footer options for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
			// 	'panel'			=> 'footer',
			// ) );
			$wp_customize->add_section( 'footer_one', array(
				'title'          => 'Footer Column One',
				'priority'       => 30,
				'panel'			 => 'footer'
			) );
			$wp_customize->add_section( 'footer_two', array(
				'title'          => 'Footer Column Two',
				'priority'       => 30,
				'panel'			 => 'footer'
			) );
			$wp_customize->add_section( 'footer_three', array(
				'title'          => 'Footer Column Three',
				'priority'       => 30,
				'panel'			 => 'footer'
			) );

			$wp_customize->add_section( 'footer_four', array(
				'title'          => 'Footer Column Four',
				'priority'       => 30,
				'panel'			 => 'footer'
			) );

			/* setting */

			$wp_customize->add_setting( 'footer_img', array(
				'default'        => '',
			) );
			// $wp_customize->add_setting( 'footer_is_bgcolor', array(
			// 	'default'        => false,
			// 	'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
			// ) );
			// $wp_customize->add_setting( 'footer_bgcolor', array(
			// 	'default'        => false,
			// 	'sanitize_callback' => array( get_class(), 'sanitize_hexcolor' ),
			// ) );

			$wp_customize->add_setting( 'footer_add_copyright', array(
                'default'           => false,
                'sanitize_callback' => array( get_class(), 'sanitize_checkbox'),
			) );

			$wp_customize->add_setting( 'footer_text', array(
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'description' => 'Footer Text Below Logo',
			) );


			if (!function_exists('is_plugin_active')) {
				include_once(ABSPATH . 'wp-admin/includes/plugin.php');
			}
			
            if( \is_plugin_active( 'wordpress-seo' )){
                $wp_customize->add_setting( 'footer_add_sitemap', array(
                    'default'           => false,
                    'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
                ) );
            } else {
                $wp_customize->add_setting( 'footer_add_sitemap', array(
                    'default'           => 'The YOAST SEO plugin is required to display sitemap',
                ) );
            }
            $wp_customize->add_setting( 'footer_add_privacy_policy', array(
                'default'           => false,
                'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
			) );

			$wp_customize->add_setting( 'footer_add_social', array(
                'default'           => false,
                'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
			) );

			$wp_customize->add_setting('footer_two_title', array(
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_setting('footer_three_title', array(
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_setting('footer_four_title', array(
				'default'           => '',
				'priority'       	=> 10,
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			));
			$wp_customize->add_setting( 'footer_default_contact_shortcode', array(
				'default'        => '',
				'sanitize_callback' => 'wp_specialchars_decode',
			) );


			/* controls */

			$wp_customize->add_control( 'footer_two_title', array(
				'type'        => 'text',
				'section'     => 'footer_two',
				'label'       => esc_html__('Footer Column Two Title', Config::TEXTDOMAIN)
			) );
			$wp_customize->add_control( 'footer_three_title', array(
				'type'        => 'text',
				'section'     => 'footer_three',
				'label'       => esc_html__('Footer Column Three Title', Config::TEXTDOMAIN)
			) );

			$wp_customize->add_control( 'footer_four_title', array(
				'type'        => 'text',
				'section'     => 'footer_four',
				'label'       => esc_html__('Footer Column Four Title', Config::TEXTDOMAIN)
			) );

			$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'footer_img', array(
				'label'   => 'Use a Footer Image?',
				'section' => 'footer_one',
				'settings'   => 'footer_img',
			) ) );

            $wp_customize->add_control(
				'footer_add_copyright',
				array(
					'type'    => 'checkbox',
					'section' => 'footer_one',
					'label'   => esc_html__( 'Add a Copyright notice?', Config::TEXTDOMAIN ),
					'description' => 'Example: ' . '©' . Date('Y') . ' ' . \get_bloginfo( 'name' ) . ', all rights reserved.'
				)
			);

            if( \is_plugin_active( 'wordpress-seo' )){
                $wp_customize->add_control(
                    'footer_add_sitemap',
                    array(
                        'type'    => 'checkbox',
                        'section' => 'footer_one',
                        'label'   => esc_html__( 'Add a Sitemap link', Config::TEXTDOMAIN ),
                        'description' => 'Example: ' . '©' . Date('Y') . ' ' . \get_bloginfo( 'name' ) . ', all rights reserved. | <a href="#" onclick="event.preventDefault()">Sitemap</a>',
                    )
                );
            } else {
                $wp_customize->add_control(
                    'footer_add_sitemap',
                    array(
                        'type'    => 'text',
                        'section' => 'footer_one',
                        'label'   => esc_html__( 'Add a Sitemap link', Config::TEXTDOMAIN ),
                        'input_attrs' => array('disabled'=>'disabled'),
                        'description' => 'Example: ' . '©' . Date('Y') . ' ' . \get_bloginfo( 'name' ) . ', all rights reserved. | <a href="#" onclick="event.preventDefault()">Sitemap</a>',
                    )
                );
            }

            $wp_customize->add_control(
				'footer_add_privacy_policy',
				array(
					'type'    => 'checkbox',
					'section' => 'footer_one',
					'label'   => esc_html__( 'Add a Privacy Policy Link', Config::TEXTDOMAIN ),
					'description' => 'Privacy Policy page must be selected in Theme Settings for link to be added.',
				)
			);

			$wp_customize->add_control( 'footer_text', array(
				'type'    => 'textarea',
				'section' => 'footer_one',
				'label'   => esc_html__( 'Footer Text', Config::TEXTDOMAIN )
			) );

			$wp_customize->add_control( 'footer_add_social', array(
				'type'    => 'checkbox',
				'section' => 'footer_one',
				'label'   => esc_html__( 'Put the Social Links in the Footer?', Config::TEXTDOMAIN ),
			) );

			$wp_customize->add_control( 'footer_default_contact_shortcode', array(
				'type'        => 'text',
				'section'     => 'footer_four',
				'label'       => esc_html__('Default Contact Shortcode', Config::TEXTDOMAIN),
				'description' => 'Example: ' . '<code>[contact-form-7 id="123" title="Contact form 1"]</code>',
			) );


		/* END FOOTER SECTION */

		}
		public static function sanitize_select( $input, $setting ) {
		  
			// Get list of choices from the control associated with the setting.
			$choices = $setting->manager->get_control( $setting->id )->choices;
		  
			// If the input is a valid key, return it; otherwise, return the default.
			return array_key_exists( $input, $choices ) ? $input : $setting->default;

		  }
		public static function return_theme_colors(){
			$json = file_get_contents( \get_template_directory() . '/theme.json' );
			$themejson = json_decode($json, true);
			$colors = isset($themejson['settings']['color']['palette']) ? $themejson['settings']['color']['palette'] : false;

			if($colors){
				$selectarray = array();
				foreach($colors as $idx => $color){

					$selectarray[ $color['color'] ] = $color['slug'];
				}
			} else {return false; }

			return !empty($selectarray) ? $selectarray : false;
		}
		public static function sanitize_radio( $input, $setting ) {

			// Ensure input is a slug.
			$input = \sanitize_key( $input );
		  
			// Get list of choices from the control associated with the setting.
			$choices = $setting->manager->get_control( $setting->id )->choices;
		  
			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		  }

		public static function sanitize_checkbox( $checked = null ) {
			return (bool) isset( $checked ) && true === $checked;
		}
	}
};