<?php
/**
 * @link              https://mlab-studio.com
 * @since             1.0.0
 * @package           Wp_Banner
 *
 * @wordpress-plugin
 * Plugin Name:       WP Banner
 * Plugin URI:        https://wordpress.org/plugins/top-bar
 * Description:       Really simple plugin for Header Banner
 * Donate link:       http://example.com/
 * Version:           1.0.0
 * Author:            Marko Radulovic
 * Author URI:        https://mlab-studio.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-banner
 * Domain Path:       /languages
 */

 if ( ! class_exists( 'Wp_Banner' ) ) {

    class Wp_Banner {

        public function __construct() {
	        if ( ! defined( 'WP_BANNER_PLUGIN_PATH' ) ) {
                define ( 'WP_BANNER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
	        }

	        if ( ! defined( 'WP_BANNER_PLUGIN_BASENAME' ) ) {
                define ( 'WP_BANNER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
	        }

	        /**
	         * Including all major files for the WP Banner plugin
	         */
	        if ( is_admin() ) {
		        include WP_BANNER_PLUGIN_PATH . '/includes/settings_api/Wp_Banner_Settings_Api.php';
		        include WP_BANNER_PLUGIN_PATH . '/admin/Wp_Banner_Admin.php';

		        $this->load_plugin_textdomain();

	        } else {
		        include WP_BANNER_PLUGIN_PATH . '/public/Wp_Banner_Public.php';
	        }
        }

	    public function load_plugin_textdomain() {
		    load_plugin_textdomain( 'wp-banner', false, WP_BANNER_PLUGIN_BASENAME . dirname( __FILE__ ) . '/languages' );
	    }

    }

    new Wp_Banner();
 }