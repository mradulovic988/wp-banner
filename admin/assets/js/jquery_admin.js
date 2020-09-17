jQuery(document).click(function() {

    if (jQuery("input#customization").is(':checked')) {
        jQuery("tr.wp_banner_class_templates").hide();
        jQuery("tr.wp_banner_class_customization").show();

    } else if (jQuery("input#predefined").is(':checked')) {

        jQuery("tr.wp_banner_class_templates").show();
        jQuery("tr.wp_banner_class_customization").hide();
    } else {

        jQuery("tr.wp_banner_class_templates").hide();
        jQuery("tr.wp_banner_class_customization").hide();
    }

    jQuery("input#wp_banner_id_turn_on").click(function (){
        jQuery("tr.wp_banner_class_managing").toggle();
    })

});