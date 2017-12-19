<?php
//Set the width of the content
if ( ! isset( $content_width ) ) {
	$content_width = 620;
}

function wordpost_support_theme() {
	// Register the main navigation menu
	register_nav_menu( 'primary', __( 'Primary Menu', 'wordpost' ) );
	//Turn on the theme format support posts
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	// Ability to add thumbnails to posts
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_editor_style();
	// Add the ability to upload a header image
	$custom_head_wordpost = array(
		'default-text-color'  => 'fff',
		'default-image'       => '',
		'width'               => 941,
		'height'              => 60,
		'uploads'             => true,
		'wp-head-callback'    => 'wordpost_header_style',
		'admin-head-callback' => 'wordpost_admin_header_style',
	);
	add_theme_support( 'custom-header', $custom_head_wordpost );
	add_theme_support( 'title-tag' );
	/* Add theme support for Translation */
	load_theme_textdomain( 'wordpost', get_template_directory() . '/languages' );
}

// Specify the color of the header title
function wordpost_header_style() {
	$text_color = get_header_textcolor();
	if ( get_theme_support( 'custom-header', 'default-text-color' ) == $text_color ) {
		return;
	} ?>
	<style type="text/css">
		<?php // If the user does not want to show the text.
		if ( ! display_header_text() ) { ?>
			.site-title,
			.site-description {
				display: none;
			}

		<?php } else { ?>
			.site-title a,
			.site-title span {
				color: <?php echo '#' . $text_color; ?> !important;
			}

		<?php } ?>
	</style><?php // clear the background
	if ( get_background_image() == '' && get_background_color() != '' ) { ?>
		<style type="text/css">
			body {
				background-image: none;
			}
		</style>
	<?php }
}

function wordpost_admin_header_style() { ?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}

		#headimg {
			background-color: #267896;
		}

		#headimg h1 {
			font-size: 18px;
			display: inline;
			margin-left: 20px;
		}

		#headimg h1 a {
			text-decoration: none;
		}

		#desc {
			margin-left: 10px;
			display: inline;
		}

		#headimg img {
			max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
		}
	</style>
<?php }

// Register the sidebar
function wordpost_widgets_init() {
	register_sidebar( array(
		'name'        => __( 'Sidebar', 'wordpost' ),
		'id'          => 'primary-widget-area',
		'description' => __( 'This sidebar is located to the left of content', 'wordpost' ),
	) );
}

// Function to display the pagination of pages, posts, categories, archives.
function wordpost_the_breadcrumb() {
	if ( ! is_front_page() ) {
		echo '<a href="' . home_url() . '">' . __( 'Home', 'wordpost' ) . '</a>';
		if ( is_category() || is_single() ) {
			echo '&nbsp;-&nbsp;';
			single_cat_title();
			if ( is_single() ) {
				$category = get_the_category();
				if ( isset( $category[0] ) ) {
					echo $category[0]->cat_name . '&nbsp;-&nbsp;';
				}
				the_title();
			}
		} elseif ( is_page() ) {
			echo '&nbsp;-&nbsp;' . get_the_title();
		} elseif ( is_search() ) {
			echo '&nbsp;-&nbsp;' . __( 'Search Results', 'wordpost' );
		} elseif ( is_404() ) {
			echo '&nbsp;-&nbsp;' . __( 'Page not found', 'wordpost' );
		} elseif ( is_tag() ) {
			echo '&nbsp;-&nbsp;';
			echo single_tag_title() . '&nbsp;:&nbsp;' . __( 'tag', 'wordpost' );
		} elseif ( is_day() ) {
			echo '&nbsp;-&nbsp;' . get_the_time( 'j F, Y' ) . '&nbsp;:&nbsp;' . __( 'archive', 'wordpost' );
		} elseif ( is_month() ) {
			echo '&nbsp;-&nbsp;' . get_the_time( 'F, Y' ) . '&nbsp;:&nbsp;' . __( 'archive', 'wordpost' );
		}
	} else {
		_e( 'Home', 'wordpost' );
	}
}

// Connecting the supplied scripts and styles
function wordpost_scripts_method() {
	//Connect the main CSS stylesheet
	wp_enqueue_style( 'wordpost-style', get_stylesheet_uri() );
	wp_enqueue_style( 'wordpost-style-fonts', get_stylesheet_directory_uri() . '/fonts/fontstyle.css' );
	// Connect specific styles for IE versions using conditional comments
	wp_enqueue_style( 'wordpost-ie6', get_template_directory_uri() . '/css/ie6.css', array( 'wordpost-style' ) );
	wp_enqueue_style( 'wordpost-ie7', get_template_directory_uri() . '/css/ie.css', array( 'wordpost-style' ) );
	wp_enqueue_style( 'wordpost-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'wordpost-style' ) );
	wp_style_add_data( 'wordpost-ie6', 'conditional', 'IE 6' );
	wp_style_add_data( 'wordpost-ie7', 'conditional', 'IE 7' );
	wp_style_add_data( 'wordpost-ie8', 'conditional', 'IE 8' );
	// Connect with font style file
	wp_enqueue_script( 'wordpost-script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ) );
	$string_js = array(
		'chooseFile' => __( 'Choose file...', 'wordpost' ),
		'fileNotSel' => __( 'File is not selected.', 'wordpost' ),
	);
	wp_localize_script( 'wordpost-script', 'stringJs', $string_js );
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function wordpost_admin_script() {
	wp_enqueue_script( 'wordpost_admin_script', get_template_directory_uri() . '/js/script_admin.js', array( 'jquery' ) );
}

// show  comments
function wordpost_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p>
					<?php _e( 'Pingback:', 'wordpost' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'wordpost' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
			</li>
			<?php break;
		default :
			global $post; ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment">
					<div class="comment-meta comment-author vcard">
						<?php echo get_avatar( $comment, 44 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'wordpost' ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( __( '%1$s at %2$s', 'wordpost' ), get_comment_date(), get_comment_time() )
						); ?>
					</div><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wordpost' ); ?></p>
					<?php endif; ?>
					<section class="comment-content comment">
						<?php comment_text(); ?>
						<?php edit_comment_link( __( 'Edit', 'wordpost' ), '<p class="edit-link">', '</p>' ); ?>
					</section><!-- .comment-content -->
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'wordpost' ),
							'after'      => ' <span>&darr;</span>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) ); ?>
					</div><!-- .reply -->
				</div><!-- #comment-## -->
			</li>
			<?php break;
	endswitch; // end comment_type check
}

// show date of the creations of the post, in which category contains
function wordpost_entry_data() {
	echo __( 'Posted on', 'wordpost' ) . sprintf( ' <span class="meta-title"><a href="%1$s" title="%2$s">%3$s</a></span> ', esc_url( ( is_singular() ) ? get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) : get_the_permalink() ), the_title_attribute( 'echo=0' ), get_the_date() );
			 $categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		_e( 'in', 'wordpost' );
		echo '&nbsp;<span class="meta-title">' . $categories_list . '</span>';
	}
}

