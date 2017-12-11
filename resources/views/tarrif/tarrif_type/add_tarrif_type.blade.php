@extends('layouts.app')
@section('content')
@include('tarrif.tarrif_type.edit_tarrif_type')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('getTarrifTypeForm')}}">Add Tarrif Type</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>CREATE NEW TARRIF TYPE</span>
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
                <h4 class="page-header">Tarrif Type</h4>
                <div id="clientmessages" class="hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="clientmessages_content">
                    </div>
                </div>
                <form class="form-horizontal" role="form" id="frm-create-tarrif-type" action="{{route('saveTarrifType')}}">
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Tarrif</label>
                        <div class="col-sm-4">
                            <select id="tarrif-id" name="tarrif_id" class="s2 populate placeholder" required>
                                <option></option>
                                @foreach($tarrifs as $key =>$t)
                                <option value="{{$t->tarrif_id}}">{{$t->tarrif_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Tarrif Type Code</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tarrif-type-code" name="tarrif_type_code" required>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Tarrif Type Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tarrif-type-name" name="tarrif_type_name" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm">Save Tarrif Type</button>
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
                    <span>TARRIF TYPES LIST</span>
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
                            <th>Tarrif Type Name</th>
                            <th>Tarrif Type Code</th>
                            <th>Tarrif Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tarrifTypes as $key => $value)
                        <tr>
                            <td>{{$value->tarrif_type_name}}</td>
                            <td>{{$value->tarrif_type_code}}</td>
                            <td>{{$value->tarrif_name}}</td>

                            <td class="del">
                                <Button value="{{$value->tarrif_type_id}}" class="tarriftype-edit"><i class="fa fa-pencil-square-o"></i></Button>
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

    $('#frm-create-tarrif-type').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url, data, function (data) {
            var validate = confirm("Tarrif Type Save successfully");
            if (validate === true) {
                location.reload();
            } else {
                return false;
            }
        });

    });

    $(document).on('click', '.tarriftype-edit', function (e) {
        console.log('dataclicked');
        $('#tarrif-type-show').modal('show');
        var tarrif_type_id = $(this).val();
        $.get("{{route('editTarrifType')}}", {tarrif_type_id: tarrif_type_id}, function (data) {
            $('#tarrif-id').val(data.tarrif_id);
            $('#tarrif-type-code-edit').val(data.tarrif_type_code);
            $('#tarrif-type-name-edit').val(data.tarrif_type_name);
            $('#edit-tarrif-type-id').val(data.tarrif_type_id);

        });
    });
    $('.btn-update-tarrif-type').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-tarrif-type').serialize();
        var updateTarrif = $.post("{{route('updateTarrifType')}}", data, function (data) {
        });
        // if (updateTarrif==true) {
        $('#tarrifupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#tarrifupdatemessages_content').html('<h4>Tarrif Type updated successfully</h4>');
        $('#modal').modal('show');
        $('#tarrif-type-show').modal('hide');
        location.reload();
        // }else{
        //  return false;
        // }
    });


</script>
@endsection
