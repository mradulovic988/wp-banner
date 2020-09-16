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

		public function __construct()
		{
			add_action( 'admin_menu', array( $this, 'menu_page' ) );

			// Error notice for submiting results
			add_action( 'admin_notices', array( $this, 'show_error_notice' ) );

			add_action( 'admin_init', array( $this, 'wp_banner_main_register_settings' ) );
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


		public function wp_banner_main()
		{
			?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"></div>
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

				<?php $this->is_active( 'wp_banner', 'wp_banner', 'wp_cookies' ); ?>

                <form action="options.php" method="post">

					<?php
					settings_fields( 'wp_banner_settings_fields' );
					do_settings_sections( 'wp_banner_settings_sections' );

					submit_button();
					?>

                </form>

            </div>
			<?php
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

				<?php $this->is_active( 'wp_maintenance', 'wp_maintenance', 'wp_docs' ); ?>

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
		 * Method where we register settings, sections for the WP Banner page
		 */
		public function wp_banner_main_register_settings()
		{
			register_setting( 'wp_banner_settings_fields', 'wp_banner_settings_fields', 'wp_banner_sanitize' );
			add_settings_section( 'wp_banner_id', __( 'WP Banner Management', 'wp_banner' ), array( $this, 'wp_banner_setting_section'), 'wp_banner_settings_sections' );

			add_settings_field( 'wp_banner_id_turn_on', __( 'Enable/Disable banner', 'wp_banner' ), array( $this, 'wp_banner_field_turn_on' ), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_text', __( 'Banner Des', 'wp_banner' ), array( $this, 'wp_banner_field_text'), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_font_size', __( 'Font Size ( in px )', 'wp_banner' ), array( $this, 'wp_banner_field_font_size'), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_background_color', __( 'Background Color', 'wp_banner' ), array( $this, 'wp_banner_field_background_color'), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_font_color', __( 'Font Color', 'wp_banner' ), array( $this, 'wp_banner_field_font_color'), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_link_color', __( 'Link Color', 'wp_banner' ), array( $this, 'wp_banner_field_link_color'), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_position', __( 'Banner Position', 'wp_banner' ), array( $this, 'wp_banner_field_position'), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_exclude', __( 'Exclude Pages ( comma separated )', 'wp_banner' ), array( $this, 'wp_banner_field_exclude'), 'wp_banner_settings_sections', 'wp_banner_id' );
			add_settings_field( 'wp_banner_id_templates', __( 'Choose Banner Template', 'wp_banner' ), array( $this, 'wp_banner_field_templates'), 'wp_banner_settings_sections', 'wp_banner_id' );

		}

		public function wp_banner_sanitize()
		{
			//
		}

		// Banner description message
		public function wp_banner_setting_section()
		{
			_e( 'Here you can customize your banner for the front-end part of the website.', 'wp_banner' );
		}

		// Turned on or off
		public function wp_banner_field_turn_on()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'turn_on' ] ) ? $options[ 'turn_on' ] : '' );

			echo '<label class="wp-banner-switch" for="wp_banner_id_turn_on">';
			echo '<input type="checkbox" id="wp_banner_id_turn_on" class="wp-banner-switch-input wp-banner-field-size" name="wp_banner_settings_fields[turn_on]" value="1"' . checked( 1, $is_options_empty, false ) . '/>';
			echo '<span class="wp-banner-slider wp-banner-round"></span>';
			echo '</label>';
		}

		// Banner text field
		public function wp_banner_field_text()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'text' ] ) ? $options[ 'text' ] : '' );

			echo '<textarea id="wp_banner_id_text" name="wp_banner_settings_fields[text]" placeholder="' . __( 'My cool description for the banner', 'wp_banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
		}

		// Banner font size field
		public function wp_banner_field_font_size()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'font_size' ] ) ? $options[ 'font_size' ] : '' );

			echo '<input type="number" id="wp_banner_id_font_size" class="wp-banner-field-size" name="wp_banner_settings_fields[font_size]" min="6" max="60" placeholder="12px" value="' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '"/>';
		}

		// Banner background color field
		public function wp_banner_field_background_color()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'background_color' ] ) ? $options[ 'background_color' ] : '' );

			echo '<input type="color" id="wp_banner_id_background_color" class="wp-banner-field-size" name="wp_banner_settings_fields[background_color]" value="' . esc_attr( $is_options_empty ) . '"/>';
		}

		// Banner font color field
		public function wp_banner_field_font_color()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'font_color' ] ) ? $options[ 'font_color' ] : '' );

			echo '<input type="color" id="wp_banner_id_font_color" class="wp-banner-field-size" name="wp_banner_settings_fields[font_color]" value="' . esc_attr( $is_options_empty ) . '"/>';
		}

		// Banner link color field
		public function wp_banner_field_link_color()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'link_color' ] ) ? $options[ 'link_color' ] : '' );

			echo '<input type="color" id="wp_banner_id_link_color" class="wp-banner-field-size" name="wp_banner_settings_fields[link_color]" value="' . esc_attr( $is_options_empty ) . '"/>';
		}

		// Banner position field
		public function wp_banner_field_position()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'position' ] ) ? $options[ 'position' ] : '' );

			echo '<label for="wp_banner_position_top"><input type="radio" id="wp_banner_position_top" name="wp_banner_settings_fields[position]" value="Top"' . checked( 'Top', $is_options_empty, false ) . '"/>' . __( 'Top', 'wp_banner') . '</label><br>';
			echo '<label for="wp_banner_position_center"><input type="radio" id="wp_banner_position_center" name="wp_banner_settings_fields[position]" value="Center"' . checked( 'Center', $is_options_empty, false ) . '"/>' . __( 'Center', 'wp_banner') . '</label><br>';
			echo '<label for="wp_banner_position_bottom"><input type="radio" id="wp_banner_position_bottom" name="wp_banner_settings_fields[position]" value="Bottom"' . checked( 'Bottom', $is_options_empty, false ) . '"/>' . __( 'Bottom', 'wp_banner') . '</label><br>';
			echo '<label for="wp_banner_position_popup"><input type="radio" id="wp_banner_position_popup" name="wp_banner_settings_fields[position]" value="Popup"' . checked( 'Popup', $is_options_empty, false ) . '"/>' . __( 'Popup', 'wp_banner') . '</label><br>';
			echo '<label for="wp_banner_position_fixed"><input type="radio" id="wp_banner_position_fixed" name="wp_banner_settings_fields[position]" value="Fixed"' . checked( 'Fixed', $is_options_empty, false ) . '"/>' . __( 'Fixed', 'wp_banner') . '</label><br>';
			echo '<label for="wp_banner_position_sticky"><input type="radio" id="wp_banner_position_sticky" name="wp_banner_settings_fields[position]" value="Sticky"' . checked( 'Sticky', $is_options_empty, false ) . '"/>' . __( 'Sticky', 'wp_banner') . '</label><br>';
		}

		// Listing all of the pages -> Think about the edit slug comma separated
		public function wp_banner_field_exclude()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'exclude' ] ) ? $options[ 'exclude' ] : '' );

			echo '<input type="text" id="wp_banner_id_exclude" name="wp_banner_settings_fields[exclude]" class="wp-banner-field-size" value="' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '" placeholder="page-five, page-six">';
		}

		public function wp_banner_field_templates()
		{
			$options = get_option( 'wp_banner_settings_fields' );
			$is_options_empty = ( ! empty( $options[ 'templates' ] ) ? $options[ 'templates' ] : '' );

			echo '<label class="wp_banner_template_label" for="first_template"><input class="wp_banner_template_input" type="radio" id="first_template" name="wp_banner_settings_fields[templates]" value="First"' . checked( 'First', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/1.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="second_template"><input class="wp_banner_template_input" type="radio" id="second_template" name="wp_banner_settings_fields[templates]" value="Second"' . checked( 'Second', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/2.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="third_template"><input class="wp_banner_template_input" type="radio" id="third_template" name="wp_banner_settings_fields[templates]" value="Third"' . checked( 'Third', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/3.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="four_template"><input class="wp_banner_template_input" type="radio" id="four_template" name="wp_banner_settings_fields[templates]" value="Four"' . checked( 'Four', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/4.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="five_template"><input class="wp_banner_template_input" type="radio" id="five_template" name="wp_banner_settings_fields[templates]" value="Five"' . checked( 'Five', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/5.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="six_template"><input class="wp_banner_template_input" type="radio" id="six_template" name="wp_banner_settings_fields[templates]" value="Six"' . checked( 'Six', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/6.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="seven_template"><input class="wp_banner_template_input" type="radio" id="seven_template" name="wp_banner_settings_fields[templates]" value="Seven"' . checked( 'Seven', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/7.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="eight_template"><input class="wp_banner_template_input" type="radio" id="eight_template" name="wp_banner_settings_fields[templates]" value="Eight"' . checked( 'Eight', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/8.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="nine_template"><input class="wp_banner_template_input" type="radio" id="nine_template" name="wp_banner_settings_fields[templates]" value="Nine"' . checked( 'Nine', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/9.png', __FILE__ ) . '"></label><br>';

			echo '<label class="wp_banner_template_label" for="ten_template"><input class="wp_banner_template_input" type="radio" id="ten_template" name="wp_banner_settings_fields[templates]" value="Ten"' . checked( 'Ten', $is_options_empty, false ) . '"/><br>';
			echo '<img class="wp_banner_template_img" src="' . plugins_url( '../../admin/assets/img/10.png', __FILE__ ) . '"></label><br>';
		}

	}

	new Wp_Banner_Settings_Api();
}