//Javascript encargado de las descargas
(function ($) {
    $("[name='downloadFILM']").on("click", function () {
        var id = $(this).attr("id");
        $("[name='iframeDownload']").attr('src', 'core/ajax/downloadFilm.php?idMovie=' + id);
    });
    $("[name='downloadPDF']").on("click", function () {
        var id = $(this).attr("id");
        $("[name='iframeDownload']").attr('src', 'core/ajax/downloadPDF.php?idBuy=' + id);
    });
})(jQuery);