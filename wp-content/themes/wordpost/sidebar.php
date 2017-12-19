<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @subpackage wordpost
 * @since      wordpost
 */
?>
<div id="sidebar" class="widget-area">
	<?php if ( is_active_sidebar( 'primary-widget-area' ) ) {
		dynamic_sidebar( 'primary-widget-area' );
	} else {
		the_widget( 'WP_Widget_Categories' );
	} ?>
</div><!-- end #sidebar .widget-area -->
