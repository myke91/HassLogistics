@extends('layouts.app')
@section('content')
    @include('tarrif.tarrif_charges.edit_tarrif_charge')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('getTarrifChargeForm')}}">Add Tarrif Charge</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>CREATE NEW TARRIF CHARGE</span>
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
                <h4 class="page-header">TARRIF CHARGE TYPE</h4>
                <div id="clientmessages" class="hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="clientmessages_content">
                    </div>
                </div>
                <form class="form-horizontal" role="form" id="frm-create-tarrif-charge" action="{{route('saveTarrifCharge')}}">
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Tarrif Param</label>
                        <div class="col-sm-4">
                            <select class="s2" id="tarrif-param-id" name="tarrif_param_id">
                                <option></option>
                                @foreach($tarriParams as $key =>$t)
                                    <option value="{{$t->tarrif_type_id}}">{{$t->tarrif_param_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Billable</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="billable" name="billable" required>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Cost</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="cost" name="cost" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm">Save Tarrif Charge</button>
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
                        <span>TARRIF CHARGES LIST</span>
                    </div>
                    <div class="box-icons">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="expand-link">
                            <i class="fa fa-expand"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                    <div class="no-move"></div>
                </div>
                <div class="box-content no-padding">
                    <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
                    <thead>
                    <tr>
                        <th>Tarrif Param Name</th>
                        <th>Billable</th>
                        <th>Cost</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tarrifCharges as $key => $t)
                        <tr>
                            <td>{{$t->tarrif_param_name}}</td>
                            <td>{{$t->billable}}</td>
                            <td>{{$t->cost}}</td>
                            <td class="del">
                                <Button value="{{$t->tarrif_charge_id}}" class="charge-edit"><i class="fa fa-pencil-square-o"></i></Button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>


            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_script')
<script type="text/javascript">
    // Run Datables plugin and create 3 variants of settings
    function DemoSelect2() {
        $('.s2').select2({placeholder: "Select"});
    }
    // Run Datables plugin and create 3 variants of settings
    function AllTables(){
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
    function MakeSelect2(){
        $('select').select2();
        $('.dataTables_filter').each(function(){
            $(this).find('label input[type=text]').attr('placeholder', 'Search');
        });
    }
    $(document).ready(function() {
        // Load Datatables and run plugin on tables
        LoadDataTablesScripts(AllTables);
        // Add Drag-n-Drop feature
        WinMove();
    });
    $(document).ready(function () {

        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
    })

    $('#frm-create-tarrif-charge').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url, data, function (data) {
            var validate = confirm("Tarrif Params Save successfully");
            if (validate === true) {
                location.reload();
            }
            else {
                return false;
            }
        });

    });

    $(document).on('click', '.charge-edit', function (e) {
        console.log('dataclicked');
        $('#tarrif-charge-show').modal('show');
        var tarrif_charge_id = $(this).val();
        $.get("{{route('editTarrifCharge')}}", {tarrif_charge_id: tarrif_charge_id}, function (data) {
            $('#tarrif-param-id-edit').val(data.tarrif_param_id);
            $('#billable-edit').val(data.billable);
            $('#cost-edit').val(data.cost);
            $('#tarrif-charge-id-edit').val(data.tarrif_charge_id);

        });
    });
    $('.btn-update-tarrif-charge').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-tarrif-charge').serialize();
        var updateTarrif =$.post("{{route('updateTarrifCharge')}}", data, function (data) {
        });
        // if (updateTarrif==true) {
        $('#tarrifupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#tarrifupdatemessages_content').html('<h4>Tarrif Param updated successfully</h4>');
        $('#modal').modal('show');
        $('#tarrif-charge-show').modal('hide');
        location.reload();
        // }else{
        //  return false;
        // }
    });



</script>
@endsection
