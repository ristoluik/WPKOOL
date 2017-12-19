<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package InstaBlog
 */

get_header(); ?>

	<div id="primary" class="content-area large-9 medium-12 small-12 column" role="main">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="instablog_masonary_wrap">
				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'category' );

					endwhile;
					?>
			</div>
			<div class="clearfix"></div>
			<?php
			if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {

			} else {
			?>
			<div class="row">
				<ul class="pagination pagination-blog" role="navigation" aria-label="Pagination">
					<?php echo paginate_links(); ?>
				</ul>
			</div>
			<?php } ?>
		<?php
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
