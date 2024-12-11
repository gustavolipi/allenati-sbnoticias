//UPLOAD DE FOTOS DO CLASSIDICADOS
url_a = window.location.pathname;
url_a = url_a.split("/infraestrutura/fotos/")[1];

if (url_a) {
    $("#multipleupload").uploadFile({
        url: base_url + "infraestrutura/uploadFotos/" + url_a,
        multiple: true,
        fileName: "myfile",
        afterUploadAll: function () {
            //location.reload();
            atualizar_imagens(url_a);
        }
    });
}

//IMAGENS
function atualizar_imagens(classificados) {
    $.ajax({
        type: "POST",
        url: base_url + "infraestrutura/carregarfotos",
        data: {'infraestrutura_id': classificados},
        dataType: "json",
        success: function (j) {
            var html = '';

            for (var i = 0; i < j.length; i++) {
                html += '    <div class="col-md-2 text-center">';
                html += '        <div class="well">';
                html += '           <div class="btn-group btn-group btn-group-justified">';
                html += '               <a alt="Excluir" title="Excluir" onclick="excluir_imagem(' + j[i].id + ', ' + j[i].galeria_id + ')" class="btn red">';
                html += '                   <i class="fa fa-trash-o"></i>';
                html += '               </a>';
                html += '           </div>';

                html += '            <img src="' + base_site + '/assets/img/infraestrutura/' + j[i].arquivo + '" data-holder-rendered="true" style=" height: 140px" class="img-thumbnail  img-responsive">';
                html += '        </div>';
                html += '    </div>';
            }

            $("div").remove(".ajax-file-upload-statusbar");
            $("#fotos_enviadas").html(html);
        }
    });
}

function legenda_imagem(imagem, noticia) {

    $.ajax({
        type: "POST",
        url: base_url + "infraestrutura/galerialegendafoto",
        data: {'id': imagem},
        dataType: "json",
        success: function (j) {

            for (var i = 0; i < j.length; i++) {
                $("input[name='legenda']").val( j[i].legenda );
                $("input[name='credito']").val( j[i].credito );
                $("input[name='id']").val( imagem );
                $("input[name='noticia']").val( noticia );

                $("#legendaModal").modal('show');
            }

        }
    });

}

function excluir_imagem(imagem, noticia) {

    var r = confirm("Deseja realmente excluir essa imagem, isso sera irreversÍvel!");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "infraestrutura/excluirfoto",
            data: {'id': imagem},
            success: function (j) {
                atualizar_imagens(noticia);
            }
        });

    }
}

$(document).ready(function () {
    atualizar_imagens(url_a);
})