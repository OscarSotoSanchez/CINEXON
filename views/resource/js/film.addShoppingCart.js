//Javascript para añadir elementos al carrito
var idsReserved = new Array();
var idMovie = $("[name='idMovie']").val();
var oldSelected;


function effectAddCart() {
    var carrito = $("[name='shop']");
    var imgtodrag = $("[name='imageShop']");

    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
                .offset({
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left
                })
                .css({
                    'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '2000'
                })
                .appendTo($('body'))
                .animate({
                    'top': carrito.offset().top + 10,
                    'left': carrito.offset().left + 10,
                    'width': 75,
                    'height': 75
                }, 1000, 'easeInOutExpo');

        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {
            $(this).detach()
        });
    }
}

function pintTickets() {
    var html = "<ul>";

    for (var x = 0; x < idsReserved.length; x++) {
        var corte = idsReserved[x].split("f");

        html += "<li class='text-left'>Entrada - Fila: " + (parseInt(corte[0]) + 1) + " Butaca: " + (parseInt(corte[1]) + 1) + "</li>";
    }

    html += "</ul>";

    $("[name='ticketsShops']").html("");
    $("[name='addShoppingCart']").removeClass("disabled");
    if (idsReserved.length > 0) {
        $("[name='ticketsShops']").append($(html).fadeIn(1000));
    } else {
        $("[name='ticketsShops']").append($('<p class="text-center">Pendiente de añadir.</p>').fadeIn(1000));
        $("[name='addShoppingCart']").addClass("disabled");
    }
}


function addShoppingDigitalCart() {
    $.post("core/ajax/addFilmDigitalCart.php", {'idMovie': idMovie},
    function (data) {
        $("[name='numShop']").html(data);
        $('[name="messageShop"]').html("<p class='text-muted'>Película en el carrito</p>");

        //messagePopUp("Compra añadida correctamente.");
        effectAddCart();
    });
}

function addReservedTickets() {
    var id = $(this).attr("id");

    if ($(this).children("a").hasClass("free")) {
        $(this).children("a").removeClass();
        $(this).children("a").addClass("reservedMy");
        idsReserved.push(id);

        pintTickets();
    } else if ($(this).children("a").hasClass("shop")) {
        messagePopUpError("Esta entrada ya esta comprada.");
    } else if ($(this).children("a").hasClass("reserved")) {
        messagePopUpError("Esta entrada ya esta reservada.");
    } else if ($(this).children("a").hasClass("reservedMy")) {
        var index = idsReserved.indexOf(id);

        idsReserved.splice(index, 1);
        $(this).children("a").removeClass();
        $(this).children("a").addClass("free");

        pintTickets();
    }
}

function reservedTickets() {
    idsReserved.sort();

    var idOffer = $(this).attr("id");

    $("#addShoppingCartTaquilla").modal('hide');

    $.post("core/ajax/reservedTickets.php", {'idOffer': idOffer, 'idMovie': idMovie, 'tickets': JSON.stringify(idsReserved)},
    function (data) {
        $("[name='numShop']").html(data);

        for (var x = 0; x < idsReserved.length; x++) {
            $("#" + idsReserved[x]).children("a").removeClass();
            $("#" + idsReserved[x]).children("a").addClass("reserved");
        }
        idsReserved = new Array();

        //messagePopUp("Compra añadida correctamente.");
        effectAddCart();
    });
}

function selectCinema() {
    var cinemaSelected = $("[name='selectCinema'] option:selected").val();

    for (var x = 0; x < idsReserved.length; x++) {
        $("#" + idsReserved[x]).children("a").removeClass();
        $("#" + idsReserved[x]).children("a").addClass("free");
    }
    idsReserved = new Array();

    $("[name='addShoppingCart']").attr("id", cinemaSelected.split("cinema")[1]);
    $("#" + oldSelected).hide();
    $("#" + cinemaSelected).fadeIn(500);
}

jQuery(document).ready(function ($) {
    $("[name='addShoppingDigitalCart']").click(addShoppingDigitalCart);
    $("[name='addShoppingCart']").click(reservedTickets);
    $("[name='selectTicket']").click(addReservedTickets);
    $("[name='selectCinema']").change(selectCinema);
    $("[name='selectCinema']").click(function () {
        oldSelected = $("[name='selectCinema'] option:selected").val();
    });
});
