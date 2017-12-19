<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @subpackage wordpost
 * @since      wordpost
 */
global $count_posts; ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<div class="format_status_title">
			<h3><?php the_author(); ?></h3>
			<span class="meta-title">
				<?php if ( is_singular() ) {
					printf( '<a href="%1$s" title="%2$s">%3$s</a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), the_title_attribute( 'echo=0' ), get_the_date() );
				} else {
					printf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>', esc_url( get_the_permalink() ), esc_attr( sprintf( __( 'Permalink to %s', 'wordpost' ), the_title_attribute( 'echo=0' ) ) ), get_the_date() );
				} ?>
			</span>
		</div><!-- end .format_status_title-->
		<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'wordpost_status_avatar', '48' ) ); ?>
	</div><!-- end .entry-header-->
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- end .entry-content -->
	<div class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'wordpost' ), '<span class="edit-link">', '</span>' ); ?>
		<?php if ( 1 < $count_posts ) { ?>
			<div class="top-link">
				<small>
					<a href="#top">[<?php _e( 'Top', 'wordpost' ); ?>]</a>
				</small>
			</div><!-- end .top-link -->
		<?php } // end if ( 1 < $count_posts ) ?>
	</div><!-- end .entry-meta -->
</div><!-- end #post -->
