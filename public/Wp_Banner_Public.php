<?php
/**
 * The public-specific functionality of the plugin.
 *
 * @class Wp_Banner_Public
 * @package    Wp_Banner_Public
 */

if ( ! class_exists( 'Wp_Banner_Public' ) ) {

	class Wp_Banner_Public {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

			$options = get_option( 'wp_banner_settings_fields' );
			$options_position = strtolower( $options[ 'position' ] );

			if ( $options_position == 'top' ) {
				add_action( 'wp_head', array( $this, 'include_predefined_templates' ) );

			} elseif ( $options_position == 'popup' ) {
				add_action( 'wp_head', array( $this, 'include_predefined_templates' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_popup' ) );

			} else {
				add_action( 'wp_footer', array( $this, 'include_predefined_templates' ) );
			}
		}

		// Script that will be executed only when popup is chosen
		public function enqueue_styles_popup() {
			wp_enqueue_style( 'wp_banner_public_popup_css', plugins_url( '/assets/css/wp_banner_public_popup.css', __FILE__ ) );
			wp_register_script( 'wp_banner_jquery_popup_public', plugins_url( '/assets/js/wp_banner_jquery_popup_public.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_script( 'wp_banner_jquery_popup_public', plugins_url( '/assets/js/wp_banner_jquery_popup_public.js', __FILE__ ), array( 'jquery' ) );
		}

		public function enqueue_styles() {
			wp_enqueue_style( 'wp_banner_public_css', plugins_url( '/assets/css/wp_banner_public.css', __FILE__ ) );
			wp_register_script( 'wp_banner_jquery_public', plugins_url( '/assets/js/wp_banner_jquery_public.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_script( 'wp_banner_jquery_public', plugins_url( '/assets/js/wp_banner_jquery_public.js', __FILE__ ), array( 'jquery' ) );
			wp_enqueue_script( 'wp_banner_js_public', plugins_url( '/assets/js/wp_banner_public.js', __FILE__ ) );
		}

		// Include predefined templates file on the front-end header
		public function include_predefined_templates() {
			include WP_BANNER_PLUGIN_PATH . '/public/templates/banner/banner_predefined_templates.php';
		}

	}
}

new Wp_Banner_Public();