<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 *
 * @subpackage wordpost
 * @since      wordpost
 */
get_header();
// connect the slider
get_template_part( 'slider' );
get_sidebar();
$count_posts = 1; ?>
	<div id="wordpost_content"><a id="top"></a>
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
		<?php } else { //Action if no posts ?>
			<div id="post-0" class="post no-results not-found">
				<?php if ( current_user_can( 'edit_posts' ) ) {// Show a different message depending on what the user logged ?>
					<h2 class="entry-title"><?php _e( 'No posts to display', 'wordpost' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Ready to publish your first post?', 'wordpost' ); ?>
							<a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php _e( 'Get started here', 'wordpost' ); ?></a>
						</p>
					</div><!-- end .entry-content -->
				<?php } else { // Show default message for other users ?>
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'wordpost' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'wordpost' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- end .entry-content -->
				<?php } // end current_user_can() ?>
			</div><!-- #post-0 -->
		<?php } // end of the block action when no posts ?>
	</div><!-- end #content -->
<?php get_footer();
