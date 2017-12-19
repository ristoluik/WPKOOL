<?php
// Grab the HEX color value from theme options
$instablog_page_post_color = get_theme_mod( 'page_post_title_color');
$instablog_post_title_color = get_theme_mod( 'post_title_color');
$instablog_content_text_color = get_theme_mod( 'post_page_content_text_color');
$instablog_headertag_text_color = get_theme_mod( 'header_tag_text_color');

/*-----------------------------------------------------------------
These are dynamic accent color values generated by theme options
-----------------------------------------------------------------*/

$instablog_dynamic_accent = '.page-title, .instablog_page_title  {
	color: '.esc_html( $instablog_page_post_color ).'!important;
}
.instablog_post_title a, .instablog_post_title{
	color: '.esc_html( $instablog_post_title_color ).'!important;
}
.instablog_post_content {
	color: '.esc_html($instablog_content_text_color).'!important;
}
h1, h2, h3, h4, h5, h6 {
	color: '.esc_html($instablog_headertag_text_color).'!important;
}';