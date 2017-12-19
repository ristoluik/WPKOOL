<?php
/**
 * The template used for displaying page content in page.php
 *
 * @subpackage wordpost
 * @since      wordpost
 */
global $count_posts; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2 class="entry-title">
		<?php if ( is_singular() ) {
			the_title();
		} else {
			the_title( '<a href="' . get_the_permalink() . '">', '</a>' );
		} ?>
	</h2>
	<div class="entry-content">
		<?php the_content(); ?>
		<div class="pagination_list">
			<?php wp_link_pages(); ?>
		</div><!-- end .pagination_list -->
	</div><!-- end .entry-content -->
	<div class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'wordpost' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- end .entry-meta -->
	<?php if ( 1 < $count_posts ) { ?>
		<div class="top-link">
			<small>
				<a href="#top">[<?php _e( 'Top', 'wordpost' ); ?>]</a>
			</small>
		</div><!-- end .top-link -->
	<?php } // end if ( 1 < $count_posts ) ?>
</div><!-- end #post -->
