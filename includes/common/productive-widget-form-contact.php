<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

/**
 * Productive_Forms_Widget_Contact
 */
class Productive_Forms_Widget_Contact extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
        public function __construct() {
            $widget_options = array(
                    'classname'                   => 'productive_widget_container',
                    'description'                 => __( 'Displays Productive Contact Form', 'productive-forms' ),
                    'customize_selective_refresh' => true,
                    'show_instance_in_rest'       => false,
            );
            parent::__construct( 'productive_forms_widget_contact', // Widget ID
                    esc_html__( 'Productive Contact', 'productive-forms' ), // Name
                    $widget_options 
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
            
            $title         = ! empty( $instance['title'] ) ? $instance['title'] : '';
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            
            echo $args['before_widget'];
            echo '<div class="productive_widget_container_content">';
            
            if ( $title ) {
                    echo $args['before_title'] . $title . $args['after_title'];
            }
            
            $is_formonly = array(
                'is_formonly' => 1
            );
            productive_forms_contact_form($is_formonly);
            
            echo '</div>';
            echo $args['after_widget'];
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
           $instance             = $old_instance;
           $new_instance         = wp_parse_args(
                   (array) $new_instance,
                   array(
                           'title'    => '',
                   )
           );
           $instance['title']    = sanitize_text_field( $new_instance['title'] );
           return $instance;
   }

   /**
    * Back-end widget form.
    */
   public function form( $instance ) {
           $instance = wp_parse_args(
           (array) $instance,
           array(
                   'title'    => '',
           )
       );
           ?>
           <p>
               <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_attr( 'Title:', 'productive-forms' ); ?></label>                 
               <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
           </p>
           <?php 
   }

}

function productive_forms_contact_register_widget() {
    register_widget( 'Productive_Forms_Widget_Contact' );
}
add_action( 'widgets_init', 'productive_forms_contact_register_widget');