//Javascript encargado del registro
var email;
var nick;
var password;

function registerOn() {
    if (email === true && nick === true && password === true) {
        $("#button").removeClass("disabled");
    } else {
        $("#button").addClass("disabled");
    }
}

$(function () {
    $("[name='inputEmail']").keyup(function () {
        if ($(this).val() === "") {
            $("[name='cuadroEmail']").removeClass("has-error");
            $("[name='cuadroEmail']").removeClass("has-success");
            $("[name='mensajeEmail']").hide();
            email = false;
            registerOn();
        }
    });

    $("[name='inputEmail']").blur(function () {
        var expresion = /^[a-zA-Z0-9_Ã±Ã‘\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/;
        if ($(this).val() !== "") {
            if (expresion.test($(this).val())) {
                $.post("core/ajax/checkFields.php", {"command": "email", "value": $(this).val()},
                function (data) {
                    if (data === "true") {
                        $("[name='cuadroEmail']").removeClass("has-success");
                        $("[name='cuadroEmail']").addClass("has-error");
                        $("[name='mensajeEmail']").html("Ya existe un usuario con ese Email");
                        $("[name='mensajeEmail']").fadeIn(1000);
                        email = false;
                    } else {
                        $("[name='cuadroEmail']").addClass("has-success");
                        $("[name='cuadroEmail']").removeClass("has-error");
                        $("[name='mensajeEmail']").hide();
                        email = true;
                    }
                    registerOn();
                });
            } else {
                $("[name='cuadroEmail']").removeClass("has-success");
                $("[name='cuadroEmail']").addClass("has-error");
                $("[name='mensajeEmail']").html("Email Icorrecto");
                $("[name='mensajeEmail']").fadeIn(1000);
                email = false;
                registerOn();
            }
        }
    });

    $("[name='inputNick']").blur(function () {
        if ($(this).val() !== "") {
            $.post("core/ajax/checkFields.php", {"command": "nick", "value": $(this).val()},
            function (data) {
                if (data === "true") {
                    $("[name='cuadroNick']").removeClass("has-success");
                    $("[name='cuadroNick']").addClass("has-error");
                    $("[name='mensajeNick']").html("Ya existe un usuario con ese Nick");
                    $("[name='mensajeNick']").fadeIn(1000);
                    nick = false;
                } else {
                    $("[name='cuadroNick']").addClass("has-success");
                    $("[name='cuadroNick']").removeClass("has-error");
                    $("[name='mensajeNick']").hide();
                    nick = true;
                }

                registerOn();
            });
        }
    });
    
    $("[name='inputNick']").keypress(function (e){
        if (e.keyCode === 32){
            return false;
        }
    });

    $("[name='inputNick']").keyup(function () {
            if ($(this).val() === "") {
                $("[name='cuadroNick']").removeClass("has-error");
                $("[name='cuadroNick']").removeClass("has-success");
                $("[name='mensajeNick']").hide();
                registerOn();
            }
    });

    $("[name='inputName']").blur(function () {
        if ($(this).val() !== "") {
            $("[name='cuadroNombre']").addClass("has-success");
        }
    });

    $("[name='inputName']").keyup(function () {
        if ($(this).val() === "") {
            $("[name='cuadroNombre']").removeClass("has-error");
            $("[name='cuadroNombre']").removeClass("has-success");
        }
    });

    $("[name='inputPass']").keyup(function () {
        if ($(this).val() === "") {
            password = false;
            $("[name='cuadroPass']").removeClass("has-error");
            $("[name='cuadroPass']").removeClass("has-success");
            $("[name='mensajeContra']").hide();
        }

        checkPass();
    });

    $("[name='inputPassRepeat']").keyup(function () {
        if ($(this).val() === "") {
            password = false;
            $("[name='cuadroPass']").removeClass("has-error");
            $("[name='cuadroPass']").removeClass("has-success");
            $("[name='mensajeContra']").hide();
        }

        checkPass();
    });

    function checkPass() {
        $pass = $("[name='inputPass']").val();
        $passRepeat = $("[name='inputPassRepeat']").val();

        if ($pass !== "" && $passRepeat !== "") {
            if ($pass !== $passRepeat) {
                $("[name='cuadroPass']").removeClass("has-success");
                $("[name='cuadroPass']").addClass("has-error");
                $("[name='mensajeContra']").html("Las contraseñas no coinciden");
                if (!$("[name='mensajeContra']").is(":visible")) {
                    $("[name='mensajeContra']").fadeIn(1000);
                }
                password = false;
            } else {
                $("[name='cuadroPass']").removeClass("has-error");
                $("[name='cuadroPass']").addClass("has-success");
                $("[name='mensajeContra']").hide();
                password = true;
            }
        }

        registerOn();
    }
});