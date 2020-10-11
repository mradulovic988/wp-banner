<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @class Wp_Banner_Admin
 * @package    Wp_Banner_Admin
 */

if ( ! class_exists( 'Wp_Banner_Admin' ) ) {

	class Wp_Banner_Admin {

		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		}

		public function enqueue_styles() {
			wp_enqueue_style( 'wp_banner_admin_css', plugins_url( '/assets/css/wp_banner_admin.css', __FILE__ ) );
			wp_register_script( 'wp_banner_jquery_admin', plugins_url( '/assets/js/wp_banner_jquery_admin.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_script( 'wp_banner_jquery_admin', plugins_url( '/assets/js/wp_banner_jquery_admin.js', __FILE__ ), array( 'jquery' ) );
		}
	}

	new Wp_Banner_Admin();
}