function wordpost_thumbnail_caption() {
	global $post;
	$thumbnail_number = get_post_thumbnail_id( $post->ID );
	$thumbnail_image  = get_posts( array( 'p' => $thumbnail_number, 'post_type' => 'attachment' ) );
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		echo '<p class="entry-caption thumbnail_caption">' . $thumbnail_image[0]->post_excerpt . '</p>';
	}
}

function wordpost_init_metabox() {
	global $wordpost_slide_metabox;
	// Create an array to set values in metaboxes admin panel to create slider
	$wordpost_slide_metabox = array(
		'id'       => 'display_images',
		'page'     => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'default',
		'fields'   => array(
			array(
				'name' => __( 'Title of the slide', 'wordpost' ),
				'id'   => 'wordpost_image_title',
			),
			array(
				'name' => __( 'URL-link for title', 'wordpost' ),
				'id'   => 'wordpost_image_url',
			),
			array(
				'name' => __( 'Description the slide', 'wordpost' ),
				'id'   => 'wordpost_image_description',
			),
		),
	);
}

//Create metaboxes to enter information about the slide Wordpress admin panel
function wordpost_add_slide_metabox() {
	add_meta_box(
		'Display_images',
		__( 'Display the current post in the slider', 'wordpost' ),
		'wordpost_display_image_custom_box',
		'post',
		'normal',
		'high'
	);
}

function wordpost_display_image_custom_box() {
	global $post, $wordpost_slide_metabox;
	echo '<div class="wrapper">';
	echo '<p>' . __( 'If the size of the picture in the slider you are not satisfied ,download the desired image and make it the featured image. The required size of the image - not less then 940px at 327px', 'wordpost' ) . '</p>';
	echo '<br /><input type="checkbox" class="wordpost_slide_image" name="wordpost_slide_image" value="yes" ' . ( 'yes' == get_post_meta( $post->ID, 'wordpost_slide_image', true ) ? 'checked="checked"' : '' ) . ' />  ' . __( 'Make the slide', 'wordpost' );
	echo '<div class="slide_settings_hide"><input type="hidden" name="wordpost_delete_slide" class="wordpost_delete_slide" />';
	foreach ( $wordpost_slide_metabox['fields'] as $field ) {
		echo '<br />' . $field['name'] . '<br /><input type="text" name="' . $field['id'] . '" value="' . get_post_meta( $post->ID, $field['id'], true ) . '" class="' . $field['id'] . '" style="width: 500px;" />';
	}
	echo '</div></div>'; ?>
	<div style="clear:both;"></div><?php
}

// Save the data entered in metaboxes
function wordpost_slide_meta_save( $post_id ) {
	global $post, $wordpost_slide_metabox;
	if ( isset( $_POST['wordpost_slide_image'] ) ) {
		$value = $_POST['wordpost_slide_image'];
		if ( get_post_meta( $post->ID, 'wordpost_slide_image', false ) ) {
			// Custom field has a value and this custom field exists in database
			update_post_meta( $post->ID, 'wordpost_slide_image', $value );
		} elseif ( $value ) {
			// Custom field has a value, but this custom field does not exist in database
			add_post_meta( $post->ID, 'wordpost_slide_image', $value );
		}
	}
	if ( isset( $_POST['wordpost_delete_slide'] ) && 'delete' == $_POST['wordpost_delete_slide'] ) {
		delete_post_meta( $post->ID, 'wordpost_slide_image' );
	}
	foreach ( $wordpost_slide_metabox['fields'] as $field ) {
		$meta_key       = $field['id'];
		$new_meta_value = ( isset( $_POST[ $meta_key ] ) ? stripslashes( $_POST[ $meta_key ] ) : '' );
		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		if ( $new_meta_value && '' == $meta_value ) {
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		} elseif ( '' == $new_meta_value && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}
}

add_action( 'after_setup_theme', 'wordpost_support_theme' );
add_action( 'wp_enqueue_scripts', 'wordpost_scripts_method' );
add_action( 'admin_enqueue_scripts', 'wordpost_admin_script' );
add_action( 'widgets_init', 'wordpost_widgets_init' );
add_action( 'init', 'wordpost_init_metabox' );
add_action( 'add_meta_boxes', 'wordpost_add_slide_metabox' );
add_action( 'save_post', 'wordpost_slide_meta_save' );
