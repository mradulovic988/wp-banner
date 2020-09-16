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
			wp_register_script( 'jquery_admin', plugins_url( '/assets/js/jquery_admin.js', __FILE__ ), [ 'jquery' ] );
			wp_enqueue_script( 'jquery_admin', plugins_url( '/assets/js/jquery_admin.js', __FILE__ ), [ 'jquery' ] );
		}
	}

	new Wp_Banner_Admin();
}