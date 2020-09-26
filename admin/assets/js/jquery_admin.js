jQuery(document).ready(function( $ ) {
    $(document).click(function() {

        if ($("input#customization").is(':checked')) {
            $("tr.wp_banner_class_managing").show();
            $("tr.wp_banner_class_templates").hide();

        } else if ($("input#predefined").is(':checked')) {

            $("tr.wp_banner_class_managing").show();
            $("tr.wp_banner_class_templates").show();
        } else if ($("input#none").is(':checked')) {

            $("tr.wp_banner_class_managing").hide();
            $("tr.wp_banner_class_templates").hide();
        } else {

            $("tr.wp_banner_class_managing").hide();
            $("tr.wp_banner_class_templates").hide();
        }

    });
});