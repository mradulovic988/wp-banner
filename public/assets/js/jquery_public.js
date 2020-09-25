jQuery(document).ready(function($) {

    // Hide popup element on click close button
    $("span#wp_banner_close_btn_wrapper").click(function() {
        $(".wp_banner_wrapper_top").fadeOut();
        $(".wp_banner_wrapper_bottom").fadeOut();
    });
});