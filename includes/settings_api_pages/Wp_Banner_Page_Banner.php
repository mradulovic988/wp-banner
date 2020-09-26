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

//	    $options = get_option( 'wp_banner_settings_fields' );
//	    echo '<pre>', var_dump($options), '</pre>';
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
		    'wp_banner_id_debug_mode',
		    __( 'Debug Mode', 'wp-banner' ),
		    array( $this, 'wp_banner_field_debug_mode' ),
		    'wp_banner_settings_sections',
		    'wp_banner_id',
		    $this->wp_banner_class_templates
	    );

	    add_settings_field(
		    'wp_banner_id_close_btn',
		    __( 'Use Close button', 'wp-banner' ),
		    array( $this, 'wp_banner_field_close_btn' ),
		    'wp_banner_settings_sections',
		    'wp_banner_id',
		    $this->wp_banner_class_templates
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
		    'wp_banner_id_title_font_size',
		    __( 'Title Font size (px)', 'wp-banner' ),
		    array( $this, 'wp_banner_field_title_font_size'),
		    'wp_banner_settings_sections',
		    'wp_banner_id',
		    $this->wp_banner_class_templates
	    );

        add_settings_field(
		    'wp_banner_id_text_font_size',
		    __( 'Text Font size (px)', 'wp-banner' ),
		    array( $this, 'wp_banner_field_text_font_size'),
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

	/**
     * Sanitizing input field data where the input fields
     * should be a text
     *
	 * @param string $input Passed properties
	 * @return bool
	 */
    public function wp_banner_sanitize( $input, $arg )
    {
        if( is_admin() ) {
            if ( empty( $input) && ! preg_match( '/^\d{5}(\-?\d{4})?$<>/', $input ) ) {
                return false;
            }
            return $input[$arg];
        }
        return false;
    }

    // Banner description message
    public function wp_banner_setting_section()
    {
        _e( 'Here you can manage all of your styling for the banner itself, such as customization, choosing predefined templates, writing CSS and HTML, etc.', 'wp-banner' );
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
        $is_options_empty = $this->wp_banner_sanitize( $options, 'title');

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[title]" placeholder="' . __( 'Add banner title', 'wp-banner' ) . '" rows="3" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
    }

    // Banner HTML field
    public function wp_banner_field_html()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'html' ] ) ? $options[ 'html' ] : '' );
        $html_placeholder = "<div class='wrapper'>
        <h1>This is a title</h1>
        <p class='description'>This is a description</p>
</div>";

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[html]" placeholder="' . __( $html_placeholder, 'wp-banner' ) . '" rows="10" cols="100">' . esc_attr( $is_options_empty ) . '</textarea>';
    }

    // Banner title field
    public function wp_banner_field_css()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'css' ] ) ? $options[ 'css' ] : '' );
        $css_placeholder = '.class {
        color: #000;
        font-size: 16px;
}';

        echo '<textarea id="wp_banner_id_title" name="wp_banner_settings_fields[css]" placeholder="' . __( $css_placeholder, 'wp-banner' ) . '" rows="10" cols="100">' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '</textarea>';
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

        echo '<label for="wp_banner_position_bottom"><input type="radio" id="wp_banner_position_bottom" name="wp_banner_settings_fields[position]" value="Bottom"' . checked( 'Bottom', $is_options_empty, false ) . '"/>' . __( 'Bottom', 'wp-banner') . '</label><br>';
    }

    // Banner debug mode field
    public function wp_banner_field_debug_mode()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'debug_mode' ] ) ? $options[ 'debug_mode' ] : '' );

//        echo '<pre>', var_dump($options), '</pre>';

        echo '<label for="wp_banner_debug_mode_on"><input type="radio" id="wp_banner_debug_mode_on" name="wp_banner_settings_fields[debug_mode]" value="enable"' . checked( 'enable', $is_options_empty, false ) . '"/>' . __( 'Enable', 'wp-banner') . '<span class="wp_banner_small_alert">' . __( ' - While this option is enabled, cookies will not be set so you can test your banner. Don\'t forget to disable it.', 'wp-banner' ) . '</span></label><br>';

        echo '<label for="wp_banner_debug_mode_off"><input type="radio" id="wp_banner_debug_mode_off" name="wp_banner_settings_fields[debug_mode]" value="disable"' . checked( 'disable', $is_options_empty, false ) . '"/>' . __( 'Disable', 'wp-banner') . '</label><br>';
    }

	// Banner close button field
	public function wp_banner_field_close_btn()
	{
		$options = get_option( 'wp_banner_settings_fields' );
		$is_options_empty = ( ! empty( $options[ 'close_btn' ] ) ? $options[ 'close_btn' ] : '' );

		echo '<label for="wp_banner_close_btn_yes"><input type="radio" id="wp_banner_close_btn_yes" name="wp_banner_settings_fields[close_btn]" value="Yes"' . checked( 'Yes', $is_options_empty, false ) . '"/>' . __( 'Yes', 'wp-banner' ) . '<span class="wp_banner_small_alert">' . __( ' - We are using cookies for this option', 'wp-banner' ) . '</span></label><br>';

		echo '<label for="wp_banner_close_btn_no"><input type="radio" id="wp_banner_close_btn_no" name="wp_banner_settings_fields[close_btn]" value="No"' . checked( 'No', $is_options_empty, false ) . '"/>' . __( 'No', 'wp-banner') . '</label><br>';
	}

    // Excluding pages
    public function wp_banner_field_exclude()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'exclude' ] ) ? $options[ 'exclude' ] : '' );

        echo '<input type="text" id="wp_banner_id_exclude" name="wp_banner_settings_fields[exclude]" class="wp-banner-field-size" value="' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '" placeholder="home, contact, about-us">';
    }

	// Title font size
    public function wp_banner_field_title_font_size()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'title_font_size' ] ) ? $options[ 'title_font_size' ] : '' );

        echo '<input type="number" id="wp_banner_id_title_font_size" name="wp_banner_settings_fields[title_font_size]" class="wp-banner-field-size" value="' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '" placeholder="21px" min="12" max="60">';
    }

    // Text font size
    public function wp_banner_field_text_font_size()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'text_font_size' ] ) ? $options[ 'text_font_size' ] : '' );

        echo '<input type="number" id="wp_banner_id_text_font_size" name="wp_banner_settings_fields[text_font_size]" class="wp-banner-field-size" value="' . esc_attr( sanitize_text_field( $is_options_empty ) ) . '" placeholder="16px" min="12" max="60">';
    }

    public function wp_banner_field_templates()
    {
        $options = get_option( 'wp_banner_settings_fields' );
        $is_options_empty = ( ! empty( $options[ 'templates' ] ) ? $options[ 'templates' ] : '' );

        echo '<div class="wp_banner_template_wrapper">';
        echo '<div class="wp_banner_template_left">';

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

        echo '</div>';
	    echo '<div class="wp_banner_template_right">';

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
        echo '</div>';
	    echo '<br><img class="wp_banner_template_coming_soon" src="' . plugins_url( '../../admin/assets/img/more_templates.png', __FILE__ ) . '">';
    }

}

new Wp_Banner_Page_Banner();