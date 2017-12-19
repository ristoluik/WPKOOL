<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package InstaBlog
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="off-canvas-wrap" data-offcanvas>

		<section class="container medium-uncollapse large-collapse full-column-height"> <!-- start container full-colum height -->
			<div class="column-row large-collapse"> <!-- start colum row -->

				<div class="main_sidebar_toggle_wrap">
					<?php do_action('instablog_main_sidebar_toogle'); ?>
				</div>

				<div id="masthead" class="site-header large-3 medium-12 column full-height" role="banner">
					<a class="skip-link sidebar-toggle hide-for-medium-only" href="javascript:void(0);"></a>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<div class="site_title_desc_wrap">
							<div class="instablog_custom_logo"><?php instablog_the_custom_logo(); ?></div>
							<h1 class="site-title home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
							<p class="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php
						endif; ?>
					</div>
					<a href="javascript:void(0);" class="c-sidebar-labelmobile js-label-menu">
						<span class="c-sidebar-menubar"></span>
					</a>

					<div class="menu-social-wrap hide-for-medium-only hide-for-small-only">
						<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
							<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_id' => 'primary-menu', 'depth' => '2') ); ?>
						<?php else : ?>

							<ul id="primary-menu-list">
								<?php wp_list_pages( 'title_li=&depth=1' ); ?>
							</ul>
						<?php endif; ?>
					</div>


					<div class="menu-social-wrap-responsive">
						<?php if ( has_nav_menu( 'header-menu' ) ) : ?>

							<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_id' => 'primary-menu', 'depth' => '2') ); ?>

						<?php else : ?>

							<ul id="primary-menu-list">
								<?php wp_list_pages( 'title_li=&depth=1' ); ?>
							</ul>

						<?php endif; ?>


					</div>

				</nav><!-- #site-navigation -->


				<div class="description-block large-3 medium-3 column hide-for-medium-only column hide-for-small-only">
					<p><?php $instablog_header_txt = get_theme_mod('homepage_text');

					echo wp_kses( $instablog_header_txt, array(
						'p' => array(),
						'a' => array(
							'href' => array(),
							'class' => array()
						)
					) );

					?></p>
					<?php do_action('instablog_bottom_social_links'); ?>

					<div class="instablog_footer_text">
						<?php
						if(get_theme_mod('show_footer_text') != 1){
							if(get_theme_mod('credits')){
								$credits = get_theme_mod('credits');
								echo $credits;
							} else {
								printf( __( '%1$s by %2$s','instablog'), '<a href="'.esc_url("https://www.shapedpixels.com/themes/instablog").'">InstaBlog Theme</a>', '<a href="'.esc_url("https://www.shapedpixels.com").'">Shaped Pixels</a>');
							}
						}

						?>
					</div>

				</div>

			</div><!-- #masthead -->
