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
        var vesseldata = $('#vessel_choose').val()
        $('#vessel').val(vesseldata);
        var clientdata = $('#client_choose').val()
        $('#client').val(clientdata);
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
            $('#tarrif-type').append($('<option>').text(value.tarrif_type_name).attr('value', value.tarrif_type_id));
        });
    });
    ;
    showTarrifTypeModal();
});


$(document).on('change', '.trigger-tarrif-params', function (e) {
    e.preventDefault();
    var key = $('#tarrif-type').val();
    $.get('/api/tarrif-params', {type: key}, function (data) {
        console.log(data);
        $('#tarrif-params').html($('<option>').text('CHOOSE TARRIF PARAMETER'));
        $.each(data, function (i, value) {
            console.log(value.tarrif_param_name);
            $('#tarrif-params').append($('<option>').text(value.tarrif_param_name).attr('value', value.tarrif_param_id));
        });
    });
    showTarrifParamModal();
});

$(document).on('change', '.trigger-tarrif-charges', function (e) {
    e.preventDefault();
    var key = $('#tarrif-params').val();
    var value = $('#tarrif-params option:selected').text();
    $('#tarrif-charge-param').val(value);
    $.get('/api/tarrif-charges', {param: key}, function (data) {
        console.log(data);
        data.tarrif_param_charge_type !== 'QUANTITY' ? $('.quantity').hide() : $('.quantity').show();

        $('#billable').html($('<option>').text('CHOOSE BILLING OPTION'));
        $('#tarrif-charge-cost').val(" ");
        $.each(data.charges, function (i, value) {
            console.log(value.billable);
            $('#billable').append($('<option>').text(value.billable).attr('value', value.tarrif_charge_id));
        });
    });
    showTarrifChargeModal();
});

$(document).on('change', '#billable', function (e) {
    e.preventDefault();
    var key = $('#billable').val();

    $.get('/api/bill-charge', {charge: key}, function (data) {
        console.log(data);
        $('#tarrif-charge-cost').val(data.cost);
    });
    showTarrifChargeModal();
});

// $(document).on('click', '.save-tarrif', function (e) {
//     e.preventDefault();
//     var client = $('.clients option:selected').text();
//     var vessel = $('.vessels option:selected').text();
//     var param = $('#tarrif-charge-param').val();
//     var billable = $('#billable option:selected').text();
//     var cost = $('#tarrif-charge-cost').val();
//     var quantity = $('#quantity').val();
//     var payload = {};
//     payload.client = client;
//     payload.vessel = vessel;
//     payload.param = param;
//     payload.billable = billable;
//     payload.cost = cost;
//     payload.quantity = quantity;
//
//     $.post('/api/save-invoice', {data: payload}, function (data) {
//         console.log(data);
//
//     });
//
// });

function showTarrifModal() {
    $('#tarrif-modal').modal('show');
}

function showTarrifTypeModal() {
    $('#tarrif-modal').modal('hide');
    $('#tarrif-type-modal').modal('show');
}

function showTarrifParamModal() {
    $('#tarrif-type-modal').modal('hide');
    $('#tarrif-param-modal').modal('show');
}

function showTarrifChargeModal() {
    $('#tarrif-param-modal').modal('hide');
    $('#tarrif-charge-modal').modal('show');
}

$(document).on('change keyup', '#quantity', function(){

    var fee = $('#tarrif-charge-cost').val();
    var qty = $('#quantity').val();
    //var vt = $('#vat').val();
    $('#actual_cost').val(parseFloat(fee)*parseFloat(qty));
});

$(document).on('change keyup', '#vat', function(){

    var fee = $('#tarrif-charge-cost').val();
    var qty = $('#quantity').val();
    var vatP =$('#vat').val() / 100;
    var tVat = fee * qty * vatP;
    var  tcost = (fee * qty) + tVat;
    $('#actual_cost').val(parseFloat(tcost));
});