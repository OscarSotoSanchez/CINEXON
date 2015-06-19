//Modificar formato
function modFormat() {
    var idList = $("[name='modFilmFormat'] option:selected").val();

    if (idList === "Digital") {
        if (!$("[name='divDigital']").is(":visible")) {
            $("[name='divTaquilla']").hide();
            $("[name='modFilmCines']").removeAttr("required");
            $("[name='modFilmHoras']").removeAttr("required");
            $("[name='modFilmNumTickets']").removeAttr("required");
            $("[name='modFilmVideo']").attr("required", true);
            $("[name='divDigital']").fadeIn(500);
        }
    } else {
        if (!$("[name='divTaquilla']").is(":visible")) {
            $("[name='divDigital']").hide();
            $("[name='modFilmVideo']").removeAttr("required");
            $("[name='modFilmCines']").attr("required", true);
            $("[name='modFilmHoras']").attr("required", true);
            $("[name='modFilmNumTickets']").attr("required", true);
            $("[name='divTaquilla']").fadeIn(500);
        }
    }
}

jQuery(document).ready(function ($) {
    $("[name='modFilmFormat']").change(modFormat);
});