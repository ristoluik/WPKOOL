<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage GBS_Blog
 * @since GBS Blog 1.0
 */
?>
	</div><!-- #main .wrapper -->
	
</div><!-- #page -->
<footer id="colophon" role="contentinfo">
		<div class="container">
		<div class="site-info">
			<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
			<?php endif; ?>
		</div><!-- .site-info -->
		<div class="copyright">
			<div class="span4"><span class="crf">Copyright &copy; <?php echo esc_html(date_i18n(__('Y','gbs-blog'))); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</span></div>
			<div class="span8"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-menu','depth' => 1 ) ); ?></div>
		</div>
		</div>
	</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>