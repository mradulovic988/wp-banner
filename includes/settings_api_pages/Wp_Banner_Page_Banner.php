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

	/**
     * Used argument for add_settings_field to conditionally add a CSS class
     *
	 * @var string[] $wp_banner_class_managing Adding a CSS class for manage part on the page
     * @var string[] $wp_banner_class_customization Adding a CSS class for customization part on the page
     * @var string[] $wp_banner_class_templates Adding a CSS class for templates part on the page
	 */
    protected $wp_banner_class_managing = array( 'class' => 'wp_banner_class_managing' );
    protected $wp_banner_class_customization = array( 'class' => 'wp_banner_class_customization' );
    protected $wp_banner_class_templates = array( 'class' => 'wp_banner_class_templates' );

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
        register_setting(
            'wp_banner_settings_fields',
            'wp_banner_settings_fields',
            'wp_banner_sanitize'
        );

        add_settings_section(
            'wp_banner_id',
            __( 'WP Banner Management', '' ),
            array( $this, 'wp_banner_setting_section'),
            'wp_banner_settings_sections'
        );

        add_settings_field(
            'wp_banner_id_style',
            __( 'Choose your styling', 'wp-banner' ),
            array( $this, 'wp_banner_field_style' ),
            'wp_banner_settings_sections',
            'wp_banner_id'
        );

        add_settings_field(
            'wp_banner_id_position',
            __( 'Banner Position', 'wp-banner' ),
            array( $this, 'wp_banner_field_position'),
            'wp_banner_settings_sections',
            'wp_banner_id',
            $this->wp_banner_class_managing
        );

	    add_settings_field(
		    'wp_banner_id_exclude',
		    __( 'Exclude Pages', 'wp-banner' ) . '<span class="wp_banner_small_alert">' . __( ' - comma separated', 'wp-banner' ) . '</span>',
		    array( $this, 'wp_banner_field_exclude'),
		    'wp_banner_settings_sections',
		    'wp_banner_id',
		    $this->wp_banner_class_managing
	    );

        add_settings_field(
            'wp_banner_id_html',
            __( 'Banner HTML', 'wp-banner' ),
            array( $this, 'wp_banner_field_html'),
            'wp_banner_settings_sections',
            'wp_banner_id',
            $this->wp_banner_class_customization
        );

        add_settings_field(
            'wp_banner_id_css',
            __( 'Banner CSS', 'wp-banner' ),
            array( $this, 'wp_banner_field_css'),
            'wp_banner_settings_sections',
            'wp_banner_id',
            $this->wp_banner_class_customization
        );

        add_settings_field(
            'wp_banner_id_title',
            __( 'Banner Title', 'wp-banner' ),
            array( $this, 'wp_banner_field_title'),
            'wp_banner_settings_sections',
            'wp_banner_id',
            $this->wp_banner_class_templates
        );

        add_settings_field(
            'wp_banner_id_text',
            __( 'Banner Text', 'wp-banner' ),
            array( $this, 'wp_banner_field_text'),
            'wp_banner_settings_sections',
            'wp_banner_id',
            $this->wp_banner_class_templates
        );

        add_settings_field(
            'wp_banner_id_templates',
            __( 'Choose Banner Template', 'wp-banner' ),
            array( $this, 'wp_banner_field_templates'),
            'wp_banner_settings_sections',
            'wp_banner_id',
            $this->wp_banner_class_templates
        );
    }

    public function wp_banner_sanitize( $input )
    {
        // do the sanitization
    }

    // Banner description message
    public function wp_banner_setting_section()
    {
        _e( 'Here you can customize your banner for the front-end part of the website.', 'wp-banner' );
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
    protected function set_css_class( $option_name, $option_args, $option_style )
    {
        if ( $option_name == $option_args ) {
            echo '<style>' . $option_style . '</style>';
        }
    }

    // Turned on or off
    public function wp_banner_field_style()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'style' ] ) ? $options[ 'style' ] : '' );

	    /**
	     * Adding conditional CSS styling
         *
         * @method protected string set_css_class()
	     */
        $this->set_css_class(
            $is_options_empty,
            'none',
            'tr.wp_banner_class_managing, tr.wp_banner_class_customization, tr.wp_banner_class_templates { display: none; }'
        );

        $this->set_css_class(
            $is_options_empty,
            'customize',
            'tr.wp_banner_class_templates { display: none; }'
        );

        $this->set_css_class(
            $is_options_empty,
            'predefined',
            'tr.wp_banner_class_customization { display: none; }'
        );


        echo '<label for="none"><input type="radio" id="none" name="wp_banner_settings_fields[style]" value="none"' . checked( 'none', $is_options_empty, false ) . '" checked/>' . __( 'Turn off', 'wp-banner' ) . ' <span class="wp_banner_small_alert">' . __( '- Your previously settings will stay saved, but not activated', 'wp-banner' ) . '</span></label><br>';

        echo '<label for="customization"><input type="radio" id="customization" name="wp_banner_settings_fields[style]" value="customize"' . checked( 'customize', $is_options_empty, false ) . '"/>' . __( 'Customize WP Banner', 'wp-banner' ) . '</label><br>';

        echo '<label for="predefined"><input type="radio" id="predefined" name="wp_banner_settings_fields[style]" value="predefined"' . checked( 'predefined', $is_options_empty, false ) . '"/>' . __( 'Use our predefined templates', 'wp-banner' ) . '</label><br>';
    }

    // Banner title field
    public function wp_banner_field_title()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'title' ] ) ? $options[ 'title' ] : '' );

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[title]" placeholder="' . __( 'Add banner title', 'wp-banner' ) . '" rows="3" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner HTML field
    public function wp_banner_field_html()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'html' ] ) ? $options[ 'html' ] : '' );

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[html]" placeholder="' . __( '<p class=\'class\'>This is a paragraph</p>', 'wp-banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner title field
    public function wp_banner_field_css()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'css' ] ) ? $options[ 'css' ] : '' );

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[css]" placeholder="' . __( '.class { color: #000; }', 'wp-banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner text field
    public function wp_banner_field_text()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'text' ] ) ? $options[ 'text' ] : '' );

        echo '<textarea id="wp_banner_id_text" name="wp_banner_settings_fields[text]" placeholder="' . __( 'Add banner description', 'wp-banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner position field
    public function wp_banner_field_position()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'position' ] ) ? $options[ 'position' ] : '' );

        echo '<label for="wp_banner_position_top"><input type="radio" id="wp_banner_position_top" name="wp_banner_settings_fields[position]" value="Top"' . checked( 'Top', $is_options_empty, false ) . '"/>' . __( 'Top', 'wp-banner') . '</label><br>';

        echo '<label for="wp_banner_position_center"><input type="radio" id="wp_banner_position_center" name="wp_banner_settings_fields[position]" value="Center"' . checked( 'Center', $is_options_empty, false ) . '"/>' . __( 'Center', 'wp-banner') . '</label><br>';

        echo '<label for="wp_banner_position_bottom"><input type="radio" id="wp_banner_position_bottom" name="wp_banner_settings_fields[position]" value="Bottom"' . checked( 'Bottom', $is_options_empty, false ) . '"/>' . __( 'Bottom', 'wp-banner') . '</label><br>';

        echo '<label for="wp_banner_position_popup"><input type="radio" id="wp_banner_position_popup" name="wp_banner_settings_fields[position]" value="Popup"' . checked( 'Popup', $is_options_empty, false ) . '"/>' . __( 'Popup', 'wp-banner') . '</label><br>';

        echo '<label for="wp_banner_position_fixed"><input type="radio" id="wp_banner_position_fixed" name="wp_banner_settings_fields[position]" value="Fixed"' . checked( 'Fixed', $is_options_empty, false ) . '"/>' . __( 'Fixed', 'wp-banner') . '</label><br>';

        echo '<label for="wp_banner_position_sticky"><input type="radio" id="wp_banner_position_sticky" name="wp_banner_settings_fields[position]" value="Sticky"' . checked( 'Sticky', $is_options_empty, false ) . '"/>' . __( 'Sticky', 'wp-banner') . '</label><br>';
    }

    // Listing all of the pages -> Think about the edit slug comma separated
    public function wp_banner_field_exclude()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'exclude' ] ) ? $options[ 'exclude' ] : '' );

        echo '<input type="text" id="wp_banner_id_exclude" name="wp_banner_settings_fields[exclude]" class="wp-banner-field-size" value="' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '" placeholder="home, contact, about-us">';
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