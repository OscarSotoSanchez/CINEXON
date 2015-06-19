/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $("[name='inputEmail']").blur(function () {
        var expresion = /^[a-zA-Z0-9_ñÑ\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/;
        if ($(this).val() !== "") {
            if (expresion.test($(this).val())) {
                $("[name='cuadroEmail']").addClass("has-success");
                $("[name='cuadroEmail']").removeClass("has-error");
                $("[name='mensajeEmail']").hide();
            } else {
                $("[name='cuadroEmail']").removeClass("has-success");
                $("[name='cuadroEmail']").addClass("has-error");
                $("[name='mensajeEmail']").html("Email Icorrecto");
                $("[name='mensajeEmail']").fadeIn(1000);
            }
        }
    });

    $("[name='email']").keyup(function () {
        if ($(this).val() === "") {
            $("[name='cuadroEmail']").removeClass("has-error");
            $("[name='cuadroEmail']").removeClass("has-success");
            $("[name='mensajeEmail']").hide();
        }
    });

    $("[name='inputNick']").blur(function () {
        if ($(this).val() !== "") {
            $("[name='cuadroNick']").addClass("has-success");
        }
    });

    $("[name='inputNick']").keyup(function () {
        if ($(this).val() === "") {
            $("[name='cuadroNick']").removeClass("has-error");
            $("[name='cuadroNick']").removeClass("has-success");
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
});