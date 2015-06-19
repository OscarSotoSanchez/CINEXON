//Javascript encargado de cambair la contraseña del admin

function changePassword() {
    var idUser = $("[name='idUser']").val();
    var password = $("[name='password']").val();

    if (password === "") {
        messagePopUpError("Escriba una contraseña para poder cambiarla.")
    } else {
        $.post("core/ajax/changeAdminPass.php", {'idUser': idUser, 'pass': password},
        function () {

            messagePopUp("Contraseña cambiada correctamente.");

            $("[name='selectRemoveFilm'] option:selected").remove();
        });
    }
}


jQuery(document).ready(function ($) {
    $("[name='buttonMod']").click(changePassword);
});
