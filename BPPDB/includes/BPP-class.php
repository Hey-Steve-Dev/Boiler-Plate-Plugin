<?php
/**
 * Adds your plugin to the widget area. This will allow you to register the widget, diplay the widget on the front end, display the widget in the admin, and update the 
 * widget from the backend. this extends the WP_Widget class giving it functionality
 */
class BPP_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'BPP_widget', // Base ID
            esc_html__( 'Widget Title BPP', 'BPP_domain' ), // Name
			array( 'description' => esc_html__( 'A blank widget from BPP', 'BPP_domain' ), ) //this is the discription of the widget on the backend widget area
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
        echo $args['before_widget'];//whatever you want to display before widgets
        
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        //widget content output. this is what will be displayed wherever you drop the widget. 
        echo "<H2>Widget Output</H2>";
        

		echo $args['after_widget'];//whatever you want to display after widgets
	}

	/**
	 * Back-end widget form.
	 * This displays the widget form area on the backend, this will handle the title and other fileds
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

        //this sets the title of the widget
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'BPP title', 'BPP_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'BPP_domain' ); ?></label> 
		<input 
        class="widefat" 
        id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
        type="text" 
        value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 * This area is used for updating and saving the widget on the backend
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} 
