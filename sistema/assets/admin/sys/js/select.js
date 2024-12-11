var _select = {};
_select.cargo_equipe = function(elemento) {
    $(elemento).select2({
        minimumInputLength: 0,
        ajax: {
            type: "POST",
            url: base_url + 'Equipe/jsonCargo',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    titulo: params
                };
            },
            results: function (data) {
                var results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.titulo
                    });
                });
                return {
                    results: results
                };
            },
        },
        initSelection : function (element, callback) {
            if($(element).val()) {
                var data = {id: $(element).val(), text: $(element).attr('data-nome')};
            }else{
                var data = {id: '', text: 'Selecione o cargo'};
            }
            callback(data);
        },
    });

};
_select.depoimento_tipo = function(elemento) {
    $(elemento).select2({
        minimumInputLength: 0,
        ajax: {
            type: "POST",
            url: base_url + 'Depoimento/jsonTipo',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    nome: params
                };
            },
            results: function (data) {
                var results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.titulo
                    });
                });
                return {
                    results: results
                };
            },
        },
        initSelection : function (element, callback) {
            if($(element).val()) {
                var data = {id: $(element).val(), text: $(element).attr('data-nome')};
            }else{
                var data = {id: '', text: 'Selecione o tipo de depoimento'};
            }
            callback(data);
        },
    });

};
_select.ensino = function(elemento) {
    $(elemento).select2({
        minimumInputLength: 0,
        placeholder: {
            id: "-1",
            text: "Select an option",
            selected:'selected'
        },
        allowClear:true,
        ajax: {
            type: "POST",
            url: base_url + 'Ensino/json',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    nome: params,
                    tipo: $(elemento).attr('data-tipo')
                };
            },
            results: function (data) {
                var results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.titulo
                    });
                });
                return {
                    results: results
                };
            },
        },
        initSelection : function (element, callback) {
            if($(element).val()) {
                var data = {id: $(element).val(), text: $(element).attr('data-nome')};
            }else{
                var data = {id: '', text: 'Selecione o ensino'};
            }
            callback(data);
        },
    });

};