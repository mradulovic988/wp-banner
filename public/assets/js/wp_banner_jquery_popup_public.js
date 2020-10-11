jQuery(document).ready(function($) {
    let overlay = $('<div id="wp_banner_popup_overlay"></div>');
    overlay.show();
    overlay.appendTo(document.body);
    $('.wp_banner_popup').show();
    $('.wp_banner_popup_close').click(function () {
        $('.wp_banner_popup').hide();
        overlay.appendTo(document.body).remove();
        return false;
    });
});