<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage GBS_Blog
 * @since GBS Blog 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
<div class="no-remove-div">
				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

				<nav class="nav-single">
					<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'gbs-blog' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'gbs-blog' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'gbs-blog' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
<article class="post type-post hentry comments-area">
				<?php comments_template( '', true ); ?>
				</article>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>