//Javascript encargado de modificar elementos
function modDirector() {
    var nameDirector = $("[name='modNameDirector']").val();
    var idDirector = $("[name='modidDirector']").val();

    $.post("core/ajax/refreshDirector.php", {"idDirector": idDirector, "nameDirector": nameDirector},
    function () {
        messagePopUp("El director se ha modificado correctamente.");
    });
}

function modActor() {
    var nameActor = $("[name='modNameActor']").val();
    var idActor = $("[name='modidActor']").val();

    $.post("core/ajax/refreshActor.php", {"idActor": idActor, "nameActor": nameActor},
    function () {
        messagePopUp("El actor se ha modificado correctamente.");
    });
}

function modGenero() {
    var nameGenero = $("[name='modNameGenero']").val();
    var idGenero = $("[name='modidGenero']").val();

    $.post("core/ajax/refreshGenero.php", {"idGenero": idGenero, "nameGenero": nameGenero},
    function () {
        messagePopUp("El genero se ha modificado correctamente.");
    });
}

function modCinema() {
    var nameCinema = $("[name='modNameCinema']").val();
    var addressCinema = $("[name='modAddressCinema']").val();
    var idCinema = $("[name='modidCinema']").val();

    $.post("core/ajax/refreshCinema.php", {'idCinema': idCinema, 'nameCinema': nameCinema, 'addressCinema': addressCinema},
    function () {
        messagePopUp("El cine se ha modificado correctamente.");
    });
}

function cinemaCheck(e) {
    var nameCinema = $("[name='modNameCinema']").val();
    var addressCinema = $("[name='modAddressCinema']").val();

    if (nameCinema !== "" && addressCinema !== "") {
        $("[name='modCinema']").removeClass("disabled");
        if (e.which === 13) {
            $("[name='modCinema']").click();
        }
    } else {
        $("[name='modCinema']").addClass("disabled");
    }
}

jQuery(document).ready(function ($) {
    $("[name='modDirector']").click(modDirector);
    $("[name='modNameDirector']").keyup(function (e) {
        if ($(this).val() === "") {
            $("[name='modDirector']").addClass("disabled");
        } else {
            $("[name='modDirector']").removeClass("disabled");
            if (e.which === 13) {
                $("[name='modDirector']").click();
            }
        }
    });

    $("[name='modActor']").click(modActor);
    $("[name='modNameActor']").keyup(function (e) {
        if ($(this).val() === "") {
            $("[name='modActor']").addClass("disabled");
        } else {
            $("[name='modActor']").removeClass("disabled");
            if (e.which === 13) {
                $("[name='modActor']").click();
            }
        }
    });

    $("[name='modGenero']").click(modGenero);
    $("[name='modNameGenero']").keyup(function (e) {
        if ($(this).val() === "") {
            $("[name='modGenero']").addClass("disabled");
        } else {
            $("[name='modGenero']").removeClass("disabled");
            if (e.which === 13) {
                $("[name='modGenero']").click();
            }
        }
    });

    $("[name='modCinema']").click(modCinema);
    $("[name='modNameCinema']").keyup(function (e) {
        cinemaCheck(e);
    });
    $("[name='modAddressCinema']").keyup(function (e) {
        cinemaCheck(e);
    });
});
