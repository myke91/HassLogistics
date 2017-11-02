@extends('layouts.app')
@section('content')
@include('popups.vesseloperator')
@include('popups.client')
@include('data.vessel.editVesselInfo')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('add_vessel')}}">Add Vessel</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>CREATE NEW VESSEL</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <h4 class="page-header">VESSEL DATA</h4>
                <div id="createvesselmessages" class="hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="createvesselmessages_content">
                    </div>
                </div>
                <form class="form-horizontal" role="form" id="frm-create-vessel" action="{{route('postCreateVessel')}}">
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Vessel Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_name" name="vessel_name" data-toggle="tooltip" data-placement="bottom" title="Tooltip for name" required>
                        </div>
                        <label class="col-sm-2 control-label">Vessel Callsign</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_callsign" name="vessel_callsign" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                        </div>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel Class</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="vessel_class" name="vessel_class" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                        </div>
                        <label class="col-sm-2 control-label">Vessel Operator</label>
                        <div class="col-sm-2">
                            <select id="vessel_operator_id" name="vessel_operator_id" class="populate placeholder">
                                <option>--------</option>
                                @foreach($vesseloperator as $key =>$v)
                                <option value="{{$v->vessel_operator_id}}">{{$v->operator_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="fa fa-plus txt-warning form-control-feedback add-more-operator"></span>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel Type</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_type" name="vessel_type" >
                        </div>

                        <label class="col-sm-2 control-label">Vessel Flag</label>
                        <div class="col-sm-4">
                            <select id="vessel_flag" name="vessel_flag" class="populate placeholder">
                                <option>--------</option>
                                <option>Linux</option>
                                <option>Windows</option>
                                <option>OpenSolaris</option>
                                <option>FirefoxOS</option>
                                <option>MeeGo</option>
                                <option>Android</option>
                                <option>Sailfish OS</option>
                                <option>Plan9</option>
                                <option>DOS</option>
                                <option>AIX</option>
                                <option>HP/UP</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group has-success has-feedback">

                        <label class="col-sm-2 control-label">Vessel LOA</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_LOA" name="vessel_LOA" data-toggle="tooltip" data-placement="top">
                        </div>

                        <label class="col-sm-2 control-label">Vessel Owner</label>
                        <div class="col-sm-2">
                            <select id="vessel_owner" name="vessel_owner" class="populate placeholder">
                                <option>--------</option>
                                @foreach($clients as $key =>$v)
                                <option value="{{$v->client_id}}">{{$v->client_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="fa fa-plus txt-warning form-control-feedback add-more-client"></span>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel Arrival Date</label>
                        <div class="col-sm-4">
                            <input type="text" id="arrival_date" name="arrival_date" class="form-control" placeholder="Date">
                            <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                        </div>
                        <label class="col-sm-2 control-label">Vessel Departure Date</label>
                        <div class="col-sm-4">
                            <input type="text" id="departure_date" name="departure_date" class="form-control" placeholder="Date">
                            <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                        </div>
                    </div>                                                                                
                    <div class="clearfix"></div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm">Create Vessel</button>
                        <!-- <button type="button" class="btn btn-success btn-sm  btn-update-class">Update Course</button>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------->
<!--
DISPLAY TABLE
-->
<!--------------------------------------------------------------------->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-linux"></i>
                    <span>VESSEL LIST</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>

                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content no-padding" id="add-vessel-info">

            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_script')
<script type="text/javascript">
    showVesselInfo();
// Run Select2 plugin on elements
    function DemoSelect2() {
        $('#s2_with_tag').select2({placeholder: "Select OS"});
        $('#s2_country').select2();
    }
// Run timepicker
    function DemoTimePicker() {
        $('#input_time').timepicker({setDate: new Date()});
    }
    // Run Datables plugin and create 3 variants of settings
    function AllTables() {
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
    function MakeSelect2() {
        $('select').select2();
        $('.dataTables_filter').each(function () {
            $(this).find('label input[type=text]').attr('placeholder', 'Search');
        });
    }
    $(document).ready(function () {
        // Initialize datepicker
        $('#arrival_date').datepicker({setDate: new Date()});
        $('#departure_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Load Datatables and run plugin on tables 
        LoadDataTablesScripts(AllTables);
        dateFormat:'yy-mm-dd'
        // Add drag-n-drop feature to boxes
        WinMove();
    });

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
            $('#client_id').append($("<option/>", {
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
        $(this).trigger('reset');
    })


    function showVesselInfo()
    {
        var data = $('#frm-create-vessel').serialize();
        $.get("{{route('showVesselInfo')}}", data, function (data) {
            $('#add-vessel-info').empty().append(data);
        })
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


        })
    })
    $('.btn-update-vessel').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-vessel').serialize();
        $.post("{{route('updateVessel')}}", data, function (data) {
            showVesselInfo(data.vessel_name);
        })
        $('#updatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#updatemessages_content').html('<h4>Vessel updated successfully</h4>');
        $('#modal').modal('show');
        $('#frm-update-class').trigger('reset');
    })
    $(document).on('click', '.del-class', function (e) {
        vessel_id = $(this).val();
        $.post("{{route('deleteVessel')}}", {vessel_id: vessel_id}, function (data) {
            showVesselInfo($('#vessel_name').val());
        })
    })


</script>
@endsection
