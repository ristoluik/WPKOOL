<?php
/**
 * Template part for displaying posts in category and index page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package InstaBlog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('masonary-post'); ?>>
	<?php
		$instablog_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'instablog_masonary_img_listing', true );
	?>
	<div class="instablog_post_wrap <?php if( !has_post_thumbnail() ){ echo 'instablog_post_no_img'; } ?>">
		<?php if( has_post_thumbnail() ): ?>
			<img src="<?php echo esc_url( $instablog_thumb_url[0] );?>" class="instablog_hover_me">
		<?php endif; ?>
			<div class="jorunal_post_text_wrap instablog_jover_show">
				<div class="cat_list"><?php the_category(', '); ?></div>
				<div class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></div>
				<div class="post_author"><?php esc_html_e('BY ', 'instablog');?><?php the_author(); ?></div>
				<div class="post_content"><?php echo wp_trim_words( get_the_content(), 15,'...' ); ?></div>
			</div>
	</div>

</article><!-- #post-## -->
