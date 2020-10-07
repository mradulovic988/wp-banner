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

// Predefined templates
if( $options[ 'style' ] == 'predefined' && ! is_page( $options_exclude_pages ) && ! isset( $_COOKIE[ 'wp_banner_closed_template' ] ) && $options_position == 'top' || $options_position == 'bottom' ) { ?>

	<div <?= $style_text = ( ! empty( $options[ 'background_color' ] ) ) ? 'style="background-color:' . $options[ 'background_color' ] . '"' : '' ?> class="wp_banner_wrapper_<?= $options_position ?> wp_banner_<?= $options_templates ?>">

		<div class="wp_banner_wrapper_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>">

            <?= $is_the_btn_clicked ?>
            <?php if ( ! empty( $options[ 'title' ] ) ) { ?>
			    <p <?= $style_title = ( ! empty( $options[ 'title_font_size' ] ) || ! empty( $options[ 'font_color' ] ) ) ? 'style="font-size:' . $options[ 'title_font_size' ] . 'px; color: ' . $options[ 'font_color' ] . '"' : '' ?> class="wp_banner_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'title' ]; ?></p>
            <?php } ?>
		</div>
		<div class="wp_banner_wrapper_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
	        <?php if ( ! empty( $options[ 'text' ] ) ) { ?>
                <?php if ( empty( $options[ 'url' ] ) ) { ?>
                    <p <?= $style_text = ( ! empty( $options[ 'text_font_size' ] ) || ! empty( $options[ 'font_color' ] ) ) ? 'style="font-size:' . $options[ 'text_font_size' ] . 'px; color: ' . $options[ 'font_color' ] . '"' : '' ?> class="wp_banner_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'text' ] ?></p>
                <?php } else { ?>
                    <a href="<?= $options[ 'url' ] ?>" <?= $style_text = ( ! empty( $options[ 'text_font_size' ] ) || ! empty( $options[ 'font_color' ] ) ) ? 'style="font-size:' . $options[ 'text_font_size' ] . 'px; color: ' . $options[ 'font_color' ] . '"' : '' ?> class="wp_banner_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'text' ] ?></a>
                <?php } ?>
            <?php } ?>

		</div>
	</div>

<?php } else if( $options[ 'style' ] == 'predefined' && ! is_page( $options_exclude_pages ) && ! isset( $_COOKIE[ 'wp_banner_closed_template' ] ) && $options_position == 'popup' ) {
    // popup
    ?>
    <div class='wp_banner_popup'>
        <div class='wp_banner_popup_wrapper'>
            <h1>Important Notice</h1>
            <p>We were affected by the fire next door and will remain closed until further notice.
                <a href='#' class='wp_banner_popup_close'>Close</a>
            </p>
        </div>
    </div>
    <?php
}