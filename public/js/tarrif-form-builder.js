/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.add-tarrif', function (e) {
    e.preventDefault();
    console.log('add tarrif event');
    $.get('/api/tarrifs', function (data) {
        console.log(data);
        $('#tarrif-name').html($('<option>').text('CHOOSE TARRIF'));
        $.each(data, function (i, value) {
            console.log(value.tarrif_name);
            $('#tarrif-name').append($('<option>').text(value.tarrif_name).attr('value', value.tarrif_id));
        });
    });
    showTarrifModal();
});
$(document).on('change', '.trigger-tarrif-type', function (e) {
    e.preventDefault();
    var key = $('#tarrif-name').val();
    $.get('/api/tarrif-types', {tarrif: key}, function (data) {
        console.log(data);
        $('#tarrif-type').html($('<option>').text('CHOOSE TARRIF TYPE'));
        $.each(data, function (i, value) {
            console.log(value.tarrif_name);
            $('#tarrif-type').append($('<option>').text(value.tarrif_type_name).attr('key', value.tarrif_type_id));
        });
    });
    ;
    showTarrifTypeModal();
});
function showTarrifModal() {
    $('#tarrif-modal').modal('show');
}

function showTarrifTypeModal() {
    $('#tarrif-modal').modal('hide');
    $('#tarrif-type-modal').modal('show');
}