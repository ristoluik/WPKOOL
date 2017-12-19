<?php
/**
 * File Name: InstaBlog-function
 * @package InstaBlog
 * @author ShapedPixels
 * @since version since 1.0
 * @uses contain functions to extend features
*/


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */


// Main social icons
if ( ! function_exists( 'instablog_social_links' ) ) :
/**
 * @author ShapedPixels
 * @action_hook bottom_social_links
 * @uses social media links with icon
*/

function instablog_social_links_fnc() {
		?>
		<div class="social hide-for-medium-only">
			<?php
			if(get_theme_mod('instablog_fburl')){ ?>
				<a href="<?php echo esc_url( get_theme_mod('instablog_fburl')); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<?php }?>
			<?php
			if(get_theme_mod('instablog_instaurl')){ ?>
				<a href="<?php echo esc_url( get_theme_mod('instablog_instaurl')); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			<?php }?>
			<?php
			if(get_theme_mod('instablog_twitterurl')){ ?>
				<a href="<?php echo esc_url( get_theme_mod('instablog_twitterurl')); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<?php }?>
		</div>
		<?php
	}
	endif;

add_action( 'instablog_bottom_social_links', 'instablog_social_links_fnc', 10 );

// sidebar toogle section
if ( ! function_exists( 'instablog_main_sidebar_toggle_fnc' ) ) :
/**
 * @author ShapedPixels
 * @action_hook bottom_social_links
 * @uses social media links with icon
*/

function instablog_main_sidebar_toggle_fnc() {

		?>
		<div class="sidebar_toogle_wrap">
			<div class="clearfix">
				<div class="close_btn_dynamic_sidebar clearfix"><img src="<?php
				echo esc_url( get_template_directory_uri() );?>/images/icons/close_btn.png"></div>
			</div>
			<div class="instablog_content_sidebar_wrap">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div>
		</div>
		<?php
	}
	endif;

add_action( 'instablog_main_sidebar_toogle', 'instablog_main_sidebar_toggle_fnc', 10 );
