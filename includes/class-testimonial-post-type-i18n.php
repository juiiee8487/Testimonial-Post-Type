<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://profiles.wordpress.org/juiiee8487
 * @since      1.0.0
 *
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Testimonial_Post_Type
 * @subpackage Testimonial_Post_Type/includes
 * @author     Juhi Patel <juhir22495@gmail.com>
 */
class Testimonial_Post_Type_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'testimonial-post-type',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
