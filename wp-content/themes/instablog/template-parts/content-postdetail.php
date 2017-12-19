<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package InstaBlog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post_detail'); ?> >
	<header class="entry-header">
		<?php $instablog_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'instablog_post_detail', true ); ?>
		<img src="<?php echo esc_url( $instablog_thumb_url[0] ); ?>"/>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<div class="instablog_post_title"><?php the_title(); ?></div>
		<div class="instablog_post_author">BY <?php echo get_the_author(); ?></div>
		<div class="instablog_post_datesection"><?php echo get_the_date( 'l F j, Y' );?>
		<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Comment ', 'comments title', 'instablog' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Comments',
						'%1$s Comments',
						$comments_number,
						'comments title',
						'instablog'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
		?>
		<?php the_category(', '); ?></div>
		<div class="instablog_post_content">
			<?php
			 	$cap = substr ( get_the_content() , 0 , 1 );
				echo '<span class="dropcap">' . $cap . '</span>';
				the_content();
			?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
