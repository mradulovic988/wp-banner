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