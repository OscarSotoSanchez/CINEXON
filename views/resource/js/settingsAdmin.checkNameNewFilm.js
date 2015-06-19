//javascritp encargado de comprobar el nombre de una pelicula

function exitNameFilm(name) {
    $.post("core/ajax/checkFields.php", {"command": "film", "value": name},
    function (data) {
        if (data === "true") {
            $("[name='cuadroName']").addClass("has-error");
            $("[name='messageName']").html("Ya existe una película con ese nombre");
            $("[name='messageName']").fadeIn(1000);
            $("[name='insertFilmInsert']").addClass("disabled");
        } else {
            $("[name='cuadroName']").removeClass("has-error");
            $("[name='messageName']").hide();
            $("[name='insertFilmInsert']").removeClass("disabled");
        }
    });
}

$(function () {
    $("[name='insertFilmName']").blur(function () {
        if ($(this).val() !== "") {
            exitNameFilm($(this).val());
        }
    });

    $("[name='insertFilmName']").keyup(function () {
        if ($(this).val() === "") {
            $("[name='cuadroName']").removeClass("has-error");
            $("[name='messageName']").hide();
            $("[name='insertFilmInsert']").addClass("disabled");
        }
    })
});