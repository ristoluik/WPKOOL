<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage GBS_Blog
 * @since GBS Blog 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<article class="post type-post hentry">
			<header class="entry-header m0">
				<h1 class="entry-title"><?php printf('Search Results for: %s', '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>
			</article>
			<?php gbsblog_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php gbsblog_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'gbs-blog' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'gbs-blog' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>