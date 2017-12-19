<?php
/**
 * The template for displaying Comments.
 * @subpackage wordpost
 * @since      wordpost
 */
if ( post_password_required() ) {
	return;
}
if ( have_comments() ) { ?>
	<div id="comments" class="comments-area">
		<h2 class="comments-title">
			<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'wordpost' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
		</h2><!-- end .comments-title -->
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'wordpost_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- end .commentlist -->
		<div class='previous-comments'><?php previous_comments_link( __( '&larr; Older Comments', 'wordpost' ) ); ?></div>
		<div class='next-comments'><?php next_comments_link( __( 'Newer Comments &rarr;', 'wordpost' ) ); ?></div>
		<div class="clear"></div>
	</div><!-- end #comments .comments-area -->
<?php }
if ( ! comments_open() ) { ?>
	<p class='nocomments'><?php _e( 'Comments are closed.', 'wordpost' ); ?></p>
<?php }
comment_form();
