<?php
/**
 * The 404 page template file.
 *
 * @subpackage wordpost
 * @since      wordpost
 */
get_header();
get_sidebar(); ?>
	<div id="wordpost_content">
		<div class="post">
			<h2 class="entry-title"><?php _e( 'Nothing Found', 'wordpost' ); ?></h2>
			<p><?php _e( 'There is no such page on this address.', 'wordpost' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- end .post -->
	</div><!-- end #content -->
<?php get_footer();
