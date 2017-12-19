<?php
/**
 * GBS Blog Theme Customizer.
 *
 * @package gbs-blog
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 
 */
  function gbsblog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title > a',
			'container_inclusive' => false,
			'render_callback' => 'gbsblog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'gbsblog_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'gbsblog_customize_register' );

function gbsblog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since GBS Blog 2.0
 * @see gbsblog_customize_register()
 *
 * @return void
 */
function gbsblog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


// Custom control for carousel category
 
if (class_exists('WP_Customize_Control')) {
    class Gbsblog_Customize_Category_Control extends WP_Customize_Control {
         public function render_content() {
               $dropdown = wp_dropdown_categories( 
                array(
                    'name'              => '_customize-dropdown-category-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;','gbs-blog' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),           
                )
            );
 
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
  
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}
 
// Register slider customizer section 
 
add_action( 'customize_register' , 'carousel_options' );
 
function carousel_options( $wp_customize ) {
 
$wp_customize->add_section(
    'carousel_section',
    array(
        'title'     => 'Homepage Carousel settings',
       )
);
 
$wp_customize->add_setting(
    'carousel_setting',
     array(
    'default'   => '1',
	'sanitize_callback' => 'absint'
  )
);
 
$wp_customize->add_control(
    new Gbsblog_Customize_Category_Control(
        $wp_customize,
        'carousel_category',
        array(
            'label'    => 'Category',
            'settings' => 'carousel_setting',
            'section'  => 'carousel_section'
        )
    )
);
 
$wp_customize->add_setting(
    'count_setting',
     array(
    'default'   => '6',
 	'sanitize_callback' => 'absint'
  )
);
 
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'carousel_count',
        array(
            'label'          => __( 'Number of posts', 'gbs-blog' ),
            'section'        => 'carousel_section',
            'settings'       => 'count_setting',
            'type'           => 'text',
        )
    )
);


function gbsblog_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since GBS Blog 1.0
 */
function gbsblog_customize_preview_js() {
	wp_enqueue_script( 'gbsblog-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'gbsblog_customize_preview_js' );