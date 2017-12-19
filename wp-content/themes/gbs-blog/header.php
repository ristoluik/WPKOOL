<?php
/**
* The Header template for our theme
*
* Displays all of the <head> section and everything up till <div id="main">
*
* @package WordPress
* @subpackage GBS_Blog
* @since GBS Blog 1.0
*/
?><!DOCTYPE html>
	<!--[if IE 7]>
	<html class="ie ie7" <?php language_attributes(); ?>>
		<![endif]-->
		<!--[if IE 8]>
		<html class="ie ie8" <?php language_attributes(); ?>>
			<![endif]-->
			<!--[if !(IE 7) & !(IE 8)]><!-->
			<html <?php language_attributes(); ?>>
				<!--<![endif]-->
				<head>
					<meta charset="<?php bloginfo( 'charset' ); ?>" />
					<meta name="viewport" content="width=device-width" />
					<link rel="profile" href="http://gmpg.org/xfn/11" />
					<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
					<?php wp_head(); ?>
							
				</head>
				<body <?php body_class(); ?>>
					<header id="masthead" class="site-header" role="banner">
						<div class="container">
							<hgroup>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<div class="search-col"><?php get_search_form(); ?><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/search-icon.png" /></div>
							</hgroup>
						</div>
						<div class="navigation-section">
							<div class="container">
								<nav id="site-navigation" class="main-navigation" role="navigation">
									<button class="menu-toggle"><?php esc_html_e( 'Menu', 'gbs-blog' ); ?></button>
									<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'gbs-blog' ); ?>"><?php esc_html_e( 'Skip to content', 'gbs-blog' ); ?></a>
									<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
									</nav><!-- #site-navigation -->
								</div>
							</div>
							<?php if ( get_header_image() ) : ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
							<?php endif; ?>
							</header><!-- #masthead -->
	
                            
                 <div id="homeslider" class="owl-carousel owl-theme">
                 <?php
                    $carousel_cat = get_theme_mod('carousel_setting','1');
                    $carousel_count = get_theme_mod('count_setting','4');
                    $new_query = new WP_Query( array( 'cat' => $carousel_cat  , 'showposts' => $carousel_count ));
                    while ( $new_query->have_posts() ) : $new_query->the_post(); ?>
                 	<?php if ( has_post_thumbnail() ) { ?>
                    <div class="item">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                        <div id="slidecaption" class="owl-caption">
                              <div class="slider-text-heading"><a href="<?php echo esc_url(get_permalink($post->ID));?>"><?php the_title();?></a></div>
                              <span class="slider-post-date"><?php echo get_the_date(); ?></span>
                        </div>
                     </div>
                 
                    <?php }
                        endwhile;
                        wp_reset_postdata(); 
                    ?>
                 
                </div>           
                            
							<div id="page" class="hfeed site">								
								<div id="main" class="wrapper">