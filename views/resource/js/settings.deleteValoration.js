//JavaScript encargado de borrar los comentarios

var valoration;
var idValoration;

function deleteValoration() {
    $("#deleteValoration").modal('hide');

    $.post("core/ajax/deleteValoration.php", {'idValoration': idValoration},
    function () {
        valoration.fadeOut(1000, function () {
            $(this).remove();

            if ($("#valorations").children("div").length <= 1) {
                var annadir = $('<div class="col-md-12" style="margin-top: 10%;"><p class="text-center">Todavia no has realizado ninguna crítica.</p></div>').fadeIn(1000);
                $("#valorations").append(annadir);
            }
        });
    });
}

function saveValorationDelete() {
    valoration = $(this).parent("div");
    idValoration = $(this).attr("id");
}

(function ($) {
    $("[name='btnDeleteValoration']").on("click", saveValorationDelete);
    $("[name='btnYesValoration']").on("click", deleteValoration);
})(jQuery);
