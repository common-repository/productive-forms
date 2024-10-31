<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

/**
 * Productive_Forms_Widget_Newsletter
 */
class Productive_Forms_Widget_Newsletter extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
        public function __construct() {
            $widget_options = array(
                    'classname'                   => 'productive_widget_container',
                    'description'                 => __( 'Displays Productive Newsletter Form', 'productive-forms' ),
                    'customize_selective_refresh' => true,
                    'show_instance_in_rest'       => false,
            );
            parent::__construct( 'productive_forms_widget_newsletter', // Widget ID
                    esc_html__( 'Productive Newsletter', 'productive-forms' ), // Name
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
            
            $productive_forms_newsletter_layout        = ! empty( $instance['productive_forms_newsletter_layout'] ) ? $instance['productive_forms_newsletter_layout'] : 'portrait';

            echo $args['before_widget'];
            echo '<div class="productive_widget_container_content">';
            
            if ( $title ) {
                    echo $args['before_title'] . $title . $args['after_title'];
            }
            
            if ( $productive_forms_newsletter_layout === 'portrait') {
                productive_forms_newsletter_form();
            } else {
                productive_forms_newsletter_form_landscape();
            }
            
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
				'productive_forms_newsletter_layout' => '',
			)
		);
		$instance['title']    = sanitize_text_field( $new_instance['title'] );
		$instance['productive_forms_newsletter_layout']     = sanitize_text_field( $new_instance['productive_forms_newsletter_layout'] );
		return $instance;
	}
        
	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
                $instance = wp_parse_args(
                (array) $instance,
                array(
                        'title'    => 'Newsletter',
                        'productive_forms_newsletter_layout'    => '',
                )
            );
		?>
		<p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_attr( 'Title:', 'productive-forms' ); ?></label>                 
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
                <p>
                    <label for="<?php echo $this->get_field_id( 'productive_forms_newsletter_layout' ); ?>"><?php echo esc_html__( 'Choose a Layout?', 'productive-forms' ); ?></label>
                    <select id="<?php echo $this->get_field_id( 'productive_forms_newsletter_layout' ); ?>" name="<?php echo $this->get_field_name( 'productive_forms_newsletter_layout' ); ?>">
                        <option value=''><?php echo esc_html__( '&mdash; Select &mdash;', 'productive-forms' ); ?></option>
                        <option value="portrait" <?php selected( 'portrait', esc_attr( $instance['productive_forms_newsletter_layout'] ) ); ?>>
                            <?php echo esc_html__( 'Portrait Layout', 'productive-forms' ); ?>
                        </option>
                        <option value="landscape" <?php selected( 'landscape', esc_attr( $instance['productive_forms_newsletter_layout'] ) ); ?>>
                            <?php echo esc_html__( 'Landscape Layout', 'productive-forms' ); ?>
                        </option>
                    </select>
                </p>
		<?php 
	}

}

function productive_forms_newsletter_register_widget() {
    register_widget( 'Productive_Forms_Widget_Newsletter' );
}
add_action( 'widgets_init', 'productive_forms_newsletter_register_widget');