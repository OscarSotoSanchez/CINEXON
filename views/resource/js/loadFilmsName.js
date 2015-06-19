//Javascript encargado de cargar las peliculas
function obtainFilms(movies) {
    var datos = JSON.stringify(movies);
    $.post("core/ajax/getFilmsByName.php", {'movies': datos},
    function (data) {
        var result = JSON.parse(data);

        for (x = 0; x < result[0].length; x++) {
            var element;
            element = $(result[x]).fadeIn(2000);
            $("#layoutFilms").append(element);
        }

        if (idFilms.length === 0) {
            $("#moreFilms").unbind('click');
            $("#moreFilms").fadeOut(200);
            $("#moreFilmsMessage").html("No hay mas Películas");
        }
    });
}

$(document).ready(function () {
    $(".list-group-item > input").hide();

    $(".list-group-item").click(function () {
        if (!$(".list-group-item > input").is(":focus")) {
            input = $(this).children("input");
            input.fadeToggle();
            input.val("");
        }
    });

    $(".list-group-item > input").val("");

    $("#moreFilms").click(function () {
        $("#scroll").attr("style", "display: block !important;");
        if (idFilms.length >= 9) {
            films = new Array();
            for (x = 0; x < 9; x++) {
                films.push(idFilms[x]);
            }

            idFilms.splice(0, 9);
        } else {
            films = new Array();
            for (x = 0; x < idFilms.length; x++) {
                films.push(idFilms[x]);
            }

            idFilms.splice(0, idFilms.length);
        }
        obtainFilms(films);
    });

});