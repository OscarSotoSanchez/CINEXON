
var nextIdMovieFilm = 1;

function obtainFilms(idFilm) {
    $.post("php/ajax/getFilms.php", {'idMovie': idFilm},
    function (data) {
        var result = JSON.parse(data);

        for (x = 0; x < result[0].length; x++) {
            if (nextIdMovieFilm != 1) {
                var element = $(result[0][x]).fadeIn(2000);
            } else {
                var element = $(result[0][x]);
            }
            $("#layoutFilms").append(element);
        }

        if (result[1] !== 0) {
            nextIdMovieFilm = result[1];
        } else {
            $("#moreFilms").unbind('click');
            $("#moreFilms").fadeOut(200);
            $("#moreFilmsMessage").html("No hay mas Películas");
        }
    });
}

$(document).ready(function () {
    $(".list-group-item > input").hide();

    $(".list-group-item").click(function () {
        if (!$("[name='inputSearch']").is(":focus")) {
            input = $(this).children("input");
            //input.slideToggle('fast');
            input.fadeToggle();
            input.val("");
        }
    });

    $("#moreFilms").click(function () {
        obtainFilms(nextIdMovieFilm);
    });

    obtainFilms(nextIdMovieFilm);
});