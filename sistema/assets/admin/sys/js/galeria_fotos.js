//UPLOAD DE FOTOS DO CLASSIDICADOS
url_a = window.location.pathname;
url_a = url_a.split("/galeria/fotos/")[1];

if (url_a) {
    $("#multipleupload").uploadFile({
        url: base_url + "galeria/uploadFotos/" + url_a,
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
        url: base_url + "galeria/carregarfotos",
        data: {'GALERIA': classificados},
        dataType: "json",
        success: function (j) {
            var html = '';

            for (var i = 0; i < j.length; i++) {

                var btn_foto_capa = (j[i].capa == '1' ? 'green' : 'btn-default');

                html += '    <div class="col-md-2 text-center">';
                html += '        <div class="well" style="overflow: hidden">';
                html += '           <div class="btn-group btn-group btn-group-justified">';
                html += '               <a alt="Excluir" title="Excluir" onclick="excluir_imagem(' + j[i].ID + ', ' + j[i].GALERIA + ')" class="btn red">';
                html += '                   <i class="fa fa-trash-o"></i>';
                html += '               </a>';
                html += '               <a alt="Legenda" title="Legenda" onclick="legenda_imagem(' + j[i].ID + ', ' + j[i].GALERIA + ')" class="btn blue">';
                html += '                   <i class="fa fa-comment"></i>';
                html += '               </a>';
                html += '               <a alt="Foto da Capa" title="Foto da Capa" onclick="foto_capa(' + j[i].ID + ', ' + j[i].GALERIA + ')" class="btn '+btn_foto_capa+'">';
                html += '                   <i class="fa fa-asterisk"></i>';
                html += '               </a>';
                html += '           </div>';
                html += '            <img src="' + url_tikers + 'revista/galerias/gal' + j[i].GALERIA + '/' + j[i].ARQUIVO + '" data-holder-rendered="true" style=" height: 140px" >';
                html += '        </div>';
                html += '    </div>';
            }

            $("div").remove(".ajax-file-upload-statusbar");
            $("#fotos_enviadas").html(html);
        }
    });
}

function legenda_imagem(imagem, galeria) {

    $.ajax({
        type: "POST",
        url: base_url + "galeria/legendafoto",
        data: {'id': imagem},
        dataType: "json",
        success: function (j) {

            for (var i = 0; i < j.length; i++) {
                $("input[name='legenda']").val(j[i].LEGENDA);
                $("input[name='id']").val(imagem);
                $("input[name='galeria']").val(galeria);

                $("#legendaModal").modal('show');
            }

        }
    });

}

function excluir_imagem(imagem, galeria) {

    var r = confirm("Deseja realmente excluir essa imagem, isso sera irreversÍvel!");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "galeria/excluirfoto",
            data: {'id': imagem},
            success: function (j) {
                atualizar_imagens(galeria);
            }
        });

    }
}

function foto_capa(imagem, galeria) {

        $.ajax({
            type: "POST",
            url: base_url + "galeria/fotocapa",
            data: {'id': imagem, 'galeria_id': galeria},
            success: function (j) {
                atualizar_imagens(galeria);
            }
        });
}

$(document).ready(function () {
    atualizar_imagens(url_a);
})