//Javascript encargado de borrar elementos

function removeFilm() {
    var idMovie = $("[name='selectRemoveFilm'] option:selected").val();

    $.post("core/ajax/deleteFilm.php", {'idFilm': idMovie},
    function () {

        messagePopUp("Película eliminada correctamente.");

        $("[name='selectRemoveFilm'] option:selected").remove();
    });
}

function removeDirector() {
    var idDirector = $("[name='selectRemoveDirector'] option:selected").val();

    $.post("core/ajax/deleteDirector.php", {'idDirector': idDirector},
    function () {

        messagePopUp("Director eliminado correctamente.");

        $("[name='selectRemoveDirector'] option:selected").remove();
    });
}

function removeActor() {
    var idActor = $("[name='selectRemoveActor'] option:selected").val();

    $.post("core/ajax/deleteActor.php", {'idActor': idActor},
    function () {

        messagePopUp("Actor eliminado correctamente.");

        $("[name='selectRemoveActor'] option:selected").remove();
    });
}

function removeCinema() {
    var idCinema = $("[name='selectRemoveCinema'] option:selected").val();

    $.post("core/ajax/deleteCinema.php", {'idCinema': idCinema},
    function () {

        messagePopUp("Cine eliminado correctamente.");

        $("[name='selectRemoveCinema'] option:selected").remove();
    });
}

function removeGenero() {
    var idGenero = $("[name='selectRemoveGenero'] option:selected").val();

    $.post("core/ajax/deleteGenero.php", {'idGenero': idGenero},
    function () {

        messagePopUp("Género eliminado correctamente.");

        $("[name='selectRemoveGenero'] option:selected").remove();
    });
}

jQuery(document).ready(function ($) {
    $("[name='removeFilm']").click(removeFilm);
    $("[name='removeDirector']").click(removeDirector);
    $("[name='removeActor']").click(removeActor);
    $("[name='removeCinema']").click(removeCinema);
    $("[name='removeGenero']").click(removeGenero);
});
