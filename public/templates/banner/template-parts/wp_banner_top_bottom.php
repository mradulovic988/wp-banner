<div <?= $style_text = ( ! empty( $options['background_color'] ) ) ? 'style="background-color:' . $options['background_color'] . '"' : '' ?>
    class="wp_banner_wrapper_<?= $options_position ?> wp_banner_<?= $options_templates ?>">

    <div class="wp_banner_wrapper_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>">

		<?= $is_the_btn_clicked ?>
		<?php if ( ! empty( $options['title'] ) ) { ?>
            <p <?= $style_title = ( ! empty( $options['title_font_size'] ) || ! empty( $options['font_color'] ) ) ? 'style="font-size:' . $options['title_font_size'] . 'px; color: ' . $options['font_color'] . '"' : '' ?>
                class="wp_banner_title_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options['title']; ?></p>
		<?php } ?>
    </div>
    <div class="wp_banner_wrapper_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>">

	    <?php if ( ! empty( $options[ 'text' ] ) && empty( $options[ 'url' ] ) ) { ?>
            <p <?= $style_text = ( ! empty( $options['text_font_size'] ) || ! empty( $options['font_color'] ) ) ? 'style="font-size:' . $options['text_font_size'] . 'px; color: ' . $options['font_color'] . '"' : '' ?>
                class="wp_banner_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options['text'] ?></p>
        <?php } else { ?>
            <a href="<?= $options['url'] ?>" <?= $style_text = ( ! empty( $options['text_font_size'] ) || ! empty( $options['font_color'] ) ) ? 'style="font-size:' . $options['text_font_size'] . 'px; color: ' . $options['font_color'] . '"' : '' ?>
               class="wp_banner_desc_<?= $options_position ?> wp_banner_<?= $options_templates ?>"><?= $options['text'] ?></a>
        <?php } ?>

    </div>
</div>