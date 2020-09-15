<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @class Wp_Banner_Admin
 * @package    Wp_Banner_Admin
 */

if ( ! class_exists( 'Wp_Banner_Admin' ) ) {

	class Wp_Banner_Admin {

		public function __construct()
		{
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		}

		public function enqueue_styles()
		{
			wp_enqueue_style( 'admin_css', plugins_url( '/assets/css/admin.css', __FILE__ ) );
		}
	}

	new Wp_Banner_Admin();
}