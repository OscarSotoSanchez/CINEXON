//Javascript encargado de modificar el formato

function modFormat() {
    var idList = $("[name='insertFilmFormat'] option:selected").val();

    if (idList === "Digital") {
        if (!$("[name='divDigital']").is(":visible")) {
            $("[name='divTaquilla']").hide();
            $("[name='insertFilmCines']").removeAttr("required");
            $("[name='insertFilmHoras']").removeAttr("required");
            $("[name='insertFilmNumTickets']").removeAttr("required");
            $("[name='insertFilmVideo']").attr("required", true);
            $("[name='divDigital']").fadeIn(500);
        }
    } else {
        if (!$("[name='divTaquilla']").is(":visible")) {
            $("[name='divDigital']").hide();
            $("[name='insertFilmVideo']").removeAttr("required");
            $("[name='insertFilmCines']").attr("required", true);
            $("[name='insertFilmHoras']").attr("required", true);
            $("[name='insertFilmNumTickets']").attr("required", true);
            $("[name='divTaquilla']").fadeIn(500);
        }
    }
}

jQuery(document).ready(function ($) {
    $("[name='insertFilmFormat']").change(modFormat);
});