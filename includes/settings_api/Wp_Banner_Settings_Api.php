<?php
/**
 * Class Wp_Banner_Settings_Api
 * All major methods for Settings API
 *
 * @class Wp_Banner_Settings_Api
 * @package Wp_Banner_Settings_Api
 * @version 1.0.0
 * @author Marko Radulovic
 */

if ( ! class_exists( 'Wp_Banner_Settings_Api' ) ) {

	class Wp_Banner_Settings_Api {

	    // Create multidimensional array for all of the settings
		protected $defaults = array(
			'general' => array(
				'enable_bar' => false, // Disable by default
                ''
			),
			'notice' => array(
				'message_in_text' => '',
			),
		);

		public function __construct()
		{
			/**
			 * Including all of the pages for the Settings API
			 */
			include WP_BANNER_PLUGIN_PATH . '/includes/settings_api_pages/Wp_Banner_Page_Banner.php';

			// Error notice for submiting results
			add_action( 'admin_notices', array( $this, 'show_error_notice' ) );
		}

		/**
		 * Show notice message on form submit
		 */
		public function show_error_notice()
		{
			settings_errors();
		}

		public function menu_page()
		{
			add_menu_page( __( 'WP Banner', 'wp-banner'), __( 'WP Banner', 'wp-banner'), 'manage_options', 'wp_banner', array( $this, 'wp_banner_main' ), 'dashicons-clipboard' );
			add_submenu_page( 'wp_banner', __( 'WP Banner', 'wp-banner' ), __( 'WP Banner', 'wp-banner' ), 'manage_options', 'wp_banner', array( $this, 'wp_banner_main' ) );
			add_submenu_page( 'wp_banner', __( 'Cookies', 'wp-banner' ), __( 'Cookies', 'wp-banner' ), 'manage_options', 'wp_cookies', array( $this, 'wp_banner_cookies' ) );
			add_submenu_page( 'wp_banner', __( 'Maintenance Mode', 'wp-banner' ), __( 'Maintenance Mode', 'wp-banner' ), 'manage_options', 'wp_maintenance', array( $this, 'wp_banner_maintenance' ) );
			add_submenu_page( 'wp_banner', __( 'Popup', 'wp-banner' ), __( 'Popup', 'wp-banner' ), 'manage_options', 'wp_popup', array( $this, 'wp_banner_popup' ) );
			add_submenu_page( 'wp_banner', __( 'Documentation', 'wp-banner' ), __( 'Documentation', 'wp-banner' ), 'manage_options', 'wp_docs', array( $this, 'wp_banner_docs' ) );
			add_submenu_page( 'wp_banner', __( 'Upgrade to Premium', 'wp-banner' ), __( 'Upgrade to Premium', 'wp-banner' ), 'manage_options', 'wp_premium', array( $this, 'wp_banner_premium' ) );
		}

		/**
		 * Passing the header links
		 *
		 * @param string $active_tab Declare activate tab
		 * @param string $is_active Declare activate tab attribute
		 * @param string $is_next Declare next tab
		 */
		protected function is_active( $active_tab, $is_active, $is_next )
		{
			?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=wp_banner" class="nav-tab <?php if( $active_tab == 'wp_banner' ) { echo 'nav-tab-active'; } ?> "><?php _e( 'WP Banner', 'wp-banner' ); ?></a>
                <a href="?page=wp_cookies" class="nav-tab <?php if( $active_tab == 'wp_cookies' ) { echo 'nav-tab-active'; } ?> "><?php _e( 'Cookies', 'wp-banner' ); ?></a>
                <a href="?page=wp_maintenance" class="nav-tab <?php if( $active_tab == 'wp_maintenance' ) { echo 'nav-tab-active'; } ?> "><?php _e( 'Maintenance Mode', 'wp-banner' ); ?></a>
                <a href="?page=wp_popup" class="nav-tab <?php if( $active_tab == 'wp_popup' ) { echo 'nav-tab-active'; } ?> "><?php _e( 'Popup', 'wp-banner' ); ?></a>
                <a href="?page=wp_docs" class="nav-tab <?php if( $active_tab == 'wp_docs' ) { echo 'nav-tab-active'; } ?>"><?php _e( 'Documentation', 'wp-banner' ); ?></a>
                <a href="?page=wp_premium" class="nav-tab <?php if( $active_tab == 'wp_premium' ) { echo 'nav-tab-active'; } ?>"><?php _e( 'Upgrade to Premium', 'wp-banner' ); ?></a>
            </h2>
			<?php

			$active_tab = $is_active;

			if( isset( $_GET[ "tab" ] ) ) {

				if( $_GET[ "tab" ] == $is_active ) {
					$active_tab = $is_active;
				} else {
					$active_tab = $is_next;
				}
			}
		}

		public function wp_banner_cookies()
		{
			?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"></div>
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

				<?php $this->is_active( 'wp_cookies', 'wp_cookies', 'wp_maintenance' ); ?>

                <form action="options.php" method="post">

					<?php
					settings_fields( '' );
					do_settings_sections( '' );

					submit_button();
					?>

                </form>

            </div>
			<?php
		}

		public function wp_banner_maintenance()
		{
			?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"></div>
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

				<?php $this->is_active( 'wp_maintenance', 'wp_maintenance', 'wp_popup' ); ?>

                <form action="options.php" method="post">

					<?php
					settings_fields( '' );
					do_settings_sections( '' );

					submit_button();
					?>

                </form>

            </div>
			<?php
		}

		public function wp_banner_popup()
		{
			?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"></div>
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

				<?php $this->is_active( 'wp_popup', 'wp_popup', 'wp_docs' ); ?>

                <form action="options.php" method="post">

					<?php
					settings_fields( '' );
					do_settings_sections( '' );

					submit_button();
					?>

                </form>

            </div>
			<?php
		}

		public function wp_banner_docs()
		{
			?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"></div>
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

				<?php $this->is_active( 'wp_docs', 'wp_docs', 'wp_premium' ); ?>

                <form action="options.php" method="post">

					<?php
					settings_fields( '' );
					do_settings_sections( '' );

					submit_button();
					?>

                </form>

            </div>
			<?php
		}

		public function wp_banner_premium()
		{
			?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"></div>
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

				<?php $this->is_active( 'wp_premium', 'wp_premium', '' ); ?>

                <form action="options.php" method="post">

					<?php
					settings_fields( '' );
					do_settings_sections( '' );

					submit_button();
					?>

                </form>

            </div>
			<?php
		}


		/**
		 * Checking the condition and add a CSS styles
		 *
		 * @param string $option_name Name of the Setting Option
		 * @param string $option_args Arguments for the styling for the Settings Option
		 * @param string $option_style CSS style
		 *
		 * @return string
		 */
		public function set_css_class( $option_name, $option_args, $option_style )
		{
			if ( $option_name == $option_args ) {
				echo '<style>' . $option_style . '</style>';
			}
		}


	}

	new Wp_Banner_Settings_Api();
}