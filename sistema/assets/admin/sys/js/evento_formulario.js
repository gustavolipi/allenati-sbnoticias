$(document).ready(function () {


    $('[name=data]')
        .mask("99/99/9999 99:99:99",{placeholder:"00/00/0000 00:00:00"});

    $('#summernote').summernote({
        height: 350
    });

});
