<div class='wp_banner_popup'>
	<div class='wp_banner_popup_wrapper'>
		<span <?= $debug_mode_enable ?> class='wp_banner_popup_close'>&times;</span>

        <div class="wp_banner_popup_inside_wrapper">
            <div class="wp_banner_popup_left_side_img">
                <img class="wp_banner_template_img" width="50%" src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-1.2.1&w=1000&q=80">
            </div>

            <h1><?= $options[ 'title' ]; ?></h1>

	        <?php if ( ! empty( $options[ 'text' ] ) && empty( $options[ 'url' ] ) ) { ?>
                <p><?= $options[ 'text' ] ?></p>
	        <?php } else { ?>
                <a href="<?= $options[ 'url' ] ?>"><?= $options[ 'text' ] ?></a>
	        <?php } ?>
        </div>
	</div>
</div>