/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
showVesselInfo();
$('#arrival_date').datepicker({
    dateFormat: 'yy-mm-dd'
});
$('#departure_date').datepicker({
    dateFormat: 'yy-mm-dd'
});

$('#add-more').on('click', function () {
    $('#vesseloperator-show').modal();
});

$('#arrival_date').datepicker({
    dateFormat: 'yy-mm-dd'
});
$('#departure_date').datepicker({
    dateFormat: 'yy-mm-dd'
});
$('.add-more-operator').on('click', function () {
    $('#vesseloperator-show').modal();
});
$('.add-more-client').on('click', function () {
    $('#client-modal').modal();
});

$('.create-client').on('click', function (e) {
    e.preventDefault();
    console.log('received click event for additional client creation');
    var data = $("#frm-create-client").serialize();
    var url = $("#frm-create-client").attr('action');
    $.post(url, data, function (data) {
        $('#vessel_owner').append($("<option/>", {
            value: data.client_id,
            text: data.client_name
        }));
    });
    $('#client-modal').modal('hide');
});

$('.btn-save-vesseloperator').on('click', function () {
    var vesseloperators = $('#vessel_operator').val();
    console.log(vesseloperators);
    $.post("{{route('postVesseOperator')}}", {operator_name: vesseloperators}, function (data) {
        $('#vessel_operator_id').append($("<option/>", {
            value: data.vessel_operator_id,
            text: data.operator_name
        }));
        $('#vessel_operator').val("");
    });
    $('#vesseloperator-show').modal('hide');
});
$('#frm-create-vessel').on('submit', function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    $.post(url, data, function (data) {
        showVesselInfo(data.vessel_name);
    });
    $('#createvesselmessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
    $('#createvesselmessages_content').html('<h4>Vessel Created Successfully</h4>');
    $('#modal').modal('show');
//        $(this).trigger('reset');
});


function showVesselInfo()
{
    var data = $('#frm-create-vessel').serialize();
    $.get("{{route('showVesselInfo')}}", data, function (data) {
        $('#add-vessel-info').empty().append(data);
    });
}

