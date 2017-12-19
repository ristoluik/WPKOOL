<?php
/**
 * GBS Blog functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development and
 * https://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions sSwould be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage GBS_Blog
 * @since GBS Blog 1.0
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 700;

/**
 * GBS Blog setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * GBS Blog supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since GBS Blog 1.0
 */
function gbsblog_setup() {
	/*
	 * Makes GBS Blog available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on GBS Blog, use a find and replace
	 * to change 'gbs-blog' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gbs-blog', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Adds <title> tag.
    add_theme_support( 'title-tag' );
    
	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'gbs-blog' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'gbs-blog' ) );
	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	//search form
	add_theme_support( 'html5', array(

        'search-form',

        'comment-form',

        'comment-list',

        'gallery',

        'caption',

    ) );
}
add_action( 'after_setup_theme', 'gbsblog_setup' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';


/*Enqueue fonts */

function gbsblog_add_google_fonts() {

wp_enqueue_style( 'gbsblog-fonts', 'https://fonts.googleapis.com/css?family=Ropa+Sans|Lato|Roboto|Open+Sans', false ); 

}

add_action( 'wp_enqueue_scripts', 'gbsblog_add_google_fonts' );



/**
 * Enqueue scripts and styles for front end.
 *
 * @since GBS Blog 1.0
 */
function gbsblog_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'gbsblog-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20140711', true );

		
	wp_enqueue_style( 'gbsblog-custom', get_template_directory_uri() .'/css/custom.css');
	
	// Loads our main stylesheet.
	wp_enqueue_style( 'gbsblog-style', get_stylesheet_uri() );
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css' );
    wp_enqueue_style( 'owl.theme', get_template_directory_uri() . '/css/owl.theme.default.css' );
    wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '20120206', true );
    wp_enqueue_script( 'gbsblog-custom', get_template_directory_uri() . '/js/custom.js');

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'gbsblog-ie', get_template_directory_uri() . '/css/ie.css', array( 'gbsblog-style' ), '20121010' );
	wp_style_add_data( 'gbsblog-ie', 'conditional', 'lt IE 9' );
	
		
	
}
add_action( 'wp_enqueue_scripts', 'gbsblog_scripts_styles' );


/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since GBS Blog 1.0
 */
function gbsblog_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'gbsblog_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since GBS Blog 1.0
 */
function gbsblog_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'gbs-blog' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'gbs-blog' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'gbs-blog' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'gbs-blog' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'gbs-blog' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'gbs-blog' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'gbs-blog' ),
		'id' => 'sidebar-4',
		'description' => __( 'Appears when using the optional footer', 'gbs-blog' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'gbsblog_widgets_init' );

if ( ! function_exists( 'gbsblog_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since GBS Blog 1.0
 */
function gbsblog_content_nav( $html_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'gbs-blog' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gbs-blog' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gbs-blog' ) ); ?></div>
		</nav><!-- .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'gbsblog_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own gbsblog_entry_meta() to override in a child theme.
 *
 * @since GBS Blog 1.0
 */
function gbsblog_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'gbs-blog' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'gbs-blog' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( 'View all posts by %s', get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = sprintf('This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', $categories_list,$tag_list, $date, $author);
	} elseif ( $categories_list ) {
		$utility_text = sprintf( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.',$categories_list,$tag_list,$date, $author);
	} else {
		$utility_text = sprintf( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', $date);
	}

	echo sprintf($utility_text);

}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since GBS Blog 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function gbsblog_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'gbsblog-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'gbsblog_body_class' );

/**

 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since GBS Blog 1.0
 */
 
 if ( ! isset( $content_width ) )
    $content_width = 640;
 
function gbsblog_adjust_content_width() {
    global $content_width;
 
   if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) )
        $content_width = 780;
}
add_action( 'template_redirect', 'gbsblog_adjust_content_width' );


function gbsblog_new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'gbsblog_new_excerpt_length');


function gbsblog_custom_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}