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
$options_exclude_pages = explode( ', ', $options['exclude'] );

if( $options['style'] == 'predefined' && ! is_page( $options_exclude_pages ) ) { ?>

	<div class="wp_banner_wrapper_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
		<div class="wp_banner_wrapper_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
			<p class="wp_banner_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'title' ]; ?></p>
		</div>
		<div class="wp_banner_wrapper_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>">
			<p class="wp_banner_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options[ 'text' ] ?></p>
		</div>
	</div>

<?php }
