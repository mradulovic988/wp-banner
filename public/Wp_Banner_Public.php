<?php
/**
 * The public-specific functionality of the plugin.
 *
 * @class Wp_Banner_Public
 * @package    Wp_Banner_Public
 */

if ( ! class_exists( 'Wp_Banner_Public' ) ) {

	class Wp_Banner_Public {

		public function __construct()
		{
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

			$options = get_option( 'wp_banner_settings_fields' );
			$options_position = strtolower( $options[ 'position' ] );

			if ( $options_position == 'top' ) {
				add_action( 'wp_head', array( $this, 'include_predefined_templates' ) );
			} else {
				add_action( 'wp_footer', array( $this, 'include_predefined_templates' ) );
			}
		}

		public function enqueue_styles() {
			wp_enqueue_style( 'public_css', plugins_url( '/assets/css/public.css', __FILE__ ) );
			wp_register_script( 'jquery_public', plugins_url( '/assets/js/jquery_public.js', __FILE__ ), [ 'jquery' ] );
			wp_enqueue_script( 'jquery_public', plugins_url( '/assets/js/jquery_public.js', __FILE__ ), [ 'jquery' ] );
			wp_enqueue_script( 'js_public', plugins_url( '/assets/js/public.js', __FILE__ ) );
		}

		// Include predefined templates file on the front-end header
		public function include_predefined_templates()
		{
			include WP_BANNER_PLUGIN_PATH . '/public/templates/banner/banner_predefined_templates.php';
		}

	}
}

new Wp_Banner_Public();