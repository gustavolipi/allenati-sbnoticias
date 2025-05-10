$(document).ready(function () {
    _select.depoimento_tipo('#depoimento_tipo_id');
    _select.ensino('#ensino_id');

    $('.summernote').summernote({
        height: 350
    });
});
/*
$('#ensino_id').on('change', function(){
    if($(this).val() != ''){
        $('#linha_destaque').hide();
    }else{
        $('#linha_destaque').show();
    }
});
*/
$('#destaque').on('change', function(){
    if($(this).val() == '1'){
        $('#box_destaque').show();
        $('#label_descricao').html('Depoimento <br><small>150 caracteres</small>');
        $('#descricao').attr('maxlength', '150');
    }else{
        $('#box_destaque').hide();
        $('#label_descricao').html('Depoimento');
        $('#descricao').removeAttr('maxlength');
    }
});