<?php
/**
 * expedition functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package expedition
 */

/**
 * Get the path for the file ( to support child theme )
 *
 * @since expedition 0.0.2
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('expedition_file_directory') ){
	function expedition_file_directory( $file_path ){

		if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ){
			return trailingslashit( get_stylesheet_directory() ) . $file_path;
		}
		else{
			return trailingslashit( get_template_directory() ) . $file_path;
		}
	}
}

/**
 * require expedition int.
 */
$expedition_init_file_path = expedition_file_directory('inc/init.php');
require $expedition_init_file_path;


if ( ! function_exists( 'expedition_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function expedition_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on expedition, use a find and replace
	 * to change 'expedition' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'expedition', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );


	/*
	 * Enable support for image sizes on posts and pages.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_image_size/
	 */
	add_image_size( 'expedition-main-banner', 1370, 550, true );
	add_image_size( 'expedition-costume-medium', 270, 370, true );
	add_image_size( 'expedition-costume-small', 570, 370, true );



	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'expedition' ),
		'social' => esc_html__( 'Social Menu', 'expedition' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'expedition_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*implimenting new feature from 4.5*/
	add_theme_support( 'custom-logo', array(
	   'height'      => 50,
	   'width'       => 165,
	   'flex-width' => true,
	   'header-text' => array( 'site-title', 'site-description' ),
	) );

	/**
	 * Enable support for WooCommerce
	 */
	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'expedition_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function expedition_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'expedition_content_width', 640 );
}
add_action( 'after_setup_theme', 'expedition_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function expedition_scripts() {
		global $expedition_customizer_all_values;

		/*google font*/
		$expedition_font_family_primary_option = $expedition_customizer_all_values['expedition-font-family-Primary'];
		$expedition_font_family_site_identity_option = $expedition_customizer_all_values['expedition-font-family-site-identity'];
		$expedition_font_family_title_option = $expedition_customizer_all_values['expedition-font-family-title'];
		$expedition_font_family_subtitle_option = $expedition_customizer_all_values['expedition-font-family-subtitle'];

		wp_enqueue_style( 'expedition-googleapis-primary', '//fonts.googleapis.com/css?family='.$expedition_font_family_primary_option.'', array(), '' );/*added*/
		wp_enqueue_style( 'expedition-googleapis-site-identity', '//fonts.googleapis.com/css?family='.$expedition_font_family_site_identity_option.'', array(), '' );/*added*/
		wp_enqueue_style( 'expedition-googleapis-title', '//fonts.googleapis.com/css?family='.$expedition_font_family_title_option.'', array(), '' );/*added*/
		wp_enqueue_style( 'expedition-googleapis-sub-titile', '//fonts.googleapis.com/css?family='.$expedition_font_family_subtitle_option.'', array(), '' );/*added*/
	 	/*animation*/
	    wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/assets/frameworks/wow/css/animate.min.css', array(), '3.4.0' );/*added*/

		// Style
		wp_enqueue_style( 'jquery-mmenu-all-style', get_template_directory_uri() . '/assets/frameworks/mmenu/css/jquery.mmenu.all.css' );/*added*/
		
		
		wp_enqueue_style( 'expedition-style', get_stylesheet_uri() );
		
		// Script
		
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array('jquery'), '2.8.3', true );

		wp_enqueue_script( 'navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );
		
		wp_enqueue_script('easing-js', get_template_directory_uri() . '/assets/frameworks/jquery.easing/jquery.easing.js', array('jquery'), '0.3.6', 1);

	    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/frameworks/wow/js/wow.min.js', array('jquery'), '1.1.2', 1);

		wp_enqueue_script( 'jquery-mmenu', get_template_directory_uri() . '/assets/frameworks/mmenu/js/jquery.mmenu.min.all.js', array('jquery'), '4.7.5', false );
		
		/*cycle2 slider*/
		wp_enqueue_script( 'cycle2-script', get_template_directory_uri() . '/assets/frameworks/cycle2/js/jquery.cycle2.js', array( 'jquery' ), '2.1.6', true );
		
		wp_enqueue_script( 'cycle2-script-flip', get_template_directory_uri() . '/assets/frameworks/cycle2/js/jquery.cycle2.flip.js', array( 'jquery' ), '20140128', true );
		
		wp_enqueue_script( 'cycle2-script-scrollVert', get_template_directory_uri() . '/assets/frameworks/cycle2/js/jquery.cycle2.scrollVert.js', array( 'jquery' ), '20140128', true );
		
		wp_enqueue_script( 'cycle2-script-shuffle', get_template_directory_uri() . '/assets/frameworks/cycle2/js/jquery.cycle2.shuffle.js', array( 'jquery' ), '20140128', true );
		
		wp_enqueue_script( 'cycle2-script-tile', get_template_directory_uri() . '/assets/frameworks/cycle2/js/jquery.cycle2.tile.js', array( 'jquery' ), '20140128', true );
    
    	wp_enqueue_script( 'cycle2-script-swipe', get_template_directory_uri() . '/assets/frameworks/cycle2/js/jquery.cycle2.swipe.js', array( 'jquery' ), '20121120', true );
    	
    	wp_enqueue_script( 'cycle2-script-video-youtube', get_template_directory_uri() . '/assets/frameworks/cycle2/js/jquery.cycle2.video.js', array( 'jquery' ), '20130708', true );

		wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'expedition_scripts' );

/**
 * Enqueue custom script.
 */
function expedition_custom_scripts() {
	global $expedition_customizer_all_values;
		wp_register_script('expedition-custom', get_template_directory_uri() . '/assets/js/evision-custom.js', array('jquery'), '1.0.1', 1);
		wp_enqueue_script( "expedition-custom" );
	    wp_localize_script( "expedition-custom", "google_map_value", $expedition_customizer_all_values );
	}
add_action( "wp_enqueue_scripts", "expedition_custom_scripts" );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/expedition/class-customize.php' );
/*-----------------------------------------------------------------------------------*/
/*	Update Popular based on no user visit
/*-----------------------------------------------------------------------------------*/

function expedition_single_post_view_counter($postID) {
		$count_key = 'wpb_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if (empty($count)) {
			update_post_meta($postID, $count_key, 1);
		}
	}
add_action( 'save_post', 'expedition_single_post_view_counter' );



/*breadcrum function*/

if ( ! function_exists( 'expedition_simple_breadcrumb' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function expedition_simple_breadcrumb() {

        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            require_once get_template_directory() . '/assets/frameworks/breadcrumbs/breadcrumbs.php';
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );

    }

endif;
