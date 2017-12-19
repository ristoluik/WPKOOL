<?php
/**
 * InstaBlog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package InstaBlog
 */

 if (file_exists( locate_template('/pro/functions.php'))) {
 	include( locate_template('/pro/functions.php') );
 }

if ( ! function_exists( 'instablog_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function instablog_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on InstaBlog, use a find and replace
	 * to change 'instablog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'instablog', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header-menu' => esc_html__( 'Primary', 'instablog' ),
	) );


	// image size custom
	add_image_size( 'instablog_home_img_large', 666, 730, true );
	add_image_size( 'instablog_home_img_small', 276, 351, true);
	add_image_size( 'instablog_masonary_img', 260, 410, true );
	add_image_size( 'instablog_post_detail', 862, 579, true );
	add_image_size( 'instablog_blog_detail', 800, 400, true );
	add_image_size( 'instablog_masonary_img_listing', 324, 355, true );

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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'instablog_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Custom Logo
	add_theme_support( 'custom-logo',
				array(
				   'height'      => 150,
				   'width'       => 250,
				   'flex-width' => true,
				   'flex-height' => true,
			) );
}
endif;
add_action( 'after_setup_theme', 'instablog_setup' );

function wpexplorer_add_post_formats() {
	add_theme_support( 'post-formats', array(
		'gallery',
		'quote',
		'video',
		'aside',
		'image',
		'link'
	) );
}
add_action( 'after_setup_theme', 'wpexplorer_add_post_formats' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function instablog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'instablog_content_width', 640 );
}
add_action( 'after_setup_theme', 'instablog_content_width', 0 );


/**
 *
 * Add Custom editor styles
 *
 */
function instablog_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'instablog_add_editor_styles' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function instablog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'instablog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'instablog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'instablog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function theme_stylesheet_enqueue() {
  // Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'instablog-fonts', instablog_fonts_url(), array(), null );

	/* Register Styles */
	wp_register_style( 'instablog-foundation-normalize', get_template_directory_uri() . '/css/normalize.css',array(), true ); //Foundation Normalize
	wp_register_style( 'instablog-foundation', get_template_directory_uri() . '/css/foundation.css',array(), true  ); //Foundation

	/* Enqueue Styles */
	wp_enqueue_style( 'instablog-foundation-normalize' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, '4.4.0' );
	wp_enqueue_style( 'instablog-foundation' );
	wp_enqueue_style( 'instablog-style', get_stylesheet_uri() );
	wp_enqueue_style( 'instablog-dynamic-style', get_template_directory_uri() . '/style.css', false, '1.0.5' );

	$instablog_dynamic_accent = '';
	include get_template_directory().'/css/instablog-dynamic-css.php';
	wp_add_inline_style( 'instablog-dynamic-style', $instablog_dynamic_accent );

	if(get_theme_mod('show_theme_option')){
	  wp_enqueue_style( 'dark', get_template_directory_uri() . '/pro/css/dark.css', array(), true );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_stylesheet_enqueue' );

function instablog_scripts() {
	/* Register Scripts */
	wp_enqueue_script( 'instablog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	/* Add Foundation JS */
	wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/js/foundation/vendor/foundation.js', array( 'jquery' ), '6.3.1', true );
	wp_enqueue_script( 'foundation-modernizr-js', get_template_directory_uri() . '/js/foundation/vendor/modernizr.js', array( 'jquery' ), '2.7.2', true );

	if( is_archive() ) {
		wp_enqueue_script( 'jquery-masonry' );
		wp_enqueue_script( 'masonry' );
	}
	wp_enqueue_script( 'instablog-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1', true );

	wp_enqueue_script( 'imagesloaded-js', get_template_directory_uri() . '/js/imagesloaded.min.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'easing-js', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), '1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'instablog_scripts' );


/**
 * Register custom fonts.
 */
function instablog_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_serif_pro = _x( 'on', 'Source Serif Pro: on or off', 'instablog' );
	$dorid_serif = _x( 'on', 'Dorid Serif: on or off', 'instablog' );


	if ( 'off' !== $source_serif_pro || 'off' !== $dorid_serif || 'off' !== $ek_mukta ) {

		$font_families = array();

		if ( 'off' !== $source_serif_pro ) {
				$font_families[] = 'Source Serif Pro:300,300i,400,400i,600,600i,800,800i';
		}

		if ( 'off' !== $dorid_serif ) {
				$font_families[] = 'Droid Serif:300,300i,400,400i,600,600i,800,800i';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
include( locate_template( '/inc/customizer.php' ) );

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load InstaBlog extended functions
 */
require get_template_directory() . '/inc/instablog-functions.php';

require get_template_directory() . '/inc/post-dropdown.php';


if ( ! function_exists( 'instablog_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since caveat 1.0.0
	 */
	function instablog_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;


// display custom admin notice
function instablog_custom_admin_notice() {
	$enc_th_info = wp_get_theme();
	$currentversion = str_replace('.','',(esc_html( $enc_th_info->get('Version') )));
	$isitdismissed = 'instablog_notice_dismissed'.$currentversion;
	if ( !get_user_meta( get_current_user_id() , $isitdismissed ) ) { ?>
	<div class="notice notice-success is-dismissible instablog_notice" data-dismissible="disable-done-notice-forever">
		<div>
			<p>
			<?php _e('Thank you for using the free version of ','instablog'); ?>
			<?php echo esc_html( $enc_th_info->get('Name') );?> -
			<?php echo esc_html( $enc_th_info->get('Version') );
			 ?>
			<?php _e('theme. Want more features? Check out the', 'instablog'); ?>
			<a href="<?php echo esc_url( 'https://www.shapedpixels.com/themes/instablog/?utm_source=FreeThemes&utm_medium=UpdateMsg&utm_campaign=InstaBlog');?>" target="_blank" aria-label="Dismiss the welcome panel">
				<strong><?php _e('PRO version','instablog');?></strong>
			</a>
			<?php _e('for more options and professional support!', 'instablog'); ?>
			<a href="?instablog-notice-dismissed<?php echo $currentversion;?>">Dismiss this message</a>
			</p>
		</div>

	</div>

<?php
	}
 }
add_action('admin_notices', 'instablog_custom_admin_notice');

function instablog_notice_dismissed() {
	$enc_th_info = wp_get_theme();
	$currentversion = str_replace('.','',(esc_html( $enc_th_info->get('Version') )));
	$dismissurl = 'instablog-notice-dismissed'.$currentversion;
	$isitdismissed = 'instablog_notice_dismissed'.$currentversion;
    $user_id = get_current_user_id();
    if ( isset( $_GET[$dismissurl] ) )
        add_user_meta( $user_id, $isitdismissed, 'true', true );
}
add_action( 'admin_init', 'instablog_notice_dismissed' );
