<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function expedition_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'expedition' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Top Header Section', 'expedition' ),
        'id'            => 'sidebar-header-top',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar(array(
        'name' => __('Footer Column One', 'expedition'),
        'id' => 'footer-col-one',
        'description' => __('Displays items on footer section.','expedition'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ));
        register_sidebar(array(
            'name' => __('Footer Column Two', 'expedition'),
            'id' => 'footer-col-two',
            'description' => __('Displays items on footer section.','expedition'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
        register_sidebar(array(
            'name' => __('Footer Column Three', 'expedition'),
            'id' => 'footer-col-three',
            'description' => __('Displays items on footer section.','expedition'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
}
add_action( 'widgets_init', 'expedition_widgets_init' );


/**
 * Header section widget.
 */
require get_template_directory() . '/inc/widgets/header-top.php';