@extends('layouts.app')
@section('content')
@include('tarrif.tarrif_params.edit_tarrif_param')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('getTarrifParamForm')}}">Add Tarrif Param</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>CREATE NEW TARRIF PARAM</span>
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
                <h4 class="page-header">TARRIF PARAM</h4>
                <div id="clientmessages" class="hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="clientmessages_content">
                    </div>
                </div>
                <form class="form-horizontal" role="form" id="frm-create-tarrif-param" action="{{route('saveTarrifParam')}}">
                    <div class="form-group has-success">
                        <label class="col-sm-4 control-label">Tarrif Type</label>
                        <div class="col-sm-4">
                            <select id="tarrif-type-id" name="tarrif_type_id" class="s2 populate placeholder" required>
                                <option></option>
                                @foreach($tarrifTypes as $key =>$t)
                                    <option value="{{$t->tarrif_param_id}}">{{$t->tarrif_type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-4 control-label">Tarrif Param Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tarrif-param-code" name="tarrif_param_code" required>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-4 control-label">Tarrif Param Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tarrif_param_name" name="tarrif_param_name" required>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-4 control-label">Tarrif Param Charge Type</label>
                        <div class="col-sm-4">
                            <select id="tarrif-param-charge-type" name="tarrif_param_charge_type" class="s2 populate placeholder" required>
                                <option>QUANTITY</option>
                                <option>SPECIFICS</option>
                                <option>HYBRID</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-4 control-label">Tarrif Param Remarks</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tarrif-param-remarks" name="tarrif_param_remarks" required>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm">Save Tarrif Param</button>
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
                    <span>TARRIF PARAMS LIST</span>
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
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
                    <thead>
                    <tr>
                        <th>Tarrif Param Name</th>
                        <th>Tarrif Param Code</th>
                        <th>TPCT</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tarrifParams as $key => $t)
                        <tr>
                            <td>{{$t->tarrif_param_name}}</td>
                            <td>{{$t->tarrif_param_code}}</td>
                            <td>{{$t->tarrif_param_charge_type}}</td>

                            <td class="del">
                                <Button value="{{$t->tarrif_param_id}}" class="params-edit"><i class="fa fa-pencil-square-o"></i></Button>
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
    $('#frm-create-tarrif-param').on('submit', function (e) {
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

    $(document).on('click', '.params-edit', function (e) {
        console.log('dataclicked');
        $('#tarrif-param-show').modal('show');
        var tarrif_param_id = $(this).val();
        $.get("{{route('editTarrifParam')}}", {tarrif_param_id: tarrif_param_id}, function (data) {
            $('#tarrif-type-id-edit').val(data.tarrif_type_id);
            $('#tarrif-param-code-edit').val(data.tarrif_param_name);
            $('#tarrif_param_name-edit').val(data.tarrif_param_code);
            $('#tarrif-param-charge-type-edit').val(data.tarrif_param_charge_type);
            $('#tarrif-param-remarks-edit').val(data.tarrif_param_remarks);
            $('#tarrif-param-id-edit').val(data.tarrif_param_id);

        });
    });
    $('.btn-update-tarrif-param').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-tarrif-param').serialize();
        var updateTarrif =$.post("{{route('updateTarrifParam')}}", data, function (data) {
        });
        // if (updateTarrif==true) {
        $('#tarrifupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#tarrifupdatemessages_content').html('<h4>Tarrif Param updated successfully</h4>');
        $('#modal').modal('show');
        $('#tarrif-param-show').modal('hide');
        location.reload();
        // }else{
        //  return false;
        // }
    });
</script>
@endsection
