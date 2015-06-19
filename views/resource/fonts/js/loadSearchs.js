//Cargar autocompletado en el buscador
$(function () {
    $.post("php/ajax/getSearch.php",
            function (data) {
                var films = JSON.parse(data);
                $("[name='search']").autocomplete({
                    source: films
                });
            }
    );
});