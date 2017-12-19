<?php
/**
 * The search template file.
 *
 * @subpackage wordpost
 * @since      wordpost
 */
get_header();
get_sidebar(); ?>
<div id="wordpost_content"><a id="top"></a>
	<div class="post search_result">
		<h2 class="entry-title">
			<?php _e( 'You searched for', 'wordpost' );
			echo ' <span>' . get_search_query() . '.</span> ';
			_e( 'Here is the results:', 'wordpost' ); ?>
		</h2>
	</div><!-- end .post search_result -->
	<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'post_format', get_post_format() );
			$count_posts ++;
		} // end of the loop. ?>
		<div class="nav_post_link">
			<div class="alignleft"><?php next_posts_link( __( '&laquo; Older posts', 'wordpost' ), '' ) ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Newer posts &raquo;', 'wordpost' ) ) ?></div>
		</div><!-- end .nav_post_link -->
	<?php } else { //end have_posts() check, when posts are present?>
	<div class="post">
		<h2 class="entry-title"><?php _e( 'Nothing Found', 'wordpost' ); ?></h2>
		<p><?php _e( 'Sorry, but nothing matched your search keywords.', 'wordpost' ); ?></p>
		<?php get_search_form(); ?>
	</div>
	<?php } ?><!-- end post -->
</div><!-- end #content -->
<?php get_footer();
