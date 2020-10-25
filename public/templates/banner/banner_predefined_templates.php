<?php
/**
 * Template for the banner on the front-end side
 *
 * @version 1.0.0
 * @author Marko Radulovic
 */

$options = get_option( 'wp_banner_settings_fields' );

// Conditional
$options_position       = strtolower( $options[ 'position' ] );
$options_templates      = strtolower( $options[ 'templates' ] );
$options_close_btn      = strtolower( $options[ 'close_btn' ] );
$options_url            = strtolower( $options[ 'url' ] );
$debug_mode             = strtolower( $options[ 'debug_mode' ] );
$debug_mode_enable      = ( $debug_mode == 'enable' ) ? '' : 'onclick="setCookie()"';
$options_exclude_pages  = explode( ', ', $options[ 'exclude' ] );
$is_the_btn_clicked     = ( $options_close_btn == 'yes' ) ? '<span ' . $debug_mode_enable . ' id="wp_banner_close_btn_wrapper" class="wp_banner_close_btn_' . $options_position . ' wp_banner_close_template_' . $options_templates . '">&times;</span>' : '';

if ( $options[ 'debug_mode' ] == 'enable' ) unset( $_COOKIE['wp_banner_closed_template'] );

if ( isset( $_COOKIE['wp_banner_closed_template'] ) ) { ?>
    <style>div#wp_banner_popup_overlay{display:none!important;}</style>
<?php }

if( $options[ 'style' ] == 'predefined' && ! is_page( $options_exclude_pages ) && ! isset( $_COOKIE[ 'wp_banner_closed_template' ] ) ) {
    if( $options_position == 'top' || $options_position == 'bottom' || $options_position == 'sticky') {

	    // Top and bottom position
	    include WP_BANNER_PLUGIN_PATH . '/public/templates/banner/template-parts/wp_banner_top_bottom.php';
    }
} else if( $options[ 'style' ] == 'predefined'
    && ! is_page( $options_exclude_pages )
    && ! isset( $_COOKIE[ 'wp_banner_closed_template' ] )
    && $options_position == 'popup' ) {

    // Popup position
    include WP_BANNER_PLUGIN_PATH . '/public/templates/banner/template-parts/wp_banner_popup.php';
}