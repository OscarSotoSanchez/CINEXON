//Javascript que lanza el pop-up de mensajes
function messagePopUp(message) {
    $("[name='messagePopUpSuccess']").html(message);
    $("[name='message-success']").fadeIn(1000, function () {
        var command = "$('[name=" + '"message-success"' + "]').fadeOut(1000);";
        setTimeout(command, 2000);
    });
}

function messagePopUpError(message) {
    $("[name='messagePopUpError']").html(message);
    $("[name='message-error']").fadeIn(1000, function () {
        var command = "$('[name=" + '"message-error"' + "]').fadeOut(1000);";
        setTimeout(command, 2000);
    });
}

function messagePopUpChangePassword(message) {
    $("[name='messagePopUpSuccess']").html(message);
    $("[name='message-success']").fadeIn(1000, function () {
        var command = "$('[name=" + '"message-success"' + "]').fadeOut(1000, function(){window.location='sesion';});";
        setTimeout(command, 2500);
    });
}
