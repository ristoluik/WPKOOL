<?php
/**
 * InstaBlog Theme Customizer
 *
 * @package InstaBlog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function instablog_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'instablog_customize_partial_blogname',
		) );
	}

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.description',
			'container_inclusive' => false,
			'render_callback' => 'instablog_customize_partial_blogdescription',
		) );
	}


	/*
	=================================================
	Home Page Customizer
	=================================================
	*/

	$wp_customize->add_panel( 'homepage_setting_panel', array( // General Panel
	    'priority'       => 50,
	    'capability'     => 'edit_theme_options',
	    'title'          => esc_html__('Front Page Settings', 'instablog'),
	    'description'    => esc_html__('Changes the front page', 'instablog'),
	));

	// home page text
	$wp_customize->add_section( 'home_page_text' , array(
	    'title'       => esc_html__( 'Homepage Bottom Text', 'instablog' ),
	    'priority'    => 1,
	    'panel' => 'homepage_setting_panel',
	) );
	$wp_customize->add_setting(
		'homepage_text',
		array(
			'sanitize_callback' => 'instablog_sanitize_text',
			)
	);
	$wp_customize->add_control( 'homepage_text', array(
		'label'    => esc_html__( 'Homepage Sub Text', 'instablog' ),
		'section'  => 'home_page_text',
		'type'     => 'textarea',
		'priority' => 2,
	) );

	//socila links section
	$wp_customize->add_section( 'instablog_sociallinks_section' , array(
	    'title'       => esc_html__( 'Social Links', 'instablog' ),
	    'priority'    => 3,
	    'panel'		=> 'homepage_setting_panel',
	) );

	//facebook url
	$wp_customize->add_setting( 'instablog_fburl', array(
		'sanitize_callback' => 'instablog_sanitize_url',
	) );

	$wp_customize->add_control( 'instablog_fburl', array(
		'label'    => esc_html__( 'Facebook Link', 'instablog' ),
		'description' => esc_html__( 'Enter the full URL to your Facebook', 'instablog' ),
		'section'  => 'instablog_sociallinks_section',
		'type'     => 'text',
		'priority' => 1,
	) );

	//instagram url
	$wp_customize->add_setting( 'instablog_instaurl', array(
		'sanitize_callback' => 'instablog_sanitize_url',
	) );

	$wp_customize->add_control( 'instablog_instaurl', array(
		'label'    => esc_html__( 'Instagram Link', 'instablog' ),
		'description' => esc_html__( 'Enter the full URL to your Instagram', 'instablog' ),
		'section'  => 'instablog_sociallinks_section',
		'type'     => 'text',
		'priority' => 1,
	) );

	//twitter url
	$wp_customize->add_setting( 'instablog_twitterurl', array(
		'sanitize_callback' => 'instablog_sanitize_url',
	) );

	$wp_customize->add_control( 'instablog_twitterurl', array(
		'label'    => esc_html__( 'Twitter Link', 'instablog' ),
		'description' => esc_html__( 'Enter the full URL to your Twitter', 'instablog' ),
		'section'  => 'instablog_sociallinks_section',
		'type'     => 'text',
		'priority' => 1,
	) );


	// home page text
	$wp_customize->add_section( 'home_page_post_display_section' , array(
	    'title'       => esc_html__( 'Homepage Post Display', 'instablog' ),
	    'priority'    => 1,
	    'panel' => 'homepage_setting_panel',
	) );


	$wp_customize->add_setting( 'home_page_post_display_setting_small', array(
			'sanitize_callback' => 'instablog_sanitize_dropdown_general',
			)
    );

	$wp_customize->add_control( new instablog_Post_Dropdown( $wp_customize, 'home_page_post_display_setting_small', array(
        'label' => __('Display in middle section','instablog'),
        'section' => 'home_page_post_display_section',
        'type' => 'select',
				'settings' => 'home_page_post_display_setting_small',
        'desc' => esc_html__( 'Select the post to display in middle section leave it empty to display latest post', 'instablog' )
        )
			)
	);


	$wp_customize->add_setting( 'home_page_post_display_setting_large', array(
		'sanitize_callback' => 'instablog_sanitize_dropdown_general',
    )
  );
	$wp_customize->add_control( new instablog_Post_Dropdown( $wp_customize, 'home_page_post_display_setting_large', array(
        'label' => __('Display in Large section','instablog'),
        'section' => 'home_page_post_display_section',
        'type' => 'select',
				'settings' => 'home_page_post_display_setting_large',
        'desc' => esc_html__( 'Select the post to display in middle section leave it empty to display latest post', 'instablog' )
        )
    ) );

	//Page Title Settings
	$wp_customize->add_setting( 'page_post_title_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_post_title_color', array(
		'default' => esc_html( '#333333' ),
		'label'    => esc_html__( 'Page Title Color', 'instablog' ),
		'section'  => 'colors',
		'priority'=> 10,
	) ) );

	//Post Title Settings
	$wp_customize->add_setting( 'post_title_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_title_color', array(
		'default' => esc_html( '#333333' ),
		'label'    => esc_html__( 'Post Title Color', 'instablog' ),
		'section'  => 'colors',
		'priority'=> 10,
	) ) );

	//Contain Text Color
	$wp_customize->add_setting( 'post_page_content_text_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_page_content_text_color', array(
		'default' => esc_html( '#5f5f5f' ),
		'label'    => esc_html__( 'Contain Color', 'instablog' ),
		'section'  => 'colors',
		'priority'=> 10,
	) ) );

	//Header Text Color
	$wp_customize->add_setting( 'header_tag_text_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_tag_text_color', array(
		'default' => esc_html( '#333333' ),
		'label'    => esc_html__( 'Header Tag Text Color', 'instablog' ),
		'section'  => 'colors',
		'priority'=> 10,
	) ) );


	/*
	=================================================
	Footer Customizer
	=================================================
	*/

	$wp_customize->add_panel( 'footer_setting_panel', array( // General Panel
	    'priority'       => 50,
	    'capability'     => 'edit_theme_options',
	    'title'          => esc_html__('Footer Section', 'instablog'),
	    'description'    => esc_html__('Changes the Footer settings', 'instablog'),
	));

	// home page text
	$wp_customize->add_section( 'footer_text_section' , array(
	    'title'       => esc_html__( 'Footer Text Option', 'instablog' ),
	    'priority'    => 1,
	    'panel' => 'footer_setting_panel',
	) );
	$wp_customize->add_setting(
		'show_footer_text',
		array(
			'sanitize_callback' => 'instablog_sanitize_checkbox',
			)
	);
	$wp_customize->add_setting(
		'credits',
		array(
			'sanitize_callback' => 'instablog_sanitize_text',
			)
	);
	$wp_customize->add_control( 'show_footer_text', array(
		'label'    => esc_html__( 'Hide Footer Credits', 'instablog' ),
		'section'  => 'footer_text_section',
		'type'     => 'checkbox',
		'priority' => 2,
	) );

	$wp_customize->add_control( 'credits', array(
		'label'    => esc_html__( 'Edit Credits', 'instablog' ),
		'section'  => 'footer_text_section',
		'type'     => 'text',
		'priority' => 2,
	) );

}
add_action( 'customize_register', 'instablog_customize_register' );


/** sanitization section **/

/**
 * Render the site title for the selective refresh partial.
 *
 *
 * @return void
 */
function instablog_customize_partial_blogname() {
	bloginfo( 'name' );
}

function instablog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * adds sanitization callback function : TEXT
 * @package InstaBlog
 * @version 1.0
*/
function instablog_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


/**
 * adds sanitization callback function : URL
 * @package InstaBlog
 * @version 1.0
*/
function instablog_sanitize_url( $value ) {
	$value = esc_url_raw( $value );
	return $value;
}

//General dropdown sanitize for integer value
    function instablog_sanitize_dropdown_general( $input ) {
        return absint( $input );
    }

/**
 * adds sanitization callback function : checkbox
 * @package InstaBlog
*/
function instablog_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
	    return 1;
	} else {
	    return '';
	}
}
