//Javascript encargado de cargar los usuarios
function obtainUsers(users) {
    var datos = JSON.stringify(users);
    $.post("core/ajax/getUsers.php", {'users': datos},
    function (data) {
        var result = JSON.parse(data);

        for (x = 0; x < result[0].length; x++) {
            var element;
            element = $(result[x]).fadeIn(2000);
            $("#layoutUsers").append(element);
        }

        if (idUsers.length === 0) {
            $("#moreUsers").unbind('click');
            $("#moreUsers").fadeOut(200);
            $("#moreUsersMessage").html("No hay mas Usuarios");
        }
    });
}

$(document).ready(function () {
    $(".list-group-item > input").hide();

    $(".list-group-item").click(function () {
        if (!$(".list-group-item > input").is(":focus")) {
            input = $(this).children("input");
            input.fadeToggle();
            input.val("");
        }
    });

    $(".list-group-item > input").val("");

    $("#moreUsers").click(function () {
        $("#scroll").attr("style", "display: block !important;");
        var cont = 9;

        if (idUsers.length < 9) {
            cont = idUsers.length;
        }
        
        users = new Array();
        for (x = 0; x < cont; x++) {
            users.push(idUsers[x]);
        }

        idUsers.splice(0, cont);
        obtainUsers(users);
    });

});