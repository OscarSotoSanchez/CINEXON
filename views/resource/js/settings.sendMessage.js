//Javascript encargado de mandar mensajes

var receiver = -100;

function sendMessage(idTransmitter, idReciver, message) {
    $("#sendMessage").modal('hide');
    clearForm();

    $.post("core/ajax/sendMessage.php", {'idTransmitter': idTransmitter, 'idReceiver': idReciver, 'message': message},
    function () {
        messagePopUp("Mensaje enviado correctamente.");
    });
}

function writeMessage() {
    if ($(this).val().length > 0) {
        $("[name='buttonSendMessage']").removeClass("disabled");
    } else {
        $("[name='buttonSendMessage']").addClass("disabled");
    }
}

function clearForm() {
    $("[name='bodyMessage']").val("");
    if (!$([name = 'buttonSendMessage']).hasClass("disabled")) {
        $("[name='buttonSendMessage']").addClass("disabled");
    }
}

function clickReply() {
    receiver = $(this).attr("id");
    $("[name='nameReceiber']").html(nameUser = $(this).attr("nameUser"));
}

(function ($) {
    $("[name='bodyMessage']").on("keyup", writeMessage);
    $("[name='buttonSendMessage']").on("click", function () {
        var message = $("[name='bodyMessage']").val();
        var idTransmitter = 0;
        var idReceiver = 0;

        if ($("[name='idTransmitter']").val() !== undefined) {
            idTransmitter = $("[name='idTransmitter']").val();
            idReceiver = $("[name='idUser']").val();
            
        } else {
            idTransmitter = $("[name='idUser']").val();
            idReceiver = receiver;
        }

        sendMessage(idTransmitter, idReceiver, message);
    });
    $("[name='replyMessage']").on("click", clickReply);
    $("[name='nameSend']").on("click", function (){
        $("[name='nameReceiber']").html($(this).attr("id"));
    });
})(jQuery);
