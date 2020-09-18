<?php
/**
 * Extended Wp_Banner_Page_Banner class
 * which trigger all major settings for the
 * Banner page itself
 *
 * @class Wp_Banner_Page_Banner
 * @package Wp_Banner_Page_Banner
 * @version 1.0.0
 * @author Marko Radulovic
 */

class Wp_Banner_Page_Banner extends Wp_Banner_Settings_Api {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'menu_page' ) );
        add_action( 'admin_init', array( $this, 'wp_banner_main_register_settings' ) );
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

    /**
     * Method where we register settings, sections for the WP Banner page
     */
    public function wp_banner_main_register_settings()
    {
        register_setting( 'wp_banner_settings_fields', 'wp_banner_settings_fields', 'wp_banner_sanitize' );
        add_settings_section( 'wp_banner_id', __( 'WP Banner Management', 'wp_banner' ), array( $this, 'wp_banner_setting_section'), 'wp_banner_settings_sections' );

        $wp_banner_class_managing = array( 'class' => 'wp_banner_class_managing' );
        $wp_banner_class_customization = array( 'class' => 'wp_banner_class_customization' );
        $wp_banner_class_templates = array( 'class' => 'wp_banner_class_templates' );

        add_settings_field( 'wp_banner_id_turn_on', __( 'Enable/Disable banner', 'wp-banner' ), array( $this, 'wp_banner_field_turn_on' ), 'wp_banner_settings_sections', 'wp_banner_id' );
        add_settings_field( 'wp_banner_id_style', __( 'Choose your styling', 'wp-banner' ), array( $this, 'wp_banner_field_style' ), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_managing );
        add_settings_field( 'wp_banner_id_exclude', __( 'Exclude Pages ( comma separated )', 'wp-banner' ), array( $this, 'wp_banner_field_exclude'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_managing );
        add_settings_field( 'wp_banner_id_position', __( 'Banner Position', 'wp-banner' ), array( $this, 'wp_banner_field_position'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_managing );
        add_settings_field( 'wp_banner_id_html', __( 'Banner HTML', 'wp-banner' ), array( $this, 'wp_banner_field_html'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_customization );
        add_settings_field( 'wp_banner_id_css', __( 'Banner CSS', 'wp-banner' ), array( $this, 'wp_banner_field_css'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_customization );
        add_settings_field( 'wp_banner_id_font_size', __( 'Font Size ( in px )', 'wp-banner' ), array( $this, 'wp_banner_field_font_size'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_customization );
        add_settings_field( 'wp_banner_id_background_color', __( 'Background Color', 'wp-banner' ), array( $this, 'wp_banner_field_background_color'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_customization );
        add_settings_field( 'wp_banner_id_font_color', __( 'Font Color', 'wp-banner' ), array( $this, 'wp_banner_field_font_color'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_customization );
        add_settings_field( 'wp_banner_id_link_color', __( 'Link Color', 'wp-banner' ), array( $this, 'wp_banner_field_link_color'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_customization );
        add_settings_field( 'wp_banner_id_title', __( 'Banner Title', 'wp-banner' ), array( $this, 'wp_banner_field_title'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_templates );
        add_settings_field( 'wp_banner_id_text', __( 'Banner Text', 'wp-banner' ), array( $this, 'wp_banner_field_text'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_templates );
        add_settings_field( 'wp_banner_id_templates', __( 'Choose Banner Template', 'wp-banner' ), array( $this, 'wp_banner_field_templates'), 'wp_banner_settings_sections', 'wp_banner_id', $wp_banner_class_templates );
    }

    public function wp_banner_sanitize()
    {
        // do the sanitization
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

        if ( ! $is_options_empty == 1 ) { ?>
            <style>
                tr.wp_banner_class_managing, tr.wp_banner_class_customization, tr.wp_banner_class_templates { display: none; }
            </style>
        <?php }

        echo '<label class="wp-banner-switch" for="wp_banner_id_turn_on">';
        echo '<input type="checkbox" id="wp_banner_id_turn_on" class="wp-banner-switch-input wp-banner-field-size" name="wp_banner_settings_fields[turn_on]" value="1" ' . checked( 1, $is_options_empty, false ) . '/>';
        echo '<span class="wp-banner-slider wp-banner-round"></span>';
        echo '</label>';
    }

    // Turned on or off
    public function wp_banner_field_style()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'style' ] ) ? $options[ 'style' ] : '' );

        if ( $is_options_empty == "none" ) { ?>
            <style>
                tr.wp_banner_class_customization, tr.wp_banner_class_templates { display: none; }
            </style>
        <?php } elseif ( $is_options_empty == "customize" ) { ?>
            <style>
                tr.wp_banner_class_templates { display: none; }
            </style>
        <?php } elseif ( $is_options_empty == "predefined" ) { ?>
            <style>
                tr.wp_banner_class_customization { display: none; }
            </style>
        <?php }

        echo '<label for="none"><input type="radio" id="none" name="wp_banner_settings_fields[style]" value="none"' . checked( 'none', $is_options_empty, false ) . '" checked/>' . __( 'None', 'wp-banner' ) . '</label><br>';

        echo '<label for="customization"><input type="radio" id="customization" name="wp_banner_settings_fields[style]" value="customize"' . checked( 'customize', $is_options_empty, false ) . '"/>' . __( 'Customize on your own', 'wp-banner' ) . '</label><br>';

        echo '<label for="predefined"><input type="radio" id="predefined" name="wp_banner_settings_fields[style]" value="predefined"' . checked( 'predefined', $is_options_empty, false ) . '"/>' . __( 'Predefined templates', 'wp-banner' ) . '</label><br>';
    }

    // Banner title field
    public function wp_banner_field_title()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'title' ] ) ? $options[ 'title' ] : '' );

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[title]" placeholder="' . __( 'Add banner title', 'wp_banner' ) . '" rows="3" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner HTML field
    public function wp_banner_field_html()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'html' ] ) ? $options[ 'html' ] : '' );

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[html]" placeholder="' . __( '<p class=\'class\'>This is a paragraph</p>', 'wp_banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner title field
    public function wp_banner_field_css()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'css' ] ) ? $options[ 'css' ] : '' );

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[css]" placeholder="' . __( '.class { color: #000; }', 'wp_banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner text field
    public function wp_banner_field_text()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'text' ] ) ? $options[ 'text' ] : '' );

        echo '<textarea id="wp_banner_id_text" name="wp_banner_settings_fields[text]" placeholder="' . __( 'Add banner description', 'wp_banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
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

    // Listing all of the pages -> Think about the edit slug comma separated
    public function wp_banner_field_test()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'test' ] ) ? $options[ 'test' ] : '' );

        echo '<input type="text" id="wp_banner_id_test" name="wp_banner_settings_fields[test]" class="wp-banner-field-size" value="' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '">';
    }

    public function wp_banner_field_templates()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'templates' ] ) ? $options[ 'templates' ] : '' );

        echo '<div class="wp_banner_template_wrapper">';

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

        echo '</div>';
    }

}

new Wp_Banner_Page_Banner();