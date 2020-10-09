<div class='wp_banner_popup'>
	<div class='wp_banner_popup_wrapper'>
		<span <?= $debug_mode_enable ?> class='wp_banner_popup_close'>&times;</span>
		<h1><?= $options[ 'title' ]; ?></h1>

        <?php if ( ! empty( $options[ 'text' ] ) && empty( $options[ 'url' ] ) ) { ?>
            <p><?= $options[ 'text' ] ?></p>
        <?php } else { ?>
            <a href="<?= $options[ 'url' ] ?>"><?= $options[ 'text' ] ?></a>
        <?php } ?>

	</div>
</div>