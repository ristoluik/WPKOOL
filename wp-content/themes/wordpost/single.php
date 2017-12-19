<?php
/**
 * The single template file.
 *
 * @subpackage wordpost
 * @since      wordpost
 */
get_header();
get_sidebar(); ?>
<div id="wordpost_content"><a id="top"></a>
	<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); // loop
			get_template_part( 'post_format', get_post_format() ); // Call the template of a certain format post
		} // end of the loop.?>
		<div class="post">
			<span class="nav-previous">
				<?php previous_post_link(); ?>
			</span>
			<span class="nav-next">
				<?php next_post_link(); ?>
			</span>
			<?php comments_template(); ?>
		</div><!-- end .post -->
	<?php } ?>
</div><!-- end #content -->
<?php get_footer();
