//JavaScript encargado del input de los comentarios

var valoration;
var idValoration;

function deleteValoration() {
    $("#deleteValoration").modal('hide');

    $.post("core/ajax/deleteValoration.php", {'idValoration': idValoration},
    function (data) {
        valoration.fadeOut(1000, function () {
            $(this).remove();

            if ($("#valorations").children("div").length <= 0) {
                var annadir = $('<div class="col-md-12 critica" id="vacio"><p class="text-center">Esta película todavia no tiene ninguna crítica.</p></div>').fadeIn(1000);
                $("#valorations").prepend(annadir);
            }
        });

        $("[name='btnAddValoration']").html("Dejar una critica");
        $("[name='btnAddValoration']").removeClass("disabled");

        $("[name='startsUser']").html("No has valorado esta película.");
        if (data > 0) {
            $("[name='startsMovie']").html(returnStarts(result[1]) + " Nota General");
        } else {
            $("[name='startsMovie']").html("Esta película no tiene valoraciones.");
        }
    });
}

function saveValorationDelete() {
    valoration = $(this).parent("div");
    idValoration = $(this).attr("id");
}

(function ($) {
    $("[name='btnDeleteValoration']").on("click", saveValorationDelete);
    $("[name='btnYes']").on("click", deleteValoration);
})(jQuery);
