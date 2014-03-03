<?php
/**
 * Plugin Name: Tuxquote
 * Plugin URI: https://github.com/eldougo/wordpress_plugin_tuxquote
 * Description: Show a random image of Tux the Linux penguin with a random quote.
 * Version: 0.1
 * Author: Craig Douglas
 * Author URI: https://github.com/eldougo
 * License: GPL2
 */
 
 /*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

	This program is free software; you can redistribute it and/or modify
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

add_shortcode( 'TUXQUOTE', 'tuxquote_main' );

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
	$quotes = file( plugin_dir_path( __FILE__ )."/quotes.txt");
	return $quotes[ array_rand($quotes,1) ];
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

/*
 * Return HTML encoded random image and quote.
 */
function tuxquote_main() {
	return  "\n<div style='float: right; width:256px; '>\n"
		."  <img src='".tuxquote_choose_image()."'><br />\n"
		."  <p align='middle'>".tuxquote_choose_quote()."</p>\n"
		."</div>\n";
}

?>

