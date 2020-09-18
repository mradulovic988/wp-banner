jQuery(document).ready(function( $ ) {
    $(document).click(function() {

        if ($("input#customization").is(':checked')) {
            $("tr.wp_banner_class_templates").hide();
            $("tr.wp_banner_class_customization").show();

        } else if ($("input#predefined").is(':checked')) {

            $("tr.wp_banner_class_templates").show();
            $("tr.wp_banner_class_customization").hide();
        } else {

            $("tr.wp_banner_class_templates").hide();
            $("tr.wp_banner_class_customization").hide();
        }

        $("input#wp_banner_id_turn_on").click(function (){
            $("tr.wp_banner_class_managing").toggle();
        })
    });
});