//Javascript encargado de limpiar los tickets

var oldSelected;

function reservedTickets() {
    $.post("core/batchs/resetTicketsReserved.php",
            function () {
                messagePopUp("Entradas revervadas reiniciadas.");
            }
    );
}

function cleanTickets() {
    $.post("core/batchs/resetTickets.php",
            function () {
                messagePopUp("Entradas reiniciadas.");
            }
    );
}

function cleanTicketsByCinema() {
    var cinemaSelected = $("[name='selectCinema'] option:selected").val();
    var idOffer = cinemaSelected.split("cinema")[1];

    $.post("core/ajax/cleanTickets.php", {'idOffer': idOffer, 'action': "clean"},
    function () {

        messagePopUp("Entradas reservadas reiniciadas correctamente.");
        $("#" + cinemaSelected).find("[name='selectTicket']").each(function () {
            if ($(this).children("a").hasClass("reserved")) {
                $(this).children("a").removeClass();
                $(this).children("a").addClass("free");
            }
        });
    });
}

function resetTicketsByCinema() {
    var cinemaSelected = $("[name='selectCinema'] option:selected").val();
    var idOffer = cinemaSelected.split("cinema")[1];

    $.post("core/ajax/cleanTickets.php", {'idOffer': idOffer, 'action': "reset"},
    function () {

        messagePopUp("La sala se ha reiniciado correctamente.");
        $("#" + cinemaSelected).find("[name='selectTicket']").each(function () {
            $(this).children("a").removeClass();
            $(this).children("a").addClass("free");
        });
    });
}

function selectCinema() {
    var cinemaSelected = $("[name='selectCinema'] option:selected").val();

    $("[name='addShoppingCart']").attr("id", cinemaSelected.split("cinema")[1]);
    $("#" + oldSelected).hide();
    $("#" + cinemaSelected).fadeIn(500);
}

$(document).ready(function () {
    $(".list-group-item > ul").hide();

    $(".list-group-item").click(function (event) {
        if ($(this).hasClass("active")) {
            $(".list-group-item > ul").fadeOut(500);
        } else {
            var target = $(event.target);
            if (!target.is("a")) {
                $(this).children("ul").fadeToggle();
            }
        }
    });

    $("[name='deleteReservedTickets']").click(reservedTickets);
    $("[name='cleanTickets']").click(cleanTickets);

    $("[name='selectCinema']").change(selectCinema);
    $("[name='selectCinema']").click(function () {
        oldSelected = $("[name='selectCinema'] option:selected").val();
    });

    $("[name='cleanTicketsCinema']").click(cleanTicketsByCinema);
    $("[name='resetTicketsCinema']").click(resetTicketsByCinema);
});