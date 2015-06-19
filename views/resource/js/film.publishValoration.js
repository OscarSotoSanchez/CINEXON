//JavaScript encargado del input de las valoraciones y anandir las valoraciones

var starts = 1;

function publishValoration() {
    var codMovie = $("[name='codMovie']").val();
    var review = $("[name='review']").val();

    $("#addValoration").modal('hide');

    $.post("core/ajax/writeValoration.php", {'review': review, 'numStarts': starts, 'codMovie': codMovie},
    function (data) {
        var result = JSON.parse(data);

        if ($('#vacio').length) {
            $('#vacio').fadeOut(200, function (){
                $(this).remove();
            });
        }

        var annadir = $(result[0]).fadeIn(3000);
        $("#valorations").prepend(annadir);

        $("[name='btnAddValoration']").html("No puedes dejar mas criticas");
        $("[name='btnAddValoration']").addClass("disabled");

        $("[name='startsUser']").html(returnStarts(starts) + " Mi nota");
        $("[name='startsMovie']").html(returnStarts(result[1]) + " Nota General");

        $("[name='btnDeleteValoration']").on("click", saveValorationDelete);
        
        clearForm();
    });
}

function pointStart() {
    var numStarts = parseInt($(this).attr("id"));
    var write = returnStarts(numStarts);

    $("[name='starts']").html(write);
    starts = numStarts;
    $("[name='start']").on("click", pointStart);
}

function returnStarts(numStarts) {
    var starts = "";

    for (var x = 1; x <= numStarts; x++) {
        starts += '<span name="start" id="' + x + '" class="glyphicon glyphicon-star"></span>';
    }

    for (var y = (numStarts + 1); y <= 5; y++) {
        starts += '<span name="start" id="' + y + '" class="glyphicon glyphicon-star-empty"></span>';
    }

    return starts;
}

function writeValoration() {
    if ($(this).val().length > 0) {
        $("[name='publishReview']").removeClass("disabled");
    } else {
        $("[name='publishReview']").addClass("disabled");
    }
}

function clearForm() {
    starts = 1;
    
    $("[name='starts']").html("<span name='start' id='1' class='glyphicon glyphicon-star'></span><span name='start' id='2' class='glyphicon glyphicon-star-empty'></span><span name='start' id='3' class='glyphicon glyphicon-star-empty'></span><span name='start' id='4' class='glyphicon glyphicon-star-empty'></span><span name='start' id='5' class='glyphicon glyphicon-star-empty'></span>");
    $("[name='start']").on("click", pointStart);
    $("[name='review']").val("");

    if (!$([name = 'publishReview']).hasClass("disabled")) {
        $("[name='publishReview']").addClass("disabled");
    }
}

(function ($) {
    $("[name='start']").on("click", pointStart);
    $("[name='review']").on("keyup", writeValoration);
    $("[name='cancelReview']").on("click", clearForm);
    $("[name='publishReview']").on("click", publishValoration);
})(jQuery);
