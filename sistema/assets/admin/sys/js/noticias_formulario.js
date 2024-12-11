$(document).ready(function () {

    $('[name=hora]').mask("99:99",{placeholder:"00:00"});

    $("#summernote").summernote({
        height: 300,
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0],editor,welEditable);
        }
    })

    function sendFile(file, editor, welEditable) {
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: "POST",
            url: base_url + "Midia/uploads",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                editor.insertImage(welEditable, url);
            }
        });
    }
});
