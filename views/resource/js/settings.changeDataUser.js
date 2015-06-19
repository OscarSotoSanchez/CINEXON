//Javascript encargado de modificar el usuario
var idUser = $("[name='idUser']").val();

function changeDataUser() {
    var name = $("[name='name']").val();
    var role = $("[name='roleUser'] option:selected").val();
    var pass = $("[name='password']").val();
    var edad = $("[name='age']").val();

    if (name === "" || pass === "") {
        messagePopUpError("El campo de nombre y contraseña tienen que estar rellenos.");
    } else {
        if (role === undefined) {
            role = "NOT ADMIN";
        }
        
        if(edad === ""){
            edad = "NULL";
        }

        $.post("core/ajax/changePersonalData.php", {"idUser": idUser, "role": role, "name": name, "pass": pass, "age": edad},
        function () {
            messagePopUp("El usuario se ha modificado correctamente.");
        });
    }
}

function deleteUser() {
    $("#deleteUser").modal('hide');
    
    $.post("core/ajax/deleteUser.php", {"idUser": idUser},
    function () {
        window.location.reload();
    });
}

jQuery(document).ready(function ($) {
    $("[name='btnYesDeleteUser']").click(deleteUser);
    
    $("[name='buttonMod']").click(changeDataUser);
    $("[name='age']").keydown(function (event) {
        if (event.shiftKey)
        {
            event.preventDefault();
        }

        if (event.keyCode == 46 || event.keyCode == 8) {
        }
        else {
            if (event.keyCode < 95) {
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
            }
            else {
                if (event.keyCode < 96 || event.keyCode > 105) {
                    event.preventDefault();
                }
            }
        }
    });
});
