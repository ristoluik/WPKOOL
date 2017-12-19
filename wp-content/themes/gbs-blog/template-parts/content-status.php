<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package WordPress
 * @subpackage GBS_Blog
 * @since GBS Blog 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<header>
				<h1><?php the_author(); ?></h1>
				<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'gbs-blog' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo esc_html(get_the_date()); ?></a></h2>
			</header>
			<?php
			/**
			 * Filter the status avatar size.
			 *
			 * @since GBS Blog 1.0
			 *
			 * @param int $size The height and width of the avatar in pixels.
			 */
			$status_avatar = apply_filters( 'gbsblog_status_avatar', 48 );
			echo get_avatar( get_the_author_meta( 'ID' ), $status_avatar );
			?>
		</div><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'gbs-blog' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'gbs-blog' ) . '</span>', __( '1 Reply', 'gbs-blog' ), __( '% Replies', 'gbs-blog' ) ); ?>
			</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'gbs-blog' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
