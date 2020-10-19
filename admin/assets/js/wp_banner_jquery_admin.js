jQuery(document).ready(function( $ ) {
    $(document).click(function() {

        /**
         * Managing with customization, managing, and templates section
         */
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

        /**
         * Managing with popup, top and bottom position
         */
        if ($("input#wp_banner_position_popup").is(':checked')) {
            $(".wp_banner_template_wrapper").hide();
            $(".wp_banner_template_wrapper_popup").show().css("display", "inline-flex");

        } else if($("input#wp_banner_position_top").is(':checked')) {
            $(".wp_banner_template_wrapper").show().css("display", "inline-flex");
            $(".wp_banner_template_wrapper_popup").hide();

        } else if($("input#wp_banner_position_bottom").is(':checked')) {
            $(".wp_banner_template_wrapper").show().css("display", "inline-flex");
            $(".wp_banner_template_wrapper_popup").hide();

        } else if($("input#wp_banner_position_sticky").is(':checked')) {
            $(".wp_banner_template_wrapper").show().css("display", "inline-flex");
            $(".wp_banner_template_wrapper_popup").hide();

        } else {
            $(".wp_banner_template_wrapper").hide();
        }

    });
});