<?php
/**
 * File with code of slider.
 * @subpackage wordpost
 * @since      wordpost
 */

$args = array(
	'post_type'           => 'post',
	'meta_key'            => 'wordpost_slide_image',
	'meta_value'          => 'yes',
	'posts_per_page'      => '100',
	'ignore_sticky_posts' => 1,
	'meta_query'          => array(
		array(
			'key'     => '_thumbnail_id',
			'compare' => 'EXISTS',
		),
	),
);

// Apply a new global variable The Query
$the_query = new WP_Query( $args );
// Check The Query, if any posts - we show a slider
if ( $the_query->have_posts() ) { // show a slider ?>
	<div id="slider-wrap">
		<div id="slider">
			<?php while ( $the_query->have_posts() ) {
				$the_query->the_post(); // The Loop?>
				<div class="slide">
					<?php the_post_thumbnail(); // show one slide ?>
					<div class="title_slide">
						<h1>
							<?php if ( '' != get_post_meta( $post->ID, 'wordpost_image_url', true ) ) {
								echo '<a href="' . esc_url( get_post_meta( $post->ID, 'wordpost_image_url', true ) ) . '">';
							} // link in title of the slide
							echo get_post_meta( $post->ID, 'wordpost_image_title', true ); // title of the slide
							if ( '' != get_post_meta( $post->ID, 'wordpost_image_url', true ) ) {
								echo '</a>';
							} ?>
						</h1>
						<?php if ( '' != get_post_meta( $post->ID, 'wordpost_image_description', true ) ) { // text of the slide
							echo '<p>' . get_post_meta( $post->ID, 'wordpost_image_description', true ) . '</p>';
						} ?>
					</div><!--end .title_slide-->
				</div><!-- end .slide-->
			<?php } // end of The Loop ?>
		</div><!-- end #slider-->
	</div><!-- end #slider-wrap-->
<?php } // end of custom loop
wp_reset_postdata();
