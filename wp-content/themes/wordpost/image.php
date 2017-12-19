<?php
/**
 * The template for displaying image attachments.
 *
 * @subpackage wordpost
 * @since      wordpost
 */
get_header();
get_sidebar(); ?>
<div id="wordpost_content">
	<?php while ( have_posts() ) {
		the_post(); // the Loop ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<div class="entry-meta">
				<?php _e( 'Posted on', 'wordpost' );
				echo '<span class="meta-title"><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . get_the_date() . '</a></span>';
				echo __( 'in', 'wordpost' ) . ' <span class="meta-title"><a href="' . esc_url( get_permalink( $post->post_parent ) ) . '">' . get_the_title( $post->post_parent ) . '</a></span><br>';
				_e( 'Size of image', 'wordpost' );
				$data_attach = wp_get_attachment_metadata();
				echo ' <span class="meta-title"><a href="' . esc_url( wp_get_attachment_url() ) . '">' . $data_attach['width'] . '&nbsp;&times;&nbsp;' . $data_attach['height'] . '</a></span>';
				edit_post_link( __( 'Edit', 'wordpost' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- end .entry-meta -->
			<span class="nav-previous"><?php previous_image_link( false, __( '&larr; Previous image', 'wordpost' ) ); ?></span>
			<span class="nav-next"><?php next_image_link( false, __( 'Next image &rarr;', 'wordpost' ) ); ?></span>
			<div class="clear"></div>
			<div class="entry-content">
				<div class="attachment">
					<?php echo wp_get_attachment_image( $post->ID, 'full' );
					if ( ! empty( $post->post_excerpt ) ) { ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- end .entry-caption -->
					<?php } ?>
				</div><!-- end .attachment -->
				<?php the_content(); ?>
			</div><!-- end .entry-content -->
			<?php comments_template(); ?>
		</div><!-- end #post -->
	<?php } // end of the loop. ?>
</div><!-- end #content -->
<?php get_footer();
