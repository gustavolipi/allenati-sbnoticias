$('#plano').on("change", function(){
    if($(this).val() == 'ouro'){
        $('#sociais-ouro').show();
    }else{
        $('#sociais-ouro').hide();
    }
    if($(this).val() == 'bronze'){
        $('#boxLogo').hide();
    }else{
        $('#boxLogo').show();
    }
});