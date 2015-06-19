//Activamos las pestannas moviles(detalles,relacioandas,criticas).
jQuery(document).ready(function ($) {
    $('#tabs').tab();

    $("[name='pestanna']").click(function () {
        $("[name='pestanna']").removeClass("active");
        $(this).addClass("active");
    });
});
