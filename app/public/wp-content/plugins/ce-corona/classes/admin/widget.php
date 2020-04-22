<?php
namespace CoderExpert\Corona;
/**
* Adds Corona_Widget widget.
*/
class Corona_Widget extends \WP_Widget {
    
    /**
    * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'corona_widget', // Base ID
            'Corona Virus Data', // Name
            array( 'description' => __( 'A widget for display coronavirus data in your sidebar.', 'ce-corona' ), ) // Args
        );
    }
    
    /**
    * Front-end display of widget.
    *
    * @see WP_Widget::widget()
    *
    * @param array $args     Widget arguments.
    * @param array $instance Saved values from database.
    */
    public function widget( $args, $instance ) {
        extract( $args );
        $title            = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
        $confirmed_title  = isset( $instance[ 'confirmed_title' ] ) ? $instance[ 'confirmed_title' ] : __( 'Confirmed Cases', 'ce-corona' );
        $deaths_title     = isset( $instance[ 'deaths_title' ] ) ? $instance[ 'deaths_title' ] : __( 'Total Deaths', 'ce-corona' );
        $recovered_title  = isset( $instance[ 'recovered_title' ] ) ? $instance[ 'recovered_title' ] : __( 'Total Recovered', 'ce-corona' );
        $ce_display_type  = isset( $instance[ 'ce_display_type' ] ) ? $instance[ 'ce_display_type' ] : 'country_wise';
        $ce_display_items = isset( $instance[ 'ce_display_items' ] ) ? $instance[ 'ce_display_items' ] : 'all';
        $country_code     = isset( $instance[ 'country_code' ] ) ? $instance[ 'country_code' ] : 'BD';
        $update_time      = isset( $instance[ 'update_time' ] ) ? $instance[ 'update_time' ] : '';

        wp_enqueue_style( 'ce-corona-wp-widget' );
        wp_enqueue_script( 'ce-elementor-corona-nformat' );
        wp_enqueue_script( 'ce-corona-wp-widget' );
        
        $output = $before_widget;
        if ( ! empty( $title ) ) {
            $output .= $before_title . $title . $after_title;
        }
        $output .= '<div class="corona_widget_inner cec-country-widget-loading cec-widget-skin-1">';
            if( $ce_display_type === 'country_wise' ) {
                $output .= '<div class="widget_corona_single_country" country_code="'. $country_code .'">';
                    $output .= '<img class="widget_corona_single_country_flag" src="'. CE_CORONA_ASSETS . 'images/corona-bg.jpg' .'"/>';
                    $output .= '<div class="widget_corona_single_country_time">';
                        $output .= '<h3>'. Shortcode::countries()[ \strtoupper( $country_code ) ] .'</h3>';
                        $output .= $update_time === 'on' ? '<span class="widget_corona_update_time">Last Update: <span class="widget_corona_time">5 mins ago</span></span>' : '';
                    $output .= '</div>';
                $output .= '</div>';
            } else {
                $output .= $update_time === 'on' ? '<span class="widget_corona_update_time">Last Update: <span class="widget_corona_time">5 mins ago</span></span>' : '';
            }
            if( $ce_display_items == 'all' || $ce_display_items == 'confirmed' ) {
                $output .= '<div class="widget_corona_single widget_corona_confirmed">';
                    $output .= '<p class="cec-case-title">'. $confirmed_title .'</p>';
                    $output .= '<p class="cec-case-number">0</p>';
                $output .= '</div>';
            }
            if( $ce_display_items == 'all' || $ce_display_items == 'recovered' ) {
                $output .= '<div class="widget_corona_single widget_corona_recovered">';
                    $output .= '<p class="cec-case-title">'. $recovered_title .'</p>';
                    $output .= '<p class="cec-case-number">0</p>';
                $output .= '</div>';
            }
            if( $ce_display_items == 'all' || $ce_display_items == 'deaths' ) {
                $output .= '<div class="widget_corona_single widget_corona_deaths">';
                    $output .= '<p class="cec-case-title">'. $deaths_title .'</p>';
                    $output .= '<p class="cec-case-number">0</p>';
                $output .= '</div>';
            }
        $output .= '</div>';
        $output .= $after_widget;

        echo $output;
    }
    
    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
    */
    public function form( $instance ) {
        $title            = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Corona Virus Data', 'ce-corona' );
        $confirmed_title  = isset( $instance[ 'confirmed_title' ] ) ? $instance[ 'confirmed_title' ] : __( 'Confirmed Cases', 'ce-corona' );
        $deaths_title     = isset( $instance[ 'deaths_title' ] ) ? $instance[ 'deaths_title' ] : __( 'Total Deaths', 'ce-corona' );
        $recovered_title  = isset( $instance[ 'recovered_title' ] ) ? $instance[ 'recovered_title' ] : __( 'Total Recovered', 'ce-corona' );
        $ce_display_type  = isset( $instance[ 'ce_display_type' ] ) ? $instance[ 'ce_display_type' ] : 'country_wise';
        $country_code     = isset( $instance[ 'country_code' ] ) ? $instance[ 'country_code' ] : 'BD';
        $ce_display_skin  = isset( $instance[ 'ce_display_skin' ] ) ? $instance[ 'ce_display_skin' ] : 'skin-1';
        $ce_display_items = isset( $instance[ 'ce_display_items' ] ) ? $instance[ 'ce_display_items' ] : 'all';
        $update_time      = isset( $instance[ 'update_time' ] ) ? $instance[ 'update_time' ] : 'on';
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'ce_display_skin' ); ?>"><?php _e( 'Skin: ', 'ce-corona' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'ce_display_skin' ); ?>" id="<?php echo $this->get_field_id( 'ce_display_skin' ); ?>">
                <option value="skin-1" <?php echo selected( $ce_display_skin, 'skin-1' ); ?>><?php _e( 'Skin 1', 'ce-corona' ); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'ce_display_type' ); ?>"><?php _e( 'Display Type: ', 'ce-corona' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'ce_display_type' ); ?>" id="<?php echo $this->get_field_id( 'ce_display_type' ); ?>">
                <option value="global" <?php echo selected( $ce_display_type, 'global' ); ?>><?php _e( 'Global', 'ce-corona' ); ?></option>
                <option value="country_wise" <?php echo selected( $ce_display_type, 'country_wise' ); ?>><?php _e( 'Country-wise Data', 'ce-corona' ); ?></option>
            </select>
        </p>
        <p class="cec_country_code <?php echo $ce_display_type === 'country_wise' ? '' : 'hidden'; ?>">
            <label for="<?php echo $this->get_field_name( 'country_code' ); ?>"><?php _e( 'Country Code:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'country_code' ); ?>" name="<?php echo $this->get_field_name( 'country_code' ); ?>" type="text" value="<?php echo esc_attr( $country_code ); ?>" />
            <span>Feel free to find out more coutry code from the <a href="<?php echo admin_url( 'admin.php?page=ce-corona' );?>">Documentation</a>.</span>
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'ce_display_items' ); ?>"><?php _e( 'Display: ', 'ce-corona' ); ?></label>
            <select name="<?php echo $this->get_field_name( 'ce_display_items' ); ?>" id="<?php echo $this->get_field_id( 'ce_display_items' ); ?>">
                <option value="all" <?php echo selected( $ce_display_items, 'all' ); ?>><?php _e( 'All', 'ce-corona' ); ?></option>
                <option value="confirmed" <?php echo selected( $ce_display_items, 'confirmed' ); ?>><?php _e( 'Confirmed', 'ce-corona' ); ?></option>
                <option value="recovered" <?php echo selected( $ce_display_items, 'recovered' ); ?>><?php _e( 'Recovered', 'ce-corona' ); ?></option>
                <option value="deaths" <?php echo selected( $ce_display_items, 'deaths' ); ?>><?php _e( 'Deaths', 'ce-corona' ); ?></option>
            </select>
        </p>
        <p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'update_time' ); ?>" name="<?php echo $this->get_field_name( 'update_time' ); ?>" type="checkbox" <?php echo checked( $update_time, 'on' ); ?> />
            <label for="<?php echo $this->get_field_name( 'update_time' ); ?>"><?php _e( 'Display Update Time?' ); ?></label>
        </p>
        <hr>
        <p class="cec_confirmed_title <?php echo ( $ce_display_items === 'confirmed' || $ce_display_items === 'all' ) ? '' : 'hidden'; ?>">
            <label for="<?php echo $this->get_field_name( 'confirmed_title' ); ?>"><?php _e( 'Confirmed Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'confirmed_title' ); ?>" name="<?php echo $this->get_field_name( 'confirmed_title' ); ?>" type="text" value="<?php echo esc_attr( $confirmed_title ); ?>" />
        </p>
        <p class="cec_recovered_title <?php echo ( $ce_display_items === 'recovered' || $ce_display_items === 'all' ) ? '' : 'hidden'; ?>">
            <label for="<?php echo $this->get_field_name( 'recovered_title' ); ?>"><?php _e( 'Recovered Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'recovered_title' ); ?>" name="<?php echo $this->get_field_name( 'recovered_title' ); ?>" type="text" value="<?php echo esc_attr( $recovered_title ); ?>" />
        </p>
        <p class="cec_deaths_title <?php echo ( $ce_display_items === 'deaths' || $ce_display_items === 'all' ) ? '' : 'hidden'; ?>">
            <label for="<?php echo $this->get_field_name( 'deaths_title' ); ?>"><?php _e( 'Deaths Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'deaths_title' ); ?>" name="<?php echo $this->get_field_name( 'deaths_title' ); ?>" type="text" value="<?php echo esc_attr( $deaths_title ); ?>" />
        </p>
        <script>
            (function( $ ){
                $( document ).ready(function(){
                    var display_type = $('#<?php echo $this->get_field_id( 'ce_display_type' ); ?>');
                    if( display_type.length > 0 ) {
                        display_type.on('change', function( e ){
                            if( e.currentTarget.value === 'country_wise' ) {
                                $( e.currentTarget ).parent().siblings('.cec_country_code').removeClass('hidden');
                            } else {
                                $( e.currentTarget ).parent().siblings('.cec_country_code').addClass('hidden');
                            }
                        })
                    }
                    var ce_display_items = $('#<?php echo $this->get_field_id( 'ce_display_items' ); ?>');
                    if( ce_display_items.length > 0 ) {
                        ce_display_items.on('change', function( e ){
                            if( e.currentTarget.value === 'all' ) {
                                $( e.currentTarget ).parent().siblings('.cec_deaths_title').removeClass('hidden');
                                $( e.currentTarget ).parent().siblings('.cec_recovered_title').removeClass('hidden');
                                $( e.currentTarget ).parent().siblings('.cec_confirmed_title').removeClass('hidden');
                            } else {
                                $( e.currentTarget ).parent().siblings('.cec_deaths_title').removeClass('hidden');
                                $( e.currentTarget ).parent().siblings('.cec_recovered_title').removeClass('hidden');
                                $( e.currentTarget ).parent().siblings('.cec_confirmed_title').removeClass('hidden');
                                if( e.currentTarget.value === 'confirmed' ) {
                                    $( e.currentTarget ).parent().siblings('.cec_deaths_title').addClass('hidden');
                                    $( e.currentTarget ).parent().siblings('.cec_recovered_title').addClass('hidden');
                                }
                                if( e.currentTarget.value === 'deaths' ) {
                                    $( e.currentTarget ).parent().siblings('.cec_confirmed_title').addClass('hidden');
                                    $( e.currentTarget ).parent().siblings('.cec_recovered_title').addClass('hidden');
                                }
                                if( e.currentTarget.value === 'recovered' ) {
                                    $( e.currentTarget ).parent().siblings('.cec_confirmed_title').addClass('hidden');
                                    $( e.currentTarget ).parent().siblings('.cec_deaths_title').addClass('hidden');
                                }
                            }
                        })
                    }
                });
            })( jQuery )
        </script>
        <?php
    }
    
    /**
    * Sanitize widget form values as they are saved.
    *
    * @see WP_Widget::update()
    *
    * @param array $new_instance Values just sent to be saved.
    * @param array $old_instance Previously saved values from database.
    *
    * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {
        $instance           = array();
        $instance['title']            = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['confirmed_title']  = ( !empty( $new_instance['confirmed_title'] ) ) ? strip_tags( $new_instance['confirmed_title'] ) : __( 'Confirmed Cases', 'ce-corona' );
        $instance['deaths_title']     = ( !empty( $new_instance['deaths_title'] ) ) ? strip_tags( $new_instance['deaths_title'] ) : __( 'Total Deaths', 'ce-corona' );
        $instance['recovered_title']  = ( !empty( $new_instance['recovered_title'] ) ) ? strip_tags( $new_instance['recovered_title'] ) : __( 'Total Recovered', 'ce-corona' );
        $instance['ce_display_type']  = ( ! empty( $new_instance['ce_display_type'] ) ) ? strip_tags( $new_instance['ce_display_type'] ) : 'country_wise';
        $instance['ce_display_skin']  = ( ! empty( $new_instance['ce_display_skin'] ) ) ? strip_tags( $new_instance['ce_display_skin'] ) : 'skin-1';
        $instance['ce_display_items'] = ( ! empty( $new_instance['ce_display_items'] ) ) ? strip_tags( $new_instance['ce_display_items'] ) : 'all';
        $instance['country_code']     = ( ! empty( $new_instance['country_code'] ) ) ? strip_tags( $new_instance['country_code'] ) : 'BD';
        $instance['update_time']      = ( ! empty( $new_instance['update_time'] ) ) ? strip_tags( $new_instance['update_time'] ) : '';
        return $instance;
    }
    
} // class Corona_Widget