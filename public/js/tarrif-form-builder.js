/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.add-tarrif', function (e) {
    console.log('add tarrif event');
    e.preventDefault();
    showTarrifModal();

});

$(document).on('change', '.trigger-tarrif-type', function (e) {
    console.log('tarrif type trigger called');
    e.preventDefault();
    triggerTarrifType();

});

function showTarrifModal() {
    $('#tarrif-modal').modal('show');
}

function triggerTarrifType() {
    $('#tarrif-modal').modal('hide');
    $('#tarrif-type-modal').modal('show');
}