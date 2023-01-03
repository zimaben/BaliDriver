<?php
namespace rbt\customizer;
use rbt\FRStarter as Theme;
use \rbt\Config as Config;
/**
 * Customizer settings for this theme.
 *
 * @package startertheme
 * 
 * https://wordpress.stackexchange.com/questions/71404/creating-a-rotating-header-image-slider-using-theme-customization 
 * 
 * 
 */

if ( ! class_exists( '\rbt\customizer\Theme_Customizer' ) ) {
    add_action( 'init', array('\rbt\customizer\Theme_Customizer', 'get_instance'), 10 );

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

			/* HEADER settings */
			if( Config::HEADER && is_array(Config::HEADER)) :

				foreach(Config::HEADER as $section => $settings){	
				
					switch( $section ){
						case "logo" : 
							#we use the default site Identity menu for this
						break;
						case "right" :

							$wp_customize->add_section( 'top_right', array(
								'title'          => ucfirst(Config::NICENAME).' Top Right Menu',
								'priority'       => 21,
								'description'	=>		__('Top Right Menu options for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
							) );
							$supported_settings = array('login', 'phone', 'cta');
							if(is_array($settings)){
								foreach($settings as $setting){
									if(in_array($setting, $supported_settings)){
										switch($setting){
											case "login" : 
											break;
											case "phone" :
					
												$wp_customize->add_setting( 'header_telephone', array(
													'default'           => '',
													'sanitize_callback' => 'wp_filter_nohtml_kses',
													'description' => 'Telephone number to display in header',
												) );
												$wp_customize->add_control( 'header_telephone', array(
													'type'    => 'text',
													'section' => 'top_right',
													'label'   => esc_html__( 'Telephone number to display in header', Config::TEXTDOMAIN ),
												) );
											break;
											case "cta" : 
												$wp_customize->add_setting( 'top_cta_text', array(
													'default'           => '',
													'sanitize_callback' => 'wp_filter_nohtml_kses',
													'description' => 'Text to display in the CTA button',
												) );
												$wp_customize->add_setting( 'top_cta_url', array(
													'default'           => '',
													'sanitize_callback' => 'esc_url_raw',
													'description' => 'Enter your LinkedIn URL.',
												) );
												$wp_customize->add_control( 'top_cta_text', array(
													'type'    => 'text',
													'section' => 'top_right',
													'label'   => esc_html__( 'Button Text', Config::TEXTDOMAIN ),
												) );
												$wp_customize->add_control( 'top_cta_url', array(
													'type'    => 'text',
													'section' => 'top_right',
													'label'   => esc_html__( 'Button URL', Config::TEXTDOMAIN ),
												) );
											break;
										}
									}
								} 
							} else {
								if(in_array($settings, $supported_settings)){
									switch($settings){
										case "login" : 
										break;
										case "phone" :
											error_log("HIT FOR PHONE: " . $setting);
											$wp_customize->add_setting( 'header_telephone', array(
												'default'           => '',
												'sanitize_callback' => 'wp_filter_nohtml_kses',
												'description' => 'Telephone number to display in header',
											) );
											$wp_customize->add_control( 'header_telephone', array(
												'type'    => 'text',
												'section' => 'top_right',
												'label'   => esc_html__( 'Telephone number to display in header', Config::TEXTDOMAIN ),
											) );
										break;
										case "cta" : 
											$wp_customize->add_setting( 'top_cta_text', array(
												'default'           => '',
												'sanitize_callback' => 'wp_filter_nohtml_kses',
												'description' => 'Text to display in the CTA button',
											) );
											$wp_customize->add_setting( 'top_cta_url', array(
												'default'           => '',
												'sanitize_callback' => 'esc_url_raw',
												'description' => 'Enter your LinkedIn URL.',
											) );
											$wp_customize->add_control( 'top_cta_text', array(
												'type'    => 'text',
												'section' => 'top_right',
												'label'   => esc_html__( 'Button Text', Config::TEXTDOMAIN ),
											) );
											$wp_customize->add_control( 'top_cta_url', array(
												'type'    => 'text',
												'section' => 'top_right',
												'label'   => esc_html__( 'Button URL', Config::TEXTDOMAIN ),
											) );
										break;
									}
								}
							}
						break;
						case "menu" : 
							#menus are skipped by the customizer
						break;
						default : break;
					}	
				}
			endif;
			/* END HEADER SECTIONS */

			/* FOOTER */

			if( Config::FOOTER && is_array(Config::FOOTER)) :

				/* Global Footer SECTION */
				$wp_customize->add_panel( 'footer', array(
					'title'          => ucfirst(Config::NICENAME).' Footer',
					'priority'       => 65,
					'description'	=>		__('Footer options for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
				) );
				$supported_sections = array( 'prefooter', 'bottom', 'columns' ) ;
				#$sections = array();
				foreach(Config::FOOTER as $section=>$settings){
					switch ($section) {
						case "prefooter":

							$wp_customize->add_section( 'pre_footer', array(
								'title'          => 'Pre Footer',
								'priority'       => 10,
								'description'	=>		__('Pre Footer options for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
								'panel'			=> 'footer',
							) );
							$supported_settings = array('title', 'image', 'text', 'textarea', 'shortcode');
							if(is_array($settings)){
								foreach($settings as $setting){
									if(in_array($setting, $supported_settings)){				
										if(!is_array($setting)){
											switch($setting){
												case "title" : 
													$wp_customize->add_setting('prefooter_title', array(
														'default'           => '',
														'sanitize_callback' => 'wp_filter_nohtml_kses',
													));
													$wp_customize->add_control( 'prefooter_title', array(
														'type'        => 'text',
														'section'     => 'pre_footer',
														'label'       => esc_html__('Pre Footer Title', Config::TEXTDOMAIN)
													) );
												break;

												case "text" : 
													$wp_customize->add_setting('prefooter_text', array(
														'default'           => '',
														'sanitize_callback' => 'wp_filter_nohtml_kses',
													));
													$wp_customize->add_control( 'prefooter_text', array(
														'type'        => 'text',
														'section'     => 'pre_footer',
														'label'       => esc_html__('Pre Footer Text (Single Line)', Config::TEXTDOMAIN)
													) );
												break;

												case "textarea" : 
													$wp_customize->add_setting('prefooter_textarea', array(
														'default'           => '',
														'sanitize_callback' => 'wp_filter_nohtml_kses',
													));
													$wp_customize->add_control( 'prefooter_textarea', array(
														'type'        => 'textarea',
														'section'     => 'pre_footer',
														'label'       => esc_html__('Pre Footer Text', Config::TEXTDOMAIN)
													) );
												break;

												case "image" : 
													$wp_customize->add_setting( 'prefooter_img', array(
														'default'        => '',
													) );
													$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'prefooter_img', array(
														'label'   => 'Pre Footer Image',
														'section' => 'pre_footer',
														'settings'   => 'prefooter_img',
													) ) );
												break;

												case "shortcode" : 
													$wp_customize->add_setting('prefooter_shortcode', array(
														'default'           => '',
														'sanitize_callback' => 'wp_filter_nohtml_kses',
													));
													$wp_customize->add_control( 'prefooter_shortcode', array(
														'type'        => 'text',
														'section'     => 'pre_footer',
														'label'       => esc_html__('Shortcode to Execute in Pre Footer', Config::TEXTDOMAIN)
													) );
												break;

												default: break;
											}
											
										} else {
											foreach($setting as $key=>$value){
												switch($key){
													case "title" : 
														
														$label = isset($value['label']) ? esc_html__($value['label'], Config::TEXTDOMAIN) : esc_html__('Pre Footer Title', Config::TEXTDOMAIN);
														
														$wp_customize->add_setting('prefooter_title', array(
															'default'           => '',
															'sanitize_callback' => 'wp_filter_nohtml_kses',
														));
														$wp_customize->add_control( 'prefooter_title', array(
															'type'        => 'text',
															'section'     => 'pre_footer',
															'label'       => $label,
														) );
													break;

													case "text" : 

														$label = isset($value['label']) ? esc_html__($value['label'], Config::TEXTDOMAIN) : esc_html__('Pre Footer Text (Single Line)', Config::TEXTDOMAIN);

														$wp_customize->add_setting('prefooter_text', array(
															'default'           => '',
															'sanitize_callback' => 'wp_filter_nohtml_kses',
														));
														$wp_customize->add_control( 'prefooter_text', array(
															'type'        => 'text',
															'section'     => 'pre_footer',
															'label'       =>  $label
														) );
													break;

													case "textarea" : 

														$label = isset($value['label']) ? esc_html__($value['label'], Config::TEXTDOMAIN) : esc_html__('Pre Footer Text', Config::TEXTDOMAIN);

														$wp_customize->add_setting('prefooter_textarea', array(
															'default'           => '',
															'sanitize_callback' => 'wp_filter_nohtml_kses',
														));
														$wp_customize->add_control( 'prefooter_textarea', array(
															'type'        => 'textarea',
															'section'     => 'pre_footer',
															'label'       => $label
														) );
													break;

													case "image" : 

														$label = isset($value['label']) ? esc_html__($value['label'], Config::TEXTDOMAIN) : esc_html__('Pre Footer Image', Config::TEXTDOMAIN);

														$wp_customize->add_setting( 'prefooter_img', array(
															'default'        => '',
														) );
														$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'prefooter_img', array(
															'label'   => $label,
															'section' => 'pre_footer',
															'settings'   => 'prefooter_img',
														) ) );
													break;

													case "shortcode" : 

														$label = isset($value['label']) ? esc_html__($value['label'], Config::TEXTDOMAIN) : esc_html__('Shortcode to Execute in Pre Footer', Config::TEXTDOMAIN);

														$wp_customize->add_setting('prefooter_shortcode', array(
															'default'           => '',
															'sanitize_callback' => 'wp_filter_nohtml_kses',
														));
														$wp_customize->add_control( 'prefooter_shortcode', array(
															'type'        => 'text',
															'section'     => 'pre_footer',
															'label'       => $label,
														) );
													break;

													default: break;
												}
											}
										}
									}
								}
							}
						break;
						/* END PREFOOTER */

						case "columns" :

							$supported_sections = array('footer_one', 'footer_two', 'footer_three', 'footer_four');
							if(is_array($settings)){
								foreach($settings as $column => $settings){
									$priority = 11;
									if(in_array($column, $supported_sections )){
										$name = ucwords( str_replace( '_', ' ', $column) );

										$wp_customize->add_section( $column, array(
											'title'          => $name,
											'priority'       => $priority,
											'panel'			=> 'footer',
										) );
										$supported_settings = array('logo', 'title', 'textarea', 'social_links', 'menu');
										if(!is_array($settings)){
											if(in_array($settings, $supported_settings)){
												switch($settings){
													case "logo" : 
														$wp_customize->add_setting( $column . '_logo', array(
															'default'        => '',
														) );
														$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, $column . '_logo', array(
															'label'   => $name . ' Logo',
															'section' => $column,
															'settings'   => $column . '_logo',
														) ) );
													break;
													case "title" : 
														$wp_customize->add_setting($column . '_title', array(
															'default'           => '',
															'sanitize_callback' => 'wp_filter_nohtml_kses',
														));
														$wp_customize->add_control( $column . '_title', array(
															'type'        => 'text',
															'section'     => $column,
															'label'       => esc_html__($name . ' Title', Config::TEXTDOMAIN)
														) );
													break;
													case "textarea" : 
														$wp_customize->add_setting($column . '_textarea', array(
															'default'           => '',
															'sanitize_callback' => 'wp_filter_nohtml_kses',
														));
														$wp_customize->add_control( $column . '_textarea', array(
															'type'        => 'text',
															'section'     => $column,
															'label'       => esc_html__($name . ' Text', Config::TEXTDOMAIN)
														) );
													break;
													case "social_links" : 
														$wp_customize->add_setting( $column . '_social', array(
															'default'           => true,
															'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
														) );
														$wp_customize->add_control( $column . '_social', array(
															'type'    => 'checkbox',
															'section'     => $column,
															'label'   => esc_html__( 'Add Social Links to Footer '.$name.'?', Config::TEXTDOMAIN ),
														) );
													break;
													case "menu" : 

													break;

													default: break;

												}	
											}

										} else {
											foreach($settings as $setting){
												if(!is_array($setting)){
													if(in_array($setting, $supported_settings)){
														switch($setting){
															case "logo" : 
																$wp_customize->add_setting( $column . '_logo', array(
																	'default'        => '',
																) );
																$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, $column . '_logo', array(
																	'label'   => $name . ' Logo',
																	'section' => $column,
																	'settings'   => $column . '_logo',
																) ) );
															break;
															case "title" : 
																$wp_customize->add_setting($column . '_title', array(
																	'default'           => '',
																	'sanitize_callback' => 'wp_filter_nohtml_kses',
																));
																$wp_customize->add_control( $column . '_title', array(
																	'type'        => 'text',
																	'section'     => $column,
																	'label'       => esc_html__($name . ' Title', Config::TEXTDOMAIN)
																) );
															break;
															case "textarea" : 
																$wp_customize->add_setting($column . '_textarea', array(
																	'default'           => '',
																	'sanitize_callback' => 'wp_filter_nohtml_kses',
																));
																$wp_customize->add_control( $column . '_textarea', array(
																	'type'        => 'textarea',
																	'section'     => $column,
																	'label'       => esc_html__($name . ' Text', Config::TEXTDOMAIN)
																) );
															break;
															case "social_links" : 
																$wp_customize->add_setting( $column . '_social', array(
																	'default'           => true,
																	'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
																) );
																$wp_customize->add_control( $column . '_social', array(
																	'type'    => 'checkbox',
																	'section'     => $column,
																	'label'   => esc_html__( 'Add Social Links to Footer '.$name.'?', Config::TEXTDOMAIN ),
																) );
															break;

															case "menu" : 
	
															break;
	
															default: break;
	
														}	
													}
												}
											}
										}

										
										$priority++;
									}
								}
							}
						break;
						/* END COLUMNS */

						case "bottom" : 

							$wp_customize->add_section( 'footer_bottom', array(
								'title'          => 'Footer Bottom',
								'priority'       => 16,
								'description'	=>		__('Footer Bottom options for the '.ucfirst(Config::NICENAME).' theme.', Config::TEXTDOMAIN ),
								'panel'			=> 'footer',
							) );
							$supported_settings = array('copyright', 'sitemap', 'privacy', 'menu');
							if(is_array($settings)){
								foreach($settings as $setting){
									if(!is_array($setting)){ #we are ignoring menus in the customizer
										if(in_array($setting, $supported_settings)){
											switch($setting){
												case "copyright" :
													$wp_customize->add_setting( 'footer_bottom_add_copyright', array(
														'default'           => false,
														'sanitize_callback' => array( get_class(), 'sanitize_checkbox'),
													) );
													$wp_customize->add_control(
														'footer_bottom_add_copyright',
														array(
															'type'    => 'checkbox',
															'section' => 'footer_bottom',
															'label'   => esc_html__( 'Add a Copyright notice?', Config::TEXTDOMAIN ),
															'description' => 'Example: ' . '©' . Date('Y') . ' ' . Config::NICENAME . ', all rights reserved.'
														)
													);
												break;
												case "sitemap" : 
													if (!function_exists('is_plugin_active')) {
														include_once(ABSPATH . 'wp-admin/includes/plugin.php');
													}
													
													if( \is_plugin_active( 'wordpress-seo' )){
														$wp_customize->add_setting( 'footer_bottom_add_sitemap', array(
															'default'           => false,
															'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
														) );
														$wp_customize->add_control(
															'footer_bottom_add_sitemap',
															array(
																'type'    => 'checkbox',
																'section' => 'footer_bottom',
																'label'   => esc_html__( 'Add a Sitemap link', Config::TEXTDOMAIN ),
																'description' => 'Example: ' . '©' . Date('Y') . ' ' . Config::NICENAME . ', all rights reserved. | <a href="#" onclick="event.preventDefault()">Sitemap</a>',
															)
														);
													} else {
														$wp_customize->add_setting( 'footer_bottom_add_sitemap', array(
															'default'           => 'The YOAST SEO plugin is required to display sitemap',
														) );
														$wp_customize->add_control(
															'footer_bottom_add_sitemap',
															array(
																'type'    => 'text',
																'section' => 'footer_bottom',
																'label'   => esc_html__( 'Add a Sitemap link', Config::TEXTDOMAIN ),
																'input_attrs' => array('disabled'=>'disabled'),
																'description' => 'The YOAST SEO plugin is required to display sitemap',
															)
														);
													}
												break;
												case "privacy" : 
													$wp_customize->add_setting( 'footer_bottom_add_privacy_policy', array(
														'default'           => true,
														'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
													) );
													$wp_customize->add_control(
														'footer_bottom_add_privacy_policy',
														array(
															'type'    => 'checkbox',
															'section' => 'footer_bottom',
															'label'   => esc_html__( 'Add a Privacy Policy Link', Config::TEXTDOMAIN ),
															'description' => 'Privacy Policy page must be selected in Theme Settings for link to be added.',
														)
													);
												break;

												default : break;
											}
										}
									}
								}
							}
						break;
						/* END FOOTER BOTTOM */

						default: break;
					}
				}
				/* END CONFIG FOOTER FIELDS*/
			endif;
			/* END FOOTER SECTIONS */

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