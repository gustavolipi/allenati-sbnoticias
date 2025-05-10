$(document).ready(function () {
    carregarPreview($('#colunas').attr('data-colunas'));
    $('#colunas').on('change', function () {
        carregarPreview($(this).val());
    })
    function carregarPreview(colunas){
        $.ajax({
            type: "POST",
            url: base_url + "capa/carregarPreview",
            data: {'colunas': colunas},
            dataType: "html",
            success: function (retorno) {
                $("#load_preview").html(retorno);
            }
        });
    }
});
