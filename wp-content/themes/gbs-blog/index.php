<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage GBS_Blog
 * @since GBS Blog 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>

				<?php while(have_posts()) : the_post(); ?>
		
				<article class="post type-post hentry">
                
              <?php 
	  $thumb_class = '';
	  if ( !has_post_thumbnail() ){ $thumb_class = "con-full"; } ?>
					<div class="blog-img"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('', array('class' => 'alignleft')); ?></a></div>
                    
					<div class="blog-content <?php echo esc_html($thumb_class); ?>">
					<?php the_category(); ?>
					<header class="entry-header"><h1 class="entry-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h1></header>
					<div class="post-author">By <?php the_author_posts_link(); ?> &nbsp;<?php echo get_the_date(get_option( 'date_format' )); ?></div>
					<div class="entry-content">
						<?php if (is_home()): ?>
							<?php the_excerpt(); ?>
						<?php else: ?>
							<?php the_content();?>
						<?php endif ?>
					</div>

					<a href="<?php echo esc_url(get_permalink()); ?>" class="read-btn">Read More</a>
					</div>
				</article>
			<?php endwhile; ?>
			
			

			<?php gbsblog_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'No posts to display', 'gbs-blog' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf('Ready to publish your first post? <a href="%s">Get started here</a>.', esc_url(admin_url( 'post-new.php' ) )); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'gbs-blog' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'gbs-blog' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>


			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
