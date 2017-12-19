<?php
/**
 * The template for displaying posts in the Aside post format
 * @subpackage wordpost
 * @since      wordpost
 */
global $count_posts; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="aside">
		<h3 class="entry-title">
			<?php if ( is_singular() ) {
				the_title();
			} else {
				the_title( '<a href="' . get_the_permalink() . '">', '</a>' );
			} ?>
		</h3>
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- end .entry-content -->
	</div><!-- end .aside -->
	<div class="entry-meta">
		<?php wordpost_entry_data();
		edit_post_link( __( 'Edit', 'wordpost' ), '<span class="edit-link">', '</span>' ); ?>
		<?php if ( 1 < $count_posts ) { ?>
			<div class="top-link">
				<small>
					<a href="#top">[<?php _e( 'Top', 'wordpost' ); ?>]</a>
				</small>
			</div><!-- end .top-link -->
		<?php } // end if ( 1 < $count_posts ) ?>
	</div><!-- end .entry-meta -->
</div><!-- end #post -->
