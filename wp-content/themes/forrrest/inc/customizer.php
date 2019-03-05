<?php
/**
 * forrrest Theme Customizer
 *
 * @package forrrest
 *
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since forrrest 1.0
 */
class forrrest_Customize {
	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 *  
	 * @see add_action('customize_register',$func)
	 * @param \WP_Customize_Manager $wp_customize
	 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since forrrest 1.0
	 */
	public static function register ( $wp_customize ) {
	   //1. Define a new section (if desired) to the Theme Customizer
	   $wp_customize->add_section( 'Footer', 
		  	array(
			'title'       => __( 'Footer', 'forrrest' ), //Visible title of section
			'priority'    => 35, //Determines what order this appears in
			'capability'  => 'edit_theme_options', //Capability needed to tweak
			'description' => __('Allows you to customize settings for forrrest.', 'forrrest'), //Descriptive tooltip
			) 
	   		);
	   
		//2. Register new settings to the WP database...
		$wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
			'default'    => '#2BA6CB', //Default setting/value to save
			'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			) 
			);     
	   
			$wp_customize->add_setting( 'nav_background', 
			array(
			'default'    => '#ffffff', 
			'type'       => 'theme_mod', 
			'capability' => 'edit_theme_options', 
			'transport'  => 'postMessage', 
			) 
			);   

			$wp_customize->add_setting( 'nav_link_textcolor', 
			array(
			'default'    => '#000000', 
			'type'       => 'theme_mod', 
			'capability' => 'edit_theme_options', 
			'transport'  => 'postMessage', 
			) 
			);   
			 
	   //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			$wp_customize, //Pass the $wp_customize object (required)
			'forrrest_link_textcolor', //Set a unique ID for the control
			array(
			'label'      => __( 'Page Link Color', 'forrrest' ), //Admin-visible name of the control
			'settings'   => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
			'priority'   => 10, //Determines the order this control appears in for the specified section
			'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
			) 
			) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'forrrest_nav_background', 
			array(
			'label'      => __( 'Navigation Background', 'forrrest' ),
			'settings'   => 'nav_background', 
			'priority'   => 10,
			'section'    => 'colors', 
			) 
			) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 
			'forrrest_nav_link_textcolor', 
			array(
			'label'      => __( 'Navigation Link Color', 'forrrest' ), 
			'settings'   => 'nav_link_textcolor', 
			'priority'   => 10, 
			'section'    => 'colors',
			) 
			) );

	   
	   //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
	   $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	   $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	   $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	   $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	}
 
	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 * 
	 * Used by hook: 'wp_head'
	 * 
	 * @see add_action('wp_head',$func)
	 * @since forrrest 1.0
	 */
	public static function header_output() {
	   ?>
	   <!--Customizer CSS--> 
	   <style type="text/css">
			<?php self::generate_css('.site-title', 'color', 'header_textcolor', '#'); ?> 
			<?php self::generate_css('body', 'background-color', 'background_color', '#'); ?> 
			<?php self::generate_css('a', 'color', 'link_textcolor'); ?>
			<?php self::generate_css('.site-header', 'background-color', 'nav_background'); ?>
			<?php self::generate_css('.primary-li a', 'color', 'nav_link_textcolor'); ?>
	   </style> 
	   <!--/Customizer CSS-->
	   <?php
	}
	
	/**
	 * This outputs the javascript needed to automate the live settings preview.
	 * Also keep in mind that this function isn't necessary unless your settings 
	 * are using 'transport'=>'postMessage' instead of the default 'transport'
	 * => 'refresh'
	 * 
	 * Used by hook: 'customize_preview_init'
	 * 
	 * @see add_action('customize_preview_init',$func)
	 * @since forrrest 1.0
	 */
	public static function live_preview() {
		wp_enqueue_script( 'forrrest-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
	}
 
	 /**
	  * This will generate a line of CSS for use in header output. If the setting
	  * ($mod_name) has no defined value, the CSS will not be output.
	  * 
	  * @uses get_theme_mod()
	  * @param string $selector CSS selector
	  * @param string $style The name of the CSS *property* to modify
	  * @param string $mod_name The name of the 'theme_mod' option to fetch
	  * @param string $prefix Optional. Anything that needs to be output before the CSS property
	  * @param string $postfix Optional. Anything that needs to be output after the CSS property
	  * @param bool $echo Optional. Whether to print directly to the page (default: true).
	  * @return string Returns a single line of CSS with selectors and a property.
	  * @since forrrest 1.0
	  */
	 public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
	   $return = '';
	   $mod = get_theme_mod($mod_name);
	   if ( ! empty( $mod ) ) {
		  $return = sprintf('%s { %s:%s; }',
			 $selector,
			 $style,
			 $prefix.$mod.$postfix
		  );
		  if ( $echo ) {
			 echo $return;
		  }
	   }
	   return $return;
	 }
 }
 
 // Setup the Theme Customizer settings and controls...
 add_action( 'customize_register' , array( 'forrrest_Customize' , 'register' ) );
 
 // Output custom CSS to live site
 add_action( 'wp_head' , array( 'forrrest_Customize' , 'header_output' ) );
 
 // Enqueue live preview javascript in Theme Customizer admin screen
 add_action( 'customize_preview_init' , array( 'forrrest_Customize' , 'live_preview' ) );

