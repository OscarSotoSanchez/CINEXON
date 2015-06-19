//javascript encargado de añadir a las listas
function addFilmList() {
    var idList = $("[name='codList'] option:selected").val();
    var nombreLista = $("[name='codList'] option:selected").html();
    var idMovie = $("[name='codMovie']").val();
        
    $.post("core/ajax/addFilmList.php", {'idMovie': idMovie, 'idList': idList},
    function () {
        
        messagePopUp("Película añadida a la lista '" + nombreLista + "' correctamente.");
        
        $("[name='codList'] option:selected").remove();
        
        if($("[name='codList']").children().length === 0){
            $("[name='divAddList']").html('<p class="text-center text-muted">No tienes listas disponibles.</p>');
        }
    });

}

jQuery(document).ready(function ($) {
    $("[name='addList']").click(addFilmList);
});
