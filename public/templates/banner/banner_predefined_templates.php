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
    <div class='popup'>
        <div class='cnt223'>
            <h1>Important Notice</h1>
            <p>
                We were affected by the fire next door and will remain closed until further notice.
                <br/>
                <br/>
                <a href='' class='close'>Close</a>
            </p>
        </div>
    </div>

    <style>
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            filter:alpha(opacity=70);
            -moz-opacity:0.7;
            -khtml-opacity: 0.7;
            opacity: 0.7;
            z-index: 100;
            display: none;
        }
        .cnt223 a{
            text-decoration: none;
        }
        .popup{
            width: 100%;
            margin: 0 auto;
            display: none;
            position: fixed;
            z-index: 101;
        }
        .cnt223{
            min-width: 600px;
            width: 600px;
            min-height: 150px;
            margin: 100px auto;
            background: #f3f3f3;
            position: relative;
            z-index: 103;
            padding: 15px 35px;
            border-radius: 5px;
            box-shadow: 0 2px 5px #000;
        }
        .cnt223 p{
            clear: both;
            color: #555555;
            /* text-align: justify; */
            font-size: 20px;
            font-family: sans-serif;
        }
        .cnt223 p a{
            color: #d91900;
            font-weight: bold;
        }
        .cnt223 .x{
            float: right;
            height: 35px;
            left: 22px;
            position: relative;
            top: -25px;
            width: 34px;
        }
        .cnt223 .x:hover{
            cursor: pointer;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            var overlay = $('<div id="overlay"></div>');
            overlay.show();
            overlay.appendTo(document.body);
            $('.popup').show();
            $('.close').click(function () {
                $('.popup').hide();
                overlay.appendTo(document.body).remove();
                return false;
            });
        });
    </script>
<?php
}