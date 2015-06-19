//Cargar autocompletado en el buscador
$(function () {
    $("[name='search']").keyup(function () {
        $.post("core/ajax/getSearch.php", {"value": $(this).val()},
        function (data) {
            var films = JSON.parse(data);
            $("[name='search']").autocomplete({
                source: films,
                select: function (event, ui) {
                    $("[name='search']").val(ui.item.label);
                    $("#btnSearch").click();
                }
            });
        }
        );
    });
});