<?php
/**
 * The template for displaying posts in the Status post format
 * @subpackage wordpost
 * @since      wordpost
 */ ?>
<div id="post-0" class="post no-results not-found">
	<h2 class="entry-title"><?php _e( 'Nothing Found', 'wordpost' ); ?></h2>
	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'wordpost' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- end .entry-content -->
</div><!-- end #post-0 -->
