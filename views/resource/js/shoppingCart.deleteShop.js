//JavaScript encargado de eliminar una compra

var movie;
var idMovie;

function clickButton() {
    movie = $(this).parent().parent();
    idMovie = $(this).attr("id");
}

function deleteElement() {
    $.post("core/ajax/deleteFilmCart.php", {'idMovie': idMovie},
    function (data) {
        var result = JSON.parse(data);

        if (result[1] === 0) {
            document.location.reload();
        } else {
            $('[name="numShop"]').html(result[0]);
            $('[name="totalPrice"]').html("Total: " + result[1] + " €");

            movie.fadeOut(500, function () {
                $(this).remove();
            });
        }
    });
}

(function ($) {
    $('[name="delete"]').on("click", clickButton);

    $("#btnYes").on("click", function () {
        $("#deleteShoppingCart").modal('hide');
        deleteElement();
    });
})(jQuery);