$(document).on('click', '.class-edit', function (e) {
    $('#vessel-show').modal('show');
    vessel_id = $(this).val();
    $.get("{{route('editVessel')}}", {vessel_id: vessel_id}, function (data) {

        $('#vessel_name_edit').val(data.vessel_name);
        $('#vessel_callsign_edit').val(data.vessel_callsign);
        $('#vessel_type_edit').val(data.vessel_type);
        $('#vessel_class_edit').val(data.vessel_class);
        $('#vessel_flag_edit').val(data.vessel_flag);
        $('#vessel_operator_id_edit').val(data.vessel_operator_id);
        $('#vessel_owner_edit').val(data.vessel_owner);
        $('#vessel_LOA_edit').val(data.vessel_LOA);
        $('#arrival_date_edit').val(data.arrival_date);
        $('#departure_date_edit').val(data.departure_date);
        $('#vessel_id_edit').val(data.vessel_id);
    });
});
$('.btn-update-vessel').on('click', function (e) {
    e.preventDefault();
    var data = $('#frm-update-vessel').serialize();
    $.post("{{route('updateVessel')}}", data, function (data) {
        showVesselInfo(data.vessel_name);
    });
    $('#updatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
    $('#updatemessages_content').html('<h4>Vessel updated successfully</h4>');
    $('#modal').modal('show');
    $('#frm-update-class').trigger('reset');
});
$(document).on('click', '.del-class', function (e) {
    vessel_id = $(this).val();
    $.post("{{route('deleteVessel')}}", {vessel_id: vessel_id}, function (data) {
        showVesselInfo($('#vessel_name').val());
    });
});

$('.search-vessel').on('click', function (e) {
    e.preventDefault();
    var name = $('#vessel-search-field').val();
    console.log(name);
    $.get('/api/vessel-search', {vessel_name: name}, function (data) {
        console.log(data);
        console.log(data.length);
        if (data.length !== 0) {
            if (data.length === 1) {
                $('#vessel_name').val(data[0].vessel_name);
                $('#vessel_callsign').val(data[0].vessel_callsign);
                $('#vessel_class').val(data[0].vessel_class);
                console.log('vessel operator value ' + data[0].vessel_operator_id);
                $('#vessel_operator select').val(data[0].vessel_operator_id);
                $('#vessel_type').val(data[0].vessel_type);
                $('#vessel_flag select').val(data[0].vessel_flag);
                $('#vessel_loa').val(data[0].vessel_loa);
                $('#vessel_owner').val(data[0].vessel_owner);
                $('#arrival_date').val(data[0].arrival_date);
                $('#departure_date').val(data[0].departure_date);
                $('#imo').val(data[0].imo);
                $('#reg_place').val(data[0].reg_place);
                $('#construction_year').val(data[0].construction_year);
                $('#crew').val(data[0].crew);
                $('#reg_year').val(data[0].reg_year);
                $('#homeport').val(data[0].homeport);
                $('#tonnage_certificate').val(data[0].tonnage_certificate);
                $('#mmsi').val(data[0].mmsi);
                $('#isps_no').val(data[0].isps_no);
                $('#ice_class').val(data[0].ice_class);
                $('#dwt').val(data[0].dwt);
                $('#sbt').val(data[0].sbt);
                $('#air_draft').val(data[0].air_draft);
                $('#ll').val(data[0].ll);
                $('#gt').val(data[0].gt);
                $('#loa').val(data[0].loa);
                $('#knots').val(data[0].knots);
                $('#ftc').val(data[0].ftc);
                $('#nt').val(data[0].nt);
                $('#beam').val(data[0].beam);
                $('#cbm_tank').val(data[0].cbm_tank);
                $('#rgt').val(data[0].rgt);
                $('#max_draft').val(data[0].max_draft);
                $('#g_factor').val(data[0].g_factor);
                data[0].double_bottom === 'on' ? $('#double_bottom').prop('checked', true) : $('#double_bottom').prop('checked', false);
                data[0].double_skin === 'on' ? $('#double_skin').prop('checked', true) : $('#double_skin').prop('checked', false);
                data[0].double_sides === 'on' ? $('#double_sides').prop('checked', true) : $('#double_sides').prop('checked', false);
                data[0].bow_thrusters === 'on' ? $('#bow_thrusters').prop('checked', true) : $('#bow_thrusters').prop('checked', false);
                data[0].stern_thrusters === 'on' ? $('#stern_thrusters').prop('checked', true) : $('#stern_thrusters').prop('checked', false);
                data[0].annual_fee === 'on' ? $('#annual_fee').prop('checked', true) : $('#annual_fee').prop('checked', false);
                data[0].inactive === 'on' ? $('#inactive').prop('checked', true) : $('#inactive').prop('checked', false);
            } else {
                vesselSearchPopup(data);
            }
        }
    });
});


function vesselSearchPopup(data) {
    console.log('showing result in popup');

    $.each(data, function (i, item) {
        var $tr = $('<tr>').append(
                $('<td>').text(item.vessel_name),
                $('<td>').text(item.vessel_type),
                $('<td>').text(item.tonnage_certificate),
                $('<td>').html('<button class="btn btn-primary load-vessel" value="' + item.vessel_id + '">LOAD</button>')
                ).appendTo('#vessel_results');
//        console.log($tr.wrap('<p>').html());
    });
    $('#vessel_search_result').modal('show');
}

$(document).on('click', '.load-vessel', function (e) {
    vessel_id = $(this).val();
    $.get("/api/vessel-detail", {vessel_id: vessel_id}, function (data) {
        $('#vessel_search_result').modal('hide');

        $('#vessel_name').val(data.vessel_name);
        $('#vessel_callsign').val(data.vessel_callsign);
        $('#vessel_class').val(data.vessel_class);
        $('#vessel_operator option:selected').val(data.vessel_operator);
        $('#vessel_type').val(data.vessel_type);
        $('#vessel_flag select').val(data.vessel_flag);
        $('#vessel_loa').val(data.vessel_loa);
        $('#vessel_owner').val(data.vessel_owner);
        $('#arrival_date').val(data.arrival_date);
        $('#departure_date').val(data.departure_date);
        $('#imo').val(data.imo);
        $('#reg_place').val(data.reg_place);
        $('#construction_year').val(data.construction_year);
        $('#crew').val(data.crew);
        $('#reg_year').val(data.reg_year);
        $('#homeport').val(data.homeport);
        $('#tonnage_certificate').val(data.tonnage_certificate);
        $('#mmsi').val(data.mmsi);
        $('#isps_no').val(data.isps_no);
        $('#ice_class').val(data.ice_class);
        $('#dwt').val(data.dwt);
        $('#sbt').val(data.sbt);
        $('#air_draft').val(data.air_draft);
        $('#ll').val(data.ll);
        $('#gt').val(data.gt);
        $('#loa').val(data.loa);
        $('#knots').val(data.knots);
        $('#ftc').val(data.ftc);
        $('#nt').val(data.nt);
        $('#beam').val(data.beam);
        $('#cbm_tank').val(data.cbm_tank);
        $('#rgt').val(data.rgt);
        $('#max_draft').val(data.max_draft);
        $('#g_factor').val(data.g_factor);
        data.double_bottom === 'on' ? $('#double_bottom').prop('checked', true) : $('#double_bottom').prop('checked', false);
        data.double_skin === 'on' ? $('#double_skin').prop('checked', true) : $('#double_skin').prop('checked', false);
        data.double_sides === 'on' ? $('#double_sides').prop('checked', true) : $('#double_sides').prop('checked', false);
        data.bow_thrusters === 'on' ? $('#bow_thrusters').prop('checked', true) : $('#bow_thrusters').prop('checked', false);
        data.stern_thrusters === 'on' ? $('#stern_thrusters').prop('checked', true) : $('#stern_thrusters').prop('checked', false);
        data.annual_fee === 'on' ? $('#annual_fee').prop('checked', true) : $('#annual_fee').prop('checked', false);
        data.inactive === 'on' ? $('#inactive').prop('checked', true) : $('#inactive').prop('checked', false);
    });
});