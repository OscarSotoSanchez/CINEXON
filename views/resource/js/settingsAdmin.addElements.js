//Javascript encargado de añadir elementos

function addDirector() {
    var nameDirector = $("[name='insertNameDirector']").val();

    $.post("core/ajax//addDirector.php", {"nameDirector": nameDirector},
    function (data) {

        if ($.trim(data) === "true") {
            messagePopUp("El director se ha añadido correctamente, para ver los cambios refresca la página.");
        } else {
            messagePopUpError("No puedes añadir un director ya existente.");
        }

        $("[name='insertDirector']").addClass("disabled");
        $("[name='insertNameDirector']").val("");
    });
}

function addActor() {
    var nameActor = $("[name='insertNameActor']").val();

    $.post("core/ajax/addActor.php", {'nameActor': nameActor},
    function (data) {

        if ($.trim(data) === "true") {
            messagePopUp("El actor se ha añadido correctamente, para ver los cambios refresca la página.");
        } else {
            messagePopUpError("No puedes añadir un actor ya existente.");
        }

        $("[name='insertActor']").addClass("disabled");
        $("[name='insertNameActor']").val("");
    });
}

function addGenero() {
    var nameGenero = $("[name='insertNameGenero']").val();

    $.post("core/ajax/addGenero.php", {'nameGenero': nameGenero},
    function (data) {

        if ($.trim(data) === "true") {
            messagePopUp("El género se ha añadido correctamente, para ver los cambios refresca la página.");
        } else {
            messagePopUpError("No puedes añadir un actor ya existente.");
        }

        $("[name='insertGenero']").addClass("disabled");
        $("[name='insertNameGenero']").val("");
    });
}

function addCinema() {
    var nameCinema = $("[name='insertNameCinema']").val();
    var addressCinema = $("[name='insertNameAddress']").val();

    $.post("core/ajax/addCinema.php", {'nameCinema': nameCinema, 'addressCinema': addressCinema},
    function (data) {

        if ($.trim(data) === "true") {
            messagePopUp("El cine se ha añadido correctamente, para ver los cambios refresca la página.");
        } else {
            messagePopUpError("No puedes añadir un cine ya existente.");
        }

        $("[name='insertCinema']").addClass("disabled");
        $("[name='insertNameCinema']").val("");
        $("[name='insertNameAddress']").val("");
    });
}

function cinemaCheck(e) {
    var nameCinema = $("[name='insertNameCinema']").val();
    var addressCinema = $("[name='insertNameAddress']").val();

    if (nameCinema !== "" && addressCinema !== "") {
        $("[name='insertCinema']").removeClass("disabled");
        if (e.which === 13) {
            $("[name='insertCinema']").click();
        }
    } else {
        $("[name='insertCinema']").addClass("disabled");
    }
}

jQuery(document).ready(function ($) {
    $("[name='insertDirector']").click(addDirector);
    $("[name='insertNameDirector']").keyup(function (e) {
        if ($(this).val() === "") {
            $("[name='insertDirector']").addClass("disabled");
        } else {
            $("[name='insertDirector']").removeClass("disabled");
            if (e.which === 13) {
                $("[name='insertDirector']").click();
            }
        }
    });

    $("[name='insertActor']").click(addActor);
    $("[name='insertNameActor']").keyup(function (e) {
        if ($(this).val() === "") {
            $("[name='insertActor']").addClass("disabled");
        } else {
            $("[name='insertActor']").removeClass("disabled");
            if (e.which === 13) {
                $("[name='insertActor']").click();
            }
        }
    });

    $("[name='insertGenero']").click(addGenero);
    $("[name='insertNameGenero']").keyup(function (e) {
        if ($(this).val() === "") {
            $("[name='insertGenero']").addClass("disabled");
        } else {
            $("[name='insertGenero']").removeClass("disabled");
            if (e.which === 13) {
                $("[name='insertGenero']").click();
            }
        }
    });

    $("[name='insertCinema']").click(addCinema);
    $("[name='insertNameCinema']").keyup(function (e) {
        cinemaCheck(e);
    });
    $("[name='insertNameAddress']").keyup(function (e) {
        cinemaCheck(e);
    });
});
