@extends('layouts.app')
@section('content')
    @include('data.client.editClientInfo')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('add_client')}}">Add Client</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-search"></i>
                        <span>CREATE NEW CLIENT</span>
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
                    <h4 class="page-header">CLIENT DATA</h4>
                    <div id="clientmessages" class="hide" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div id="clientmessages_content">
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" id="frm-create-client" action="{{route('createClient')}}">
                        <div class="form-group has-success">
                            <label class="col-sm-2 control-label">Client Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="client_name" name="client_name"required>
                            </div>
                            <label class="col-sm-2 control-label">Office Desc</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="client_office_desc" name="client_office_desc" data-toggle="tooltip" required>
                            </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Head office</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="client_head_office" name="client_head_office" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                            </div>
                            <label class="col-sm-2 control-label">Client Number</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="client_number" name="client_number" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success btn-sm">Create Client</button>
                                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-linux"></i>
                        <span>CLIENTS LIST</span>
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
                <div class="box-content no-padding" id="add-client-info">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('additional_script')
    <script type="text/javascript">
        showClientInfo();
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
        })

        $('#frm-create-client').on('submit',function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,data,function (data) {
                showClientInfo(data.client_name);
            })
            $(this).trigger('reset');
            $('#clientmessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
            $('#clientmessages_content').html('<h4>Client Created Successfully</h4>');
            $('#modal').modal('show');
        });

        function showClientInfo()
        {
            var data = $('#frm-create-client').serialize();
            console.log(data);
            $.get("{{route('showClientInfo')}}",data,function (data) {
                $('#add-client-info').empty().append(data);
            })
        }
        $(document).on('click','.class-edit',function (e) {
            $('#client-show').modal('show');
            client_id = $(this).val();
            $.get("{{route('editClient')}}",{client_id:client_id},function (data) {

                $('#client_name_edit').val(data.client_name);
                $('#client_office_desc_edit').val(data.client_office_desc);
                $('#client_head_office_edit').val(data.client_head_office);
                $('#client_number_edit').val(data.client_number);
                $('#client_id_edit').val(data.client_id);


            })
        })
        $('.btn-update-client').on('click',function (e) {
            e.preventDefault();
            var data = $('#frm-update-client').serialize();
            $.post("{{route('updateClient')}}", data, function (data) {
                showClientInfo(data.client_name);
            })
            $('#clientupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
            $('#clientupdatemessages_content').html('<h4>Client updated successfully</h4>');
            $('#modal').modal('show');
            $('#frm-update-class').trigger('reset');
        })
        $(document).on('click','.del-class',function (e) {
            client_id = $(this).val();
            $.post("{{route('deleteClient')}}",{client_id:client_id},function(data){
                showClientInfo($('#client_name').val());
            })
        })


    </script>
@endsection
