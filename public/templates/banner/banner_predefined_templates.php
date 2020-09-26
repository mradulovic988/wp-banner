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
$debug_mode             = strtolower( $options[ 'debug_mode' ] );
$debug_mode_enable      = ( $debug_mode == 'enable' ) ? '' : 'onclick="setCookie()"';
$options_exclude_pages  = explode( ', ', $options[ 'exclude' ] );
$is_the_btn_clicked     = ( $options_close_btn == 'yes' ) ? '<span ' . $debug_mode_enable . ' id="wp_banner_close_btn_wrapper" class="wp_banner_close_btn_' . $options_position . ' wp_banner_close_template_' . $options_templates . '">&times;</span>' : '';

if ( $options[ 'debug_mode' ] == 'enable' ) unset( $_COOKIE['wp_banner_closed_template'] );

// Predefined templates
if( $options[ 'style' ] == 'predefined' && ! is_page( $options_exclude_pages ) && ! isset( $_COOKIE[ 'wp_banner_closed_template' ] ) ) { ?>

	<div class="wp_banner_wrapper_<?= $options_position ?> wp_banner_<?= $options_templates ?>">

		<div class="wp_banner_wrapper_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
			<?= $is_the_btn_clicked ?>
			<p <?= $style_title = ( ! empty( $options[ 'title_font_size' ] ) ) ? 'style="font-size:' . $options[ 'title_font_size' ] . 'px"' : '' ?> class="wp_banner_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'title' ]; ?></p>
		</div>
		<div class="wp_banner_wrapper_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
			<p <?= $style_text = ( ! empty( $options[ 'text_font_size' ] ) ) ? 'style="font-size:' . $options[ 'text_font_size' ] . 'px"' : '' ?> class="wp_banner_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'text' ] ?></p>
		</div>
	</div>

<?php

// Customized templates
} elseif ( $options[ 'style' ] == 'customize' && ! is_page( $options_exclude_pages ) ) {

    if ( strtolower( $options[ 'position' ] ) == 'top' ) {

	    add_action( 'wp_head', function () use ( $options ) {
		    echo $html = ( ! empty( $options['html'] ) ) ? $options['html'] : '';
	    }, 999 );

	    add_action( 'wp_head', function () use ( $options ) {
		    echo $css = ( ! empty( $options['css'] ) ) ? '<style>' . $options['css'] . '</style>' : '';
	    }, 999 );
    } else {

	    add_action( 'wp_footer', function () use ( $options ) {
		    echo $html = ( ! empty( $options['html'] ) ) ? $options['html'] : '';
	    }, 999 );

	    add_action( 'wp_footer', function () use ( $options ) {
		    echo $css = ( ! empty( $options['css'] ) ) ? '<style>' . $options['css'] . '</style>' : '';
	    }, 999 );
    }
}
