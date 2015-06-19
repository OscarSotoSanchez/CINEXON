//Javascript encargado de gestionar las listas

var idUser = $("[name='idUser']").val();

function addList(nameList) {
    $.post("core/ajax/addList.php", {'idUser': idUser, 'nameList': nameList},
    function (id) {
        var htmlList = '<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading' + id + '"><h4 class="panel-title"><a style="text-decoration: none;" data-toggle="collapse" data-parent="#accordion" href="#collapse' + id + '" aria-expanded="true" aria-controls="collapse' + id + '">' + nameList + '</a><span name="deleteList" id="' + id + '" style="float:right;" class="glyphicon glyphicon-remove"></span></h4></div><div id="collapse' + id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' + id + '"><div class="panel-body"><p class="text-center">No hay películas añadidas en la lista</p></div></div></div>';
        $("#accordion").append($(htmlList).fadeIn(2000));
        $("[name='deleteList']").unbind("click");
        $("[name='deleteList']").click(deleteList);
    });
}

function deleteList() {
    var numLists = $("#accordion").children(".panel").length;
    var idList = $(this).attr("id");
    var list = $(this).parents(".panel");

    if (numLists > 1) {
        $.post("core/ajax/deleteList.php", {'idList': idList},
        function () {
            list.fadeOut(1000, function () {
                $(this).remove();
            });
        });
    } else {
        messagePopUpError("No puedes borrar todas las listas.")
    }
}

function deleteElementList() {
    var idElementList = $(this).attr("id");
    var elementList = $(this).parent();
    
    $.post("core/ajax/deleteElementList.php", {'idElementList': idElementList},
    function () {
        elementList.fadeOut(1000, function () {
            var panel = $(this).parents(".panel-body");
            $(this).remove();
            
            if(panel.children("p").length === 0){
                panel.append($('<p class="text-center">No hay películas añadidas en la lista</p>').fadeIn(1500));
            }
        });
    });
}

function checkExistList() {
    var nameList = $("[name='inputNameList']").val();
    var arrayData = [idUser, nameList];
    var dataSend = JSON.stringify(arrayData);

    $.post("core/ajax/checkFields.php", {"command": "list", "value": dataSend},
    function (data) {
        if (data === "true") {
            $("[name='cuadroInputNameList']").addClass("has-error");
            $("[name='mensajeNameList']").html("Ya existe una lista con ese nombre.");
            $("[name='mensajeNameList']").fadeIn(1000);
        } else {
            $("#addNewList").modal('hide');
            $("[name='buttonAddNewList']").addClass("disabled");
            $("[name='inputNameList']").val("");
            addList(nameList);
        }
    });
}

jQuery(document).ready(function ($) {
    $("[name='deleteList']").click(deleteList);
    $("[name='deleteElementList']").click(deleteElementList);
    $("[name='buttonAddNewList']").click(checkExistList);
    $("[name='inputNameList']").keyup(function (e) {
        if (e.keyCode === 13) {
            if (!$("[name='buttonAddNewList']").hasClass("disabled")) {
                $("[name='buttonAddNewList']").click();
            }
        }

        if ($(this).val() === "") {
            $("[name='buttonAddNewList']").addClass("disabled");
        } else {
            $("[name='buttonAddNewList']").removeClass("disabled");
        }

        $("[name='cuadroInputNameList']").removeClass("has-error");
        $("[name='mensajeNameList']").hide();
    });
});
