$('#mark_id').change(function (ev) {
    ev.preventDefault();

    $.get('/mark/' + ev.target.value + '/models')
        .done(function(result) {
            var html = '';

            $.each(result, function (idx, model) {
                html += "<option value='" + model.id + "'>" + model.name + "</option>";
            });

            $('#model_id').html(html);
        })
        .fail(function (response) {
            console.log(response);
            $('#model_id').html('');
        });
});

$(document).ready(function (ev) {

    var markId = $('#mark_id').val();
    var modelId = $('#selected_model_id').val();
    if (markId) {
        $.get('/mark/' + markId + '/models')
            .done(function(result) {
                var html = '';

                $.each(result, function (idx, model) {
                    var selected = modelId == model.id ? 'selected' : '';
                    html += "<option value='" + model.id + "'" + selected + ">" + model.name + "</option>";
                });

                $('#model_id').html(html);
            })
            .fail(function (response) {
                console.log(response);
                $('#model_id').html('');
            });
    }
});