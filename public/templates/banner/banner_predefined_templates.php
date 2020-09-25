<?php
/**
 * Template for the banner on the front-end side
 *
 * @version 1.0.0
 * @author Marko Radulovic
 */

$options = get_option( 'wp_banner_settings_fields' );

$options_position = strtolower( $options[ 'position' ] );
$options_templates = strtolower( $options[ 'templates' ] );
$options_close_btn = strtolower( $options[ 'close_btn' ] );
$options_exclude_pages = explode( ', ', $options['exclude'] );

$is_the_btn_clicked = ( $options_close_btn == 'yes' ) ? '<span onclick="setCookie()" id="wp_banner_close_btn_wrapper" class="wp_banner_close_btn_' . $options_position . ' wp_banner_close_template_' . $options_templates . '">&times;</span>' : '';

if( $options['style'] == 'predefined' && ! is_page( $options_exclude_pages ) && ! isset( $_COOKIE[ 'wp_banner_closed_template' ] ) ) { ?>

	<div class="wp_banner_wrapper_<?= $options_position ?> wp_banner_<?= $options_templates ?>">

		<div class="wp_banner_wrapper_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
			<?= $is_the_btn_clicked ?>
			<p class="wp_banner_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'title' ]; ?></p>
		</div>
		<div class="wp_banner_wrapper_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
			<p class="wp_banner_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'text' ] ?></p>
		</div>
	</div>

<?php }
