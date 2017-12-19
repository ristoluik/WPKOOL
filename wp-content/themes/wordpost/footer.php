<?php
/**
 * The template for displaying the footer.
 * @subpackage wordpost
 * @since      wordpost
 */
?>
<div class="clear"></div>
</div><!-- end #main -->
</div><!-- end #wrapper -->
<div id="footer">
	<div id="foot_top">
		<p>
			<?php echo '&copy; ' . date_i18n( 'Y ' ) . get_bloginfo( 'name' ) ?>
		</p>
		<div id="foot_author">
			<p><?php _e( 'Powered by ', 'wordpost' ); ?>
				<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>">BestWebLayout</a></p>
		</div><!-- end #foot_author -->
	</div><!-- end #foot_top -->
</div><!-- end #footer -->
<?php wp_footer(); ?>
</body>
</html>
