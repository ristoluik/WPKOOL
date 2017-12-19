<?php
if ( ! class_exists( 'expedition_header_top_Widget' ) ) :

    /**
     * Author Widget Class
     *
     * @since Expedition 1.0.0
     *
     */
    class expedition_header_top_Widget extends WP_Widget {

        function __construct() {
            parent::__construct(
                'expedition_header_top', // Base ID
                'Top Header Section Widget', // Name
                array( 'description' => __( 'Top Header Sections short information with font icons', 'expedition' ) ) // Args
            );
        }


        function widget( $args, $instance ) {
            extract( $args );
            $custom_class      = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );
            
            $fontawesome_icon_1        = empty($instance['fontawesome_icon_1']) ? 'phone' : $instance['fontawesome_icon_1'];
            $Content_detail_1        = empty($instance['Content_detail_1']) ? '123-456-789' : $instance['Content_detail_1'];
            $fontawesome_icon_2        = empty($instance['fontawesome_icon_2']) ? 'envelope' : $instance['fontawesome_icon_2'];
            $Content_detail_2        = empty($instance['Content_detail_2']) ? 'contactinfo@domain.com' : $instance['Content_detail_2'];                            
            $fontawesome_icon_3        = empty($instance['fontawesome_icon_3']) ? '' : $instance['fontawesome_icon_3'];
            $Content_detail_3        = empty($instance['Content_detail_3']) ? '' : $instance['Content_detail_3'];
            $custom_class       = apply_filters( 'widget_custom_class', empty( $instance['custom_class'] ) ? '' : $instance['custom_class'], $instance, $this->id_base );

            if ( $custom_class ) {
                $before_widget = str_replace('class="', 'class="'. $custom_class . ' ', $before_widget);
            }

            echo $before_widget;
            ?>
                <div class="contact-widget">
                    <ul><?php 
                        if( !empty( $fontawesome_icon_1) && !empty( $Content_detail_1 ) ) { 2
                        ?>
                            <li>
                                <a href="tel:<?php echo esc_html( $Content_detail_1); ?>"><i class="fa fa-<?php echo esc_html( $fontawesome_icon_1 ); ?>"></i><?php echo esc_html( $Content_detail_1); ?></a>
                            </li>
                        <?php }
                        if( !empty( $fontawesome_icon_2) && !empty( $Content_detail_2 )){
                        ?>
                            <li>
                                <a href="mailto:<?php echo esc_html( $Content_detail_2); ?>"><i class="fa fa-<?php echo esc_html( $fontawesome_icon_2 ); ?>"></i><?php echo esc_html( $Content_detail_2); ?></a>
                            </li>
                        <?php
                        }
                        if( !empty( $fontawesome_icon_3) && !empty( $Content_detail_3 )){
                        ?>
                            <li>
                                <i class="fa fa-<?php echo esc_html( $fontawesome_icon_3 ); ?>"></i><?php echo esc_textarea( $Content_detail_3); ?>
                            </li>
                        <?php
                        }?>
                    </ul>
                </div><!-- widget-list -->
            <?php
            //
            echo $after_widget;
        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance['fontawesome_icon_1']        =   esc_html( strip_tags($new_instance['fontawesome_icon_1']) );
            $instance['Content_detail_1']           =   esc_html(strip_tags( $new_instance['Content_detail_1']) );
            $instance['fontawesome_icon_2']        =   esc_html( strip_tags($new_instance['fontawesome_icon_2']) );
            $instance['Content_detail_2']           =   esc_html(strip_tags( $new_instance['Content_detail_2']) );
            $instance['fontawesome_icon_3']        =   esc_html( strip_tags($new_instance['fontawesome_icon_3']) );
            $instance['Content_detail_3']           =   wp_kses_post( $new_instance['Content_detail_3'] );
            
            return $instance;
        }

        function form( $instance ) {
            $expedition_font_icon_link = 'http://fontawesome.io/icons';

            //Defaults
            $instance = wp_parse_args( (array) $instance, array(
                'fontawesome_icon_1'              => 'phone',
                'Content_detail_1'                => '123-456-789',
                'fontawesome_icon_2'              => 'envelope',
                'Content_detail_2'                => 'contactinfo@domain.com',
                'fontawesome_icon_3'              => '',
                'Content_detail_3'                => '',

            ) );
            $fontawesome_icon_1              = esc_attr( $instance['fontawesome_icon_1'] );
            $Content_detail_1           = esc_attr( $instance['Content_detail_1'] );
            $fontawesome_icon_2              = esc_attr( $instance['fontawesome_icon_2'] );
            $Content_detail_2           = esc_attr( $instance['Content_detail_2'] );
            $fontawesome_icon_3              = esc_attr( $instance['fontawesome_icon_3'] );
            $Content_detail_3          = ( $instance['Content_detail_3'] );

            // $fontawesome_icon_1 = isset($instance['fontawesome_icon_1'])?$instance['fontawesome_icon_1']:'phone';
            ?>

            <p>
                <?php _e( 'Use font awesome icon : "Eg: phone" <br /> ', 'expedition' ); ?><a href="<?php echo ($expedition_font_icon_link);?>" target="_blank"> <?php _e( 'See more here', 'expedition' ); ?></a>
                <label for="<?php echo $this->get_field_id( 'fontawesome_icon_1' ); ?>"><?php _e( '<br /><b> Icon : </b>', 'expedition' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'fontawesome_icon_1' ); ?>" name="<?php echo $this->get_field_name( 'fontawesome_icon_1'); ?>" type="text" value="<?php echo esc_attr( $fontawesome_icon_1 ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'Content_detail_1' ); ?>"><?php _e( '<b>Info Content : </b>', 'expedition' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'Content_detail__1' ); ?>" name="<?php echo $this->get_field_name( 'Content_detail_1' ); ?>" type="text" value="<?php echo esc_attr( $Content_detail_1 ); ?>" />
                <br /><br /> <hr />
            </p>
            <p>
                <?php _e( 'Use font awesome icon : "Eg: envelope" <br /> ', 'expedition' ); ?><a href="<?php echo ($expedition_font_icon_link);?>" target="_blank"> <?php _e( 'See more here', 'expedition' ); ?></a>
                <label for="<?php echo $this->get_field_id( 'fontawesome_icon_2' ); ?>"><?php _e( '<br /><b> Icon : </b>', 'expedition' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'fontawesome_icon_2' ); ?>" name="<?php echo $this->get_field_name( 'fontawesome_icon_2'); ?>" type="text" value="<?php echo esc_attr( $fontawesome_icon_2 ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'Content_detail_2' ); ?>"><?php _e( '<b>Info Content : </b>', 'expedition' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'Content_detail__2' ); ?>" name="<?php echo $this->get_field_name( 'Content_detail_2' ); ?>" type="text" value="<?php echo esc_attr( $Content_detail_2 ); ?>" />
                <br /><br /> <hr />
            </p>

            <p>
                <?php _e( 'Use font awesome icon : "Eg: user" <br /> ', 'expedition' ); ?><a href="<?php echo ($expedition_font_icon_link);?>" target="_blank"> <?php _e( 'See more here', 'expedition' ); ?></a>
                <label for="<?php echo $this->get_field_id( 'fontawesome_icon_3' ); ?>"><?php _e( '<br /><b> Icon : </b>', 'expedition' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'fontawesome_icon_3' ); ?>" name="<?php echo $this->get_field_name( 'fontawesome_icon_3'); ?>" type="text" value="<?php echo esc_attr( $fontawesome_icon_3 ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'Content_detail_3' ); ?>"><?php _e( '<b>Info Content : </b>', 'expedition' ); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'Content_detail__3' ); ?>" name="<?php echo $this->get_field_name( 'Content_detail_3' ); ?>" type="text">
                    <?php echo esc_textarea( $Content_detail_3 ); ?>
                </textarea>
            </p>
            <?php
        }

    }

endif;

add_action( 'widgets_init', 'expedition_header_top_widgets' );

if ( ! function_exists( 'expedition_header_top_widgets' ) ) :

    /**
     * Load widgets
     *
     * @since Expedition Pro 1.0
     *
     */
    function expedition_header_top_widgets() {
        register_widget( 'expedition_header_top_Widget' );
    }

endif;