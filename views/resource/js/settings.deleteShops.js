//JavaScript encargado de borrar compras
var typeShop;
var idUser = $("[name='idUser']").val(); 

function deleteShops() {
    $("#deleteShops").modal('hide');

    $.post("core/ajax/deleteShops.php", {'idUser': idUser, 'typeShop': typeShop},
    function () {
        if (typeShop === "deleteTickets") {

            $("[name='shopsCartelera']").fadeOut(1000, function () {
                $(this).remove();

                if ($("[name='tablesShops']").children("div").length <= 0) {
                    $("[name='tablesShops']").remove();

                    var annadir = $('<div class="col-md-12" style="margin-top: 10%;"><p class="text-center">Todavia no has realizado ninguna compra.</p></div>').fadeIn(1000);
                    $("#compras").children("div").append(annadir);
                }
            });
        } else {
            $("[name='shopsDigital']").fadeOut(1000, function () {
                $(this).remove();

                if ($("[name='tablesShops']").children("div").length <= 0) {
                    $("[name='tablesShops']").remove();

                    var annadir = $('<div class="col-md-12" style="margin-top: 10%;"><p class="text-center">Todavia no has realizado ninguna compra.</p></div>').fadeIn(1000);
                    $("#compras").children("div").append(annadir);
                }
            });
        }
    });
}

function saveShopsDelete() {
    typeShop = $(this).attr("id");
}

(function ($) {
    $("[name='btnDeleteShops']").on("click", saveShopsDelete);
    $("[name='btnYesShops']").on("click", deleteShops);
})(jQuery);
