
$(function () {
    $("#button").click(function () {
        var expresion = /^[a-zA-Z0-9_ñÑ\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/;
        if ($("[name='inputEmail']").val() !== "") {
            if (expresion.test($("[name='inputEmail']").val())) {
                $.post("core/ajax/checkFields.php", {"command": "email", "value": $("[name='inputEmail']").val()},
                function (data) {
                    if (data === "true") {
                        $("[name='cuadroEmail']").addClass("has-success");
                        $("[name='cuadroEmail']").removeClass("has-error");
                        $("[name='mensajeEmail']").hide();
                        
                        $.post("core/ajax/restartPassword.php", {"email": $("[name='inputEmail']").val()},
                        function(){
                            messagePopUpChangePassword("La contraseña se ha cambiado y enviado a su email satisfactoriamente . Vas a ser redirecionado...");
                        });

                    } else {
                        $("[name='cuadroEmail']").removeClass("has-success");
                        $("[name='cuadroEmail']").addClass("has-error");
                        $("[name='mensajeEmail']").html("No hay ningún usuario con este Email.");
                        $("[name='mensajeEmail']").fadeIn(1000);
                    }
                });
            } else {
                $("[name='cuadroEmail']").removeClass("has-success");
                $("[name='cuadroEmail']").addClass("has-error");
                $("[name='mensajeEmail']").html("Email Icorrecto");
                $("[name='mensajeEmail']").fadeIn(1000);
            }
        }
    });

    $("[name='inputEmail']").keypress(function (e) {
        if (e.which === 13) {
            $("#button").focus();
            $("#button").click();
        }
    });
});