//JavaScript encargado del input de los comentarios
var idMessage;

function deleteMessage() {
    $("#deleteMessage").modal('hide');

    $.post("core/ajax/deleteMessage.php", {'idMessage': idMessage},
    function () {
        message.fadeOut(1000, function () {
            $(this).remove();

            if ($("#messages").children("div").length <= 1) {
                var annadir = $('<div class="col-md-12" style="margin-top: 5%;"><p class="text-center">No has recibido ningún mensaje.</p></div>').fadeIn(1000);
                $("#messages").children("div").append(annadir);
            }
        });
    });
}

function saveMessageDelete() {
    message = $(this).parents(".critica");
    idMessage = $(this).attr("id");
}

(function ($) {
    $("[name='btnDeleteMessage']").on("click", saveMessageDelete);
    $("[name='btnYesMessage']").on("click", deleteMessage);
})(jQuery);
