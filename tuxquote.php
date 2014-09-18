<?php
/**
 * Plugin Name: Tuxquote
 * Plugin URI: https://github.com/eldougo/wordpress_plugin_tuxquote
 * Description: Show a random image of Tux the Linux penguin with a random quote.
 * Version: 1.3
 * Author: Craig Douglas
 * Author URI: https://github.com/eldougo
 * License: GPL2
 */

 /* This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die("No script kiddies please!");
add_shortcode( 'TUXQUOTE', 'tuxquote_main' );

define('TUXQUOTE_DEFAULT_WIDTH', '256px'); // Default div width for shortcode print.
define('TUXQUOTE_DEFAULT_ALIGN', 'right'); // Default div alignment.

/**
 * Callback used to determine if the passed file is an image.
 */
function tuxquote_is_image( $file_name ) {
	return strpos( $file_name, '.jpg' )
	||     strpos( $file_name, '.png' )
	||     strpos( $file_name, '.gif' );
}

/**
* Return a random quote.
*/
function tuxquote_choose_quote() {
	$quotes = file( plugin_dir_path( __FILE__ )."/quotes.txt" );
	return $quotes[ array_rand( $quotes,1 ) ];
}

/**
 * Chose and format a random image.
 */
function tuxquote_choose_image() {
	$image_url   = plugins_url( 'images/', __FILE__ );
	$image_dir   = plugin_dir_path( __FILE__ ).'images/';
	$image_array = array_filter( scandir( $image_dir ), 'tuxquote_is_image' );
	return $image_url.$image_array[ array_rand($image_array,1) ];
}

/**
 * Build and format HTML output.
 *
 * @param   string  $div_width   Div width in pixels or percentage [NN%|NNpx].
 * @param   string  $align       Div float alignment [none|left|right].
 * @param   string  $title       Div title, optional.
 */
 function tuxquote_build_format( $div_width, $align, $title = '' ) {
	if ( empty( $div_width ) ) {
		$div_width = TUXQUOTE_DEFAULT_WIDTH;
	}
	if ( is_numeric( $div_width ) ) {
		$div_width = trim( $div_width ) . "%";
	}
    if ( empty( $align ) ) {
	$align = TUXQUOTE_DEFAULT_ALIGN;
    }
	if ( ! empty( $title ) ) {
		 $title_line = "  <p style='text-align: center; font-weight: 900'>" . $title . "</p>\n";
	} else {
		$title_line = '';
	}
	return  "\n<div style='float: " . $align . "; width: " . $div_width . "; '>\n"
			.$title_line
			."  <img style='width:100%' src='".tuxquote_choose_image()."'><br />\n"
			."  <p style='text-align: center'>".tuxquote_choose_quote()."</p>\n"
			."</div>\n";
 }

/**
 * Return HTML encoded random image and quote.
 */
function tuxquote_main( $atts ) {
	$a = shortcode_atts( array( 'width' => TUXQUOTE_DEFAULT_WIDTH,
	                            'align' => TUXQUOTE_DEFAULT_ALIGN,
	                            'title' => ''  ), $atts );
	return  tuxquote_build_format( $a['width'], $a['align'], $a['title'] );
}

/**
 * Add Tuxquote_Widget widget.
 */
class Tuxquote_Widget extends WP_Widget {

	const DEFAULT_WIDTH = '100%'; // Default div with for widget print.

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'tuxquote_widget', // Base ID
			__('Tuxquote', 'tuxquote_domain'), // Name
			array( 'description' => __( 'Show a random image of Tux the Linux penguin with a random quote.','tuxquote_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args	 Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		if ( empty( $instance['width'] ) ) {
			$instance['width'] = self::DEFAULT_WIDTH;
		}
	if ( empty( $instance['align'] ) ) {
		$instance['align'] = TUXQUOTE_DEFAULT_ALIGN;
	}
		echo tuxquote_build_format( $instance['width'], $instance['align'], '' );
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '';
		}

		if ( isset( $instance[ 'width' ] ) ) {
			$width = $instance[ 'width' ];
		}
		else {
			$width = self::DEFAULT_WIDTH;
		}

	if ( isset( $instance[ 'align' ] ) ) {
		$align = $instance[ 'align' ];
	}
	else {
		$align = TUXQUOTE_DEFAULT_ALIGN;
	}

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>">
		<label for="<?php echo $this->get_field_id( 'align' ); ?>"><?php _e( 'Alignment:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>" type="text" value="<?php echo esc_attr( $align ); ?>">
		</p>
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
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : self::DEFAULT_WIDTH;
		$instance['align'] = ( ! empty( $new_instance['align'] ) ) ? strip_tags( $new_instance['align'] ) : TUXQUOTE_DEFAULT_ALIGN;

		return $instance;
	}

} // class Tuxquote_Widget

// register Tuxquote_Widget widget
function register_tuxquote_widget() {
	register_widget( 'Tuxquote_Widget' );
}
add_action( 'widgets_init', 'register_tuxquote_widget' );
