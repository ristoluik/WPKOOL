<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @subpackage wordpost
 * @since      wordpost
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	wp_head(); ?>
</head>
<body <?php body_class( 'wordpost' ); ?>>
<div id="wrapper">
	<div id="header">
		<div id="header_top">
			<div id="masthead">
				<div id="helper_head">
					<div id="Nameblog" class="site-header">
						<h3 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							<span> // <?php bloginfo( 'description' ); ?></span>
						</h3>
					</div><!-- end #Nameblog .site-header-->
					<div id="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); // Main menu ?>
					</div><!-- end menu #navigation-->
				</div><!-- end #helper_head-->
			</div><!-- end #masthead-->
		</div><!-- end #header_top-->
		<div class="clear"></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) { // If the user has downloaded the image in custom-Header - then show it ?>
			<img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php } ?>
		<div id="headbottom">
			<div id="site-description">
				<h1>
					<?php if ( is_page() ) {
						echo the_title();
					} else {
						_e( 'Welcome to our blog!', 'wordpost' );
					} ?>
				</h1>
				<div class="pagination1">
					<?php wordpost_the_breadcrumb(); ?>
				</div><!--end .pagination-->
			</div><!--end #site-description-->
			<div id="search">
				<?php get_search_form(); //call the search form ?>
			</div>
		</div><!-- end #headbottom -->
	</div><!-- end #header  -->
	<div id="main-content">
