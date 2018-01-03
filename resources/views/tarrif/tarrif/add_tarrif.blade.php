@extends('layouts.app')
@section('content')
@include('tarrif.tarrif.edit_tarrif')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('getTarrifForm')}}">Add Tarrif</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>CREATE NEW TARRIF</span>
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
                <h4 class="page-header">TARRIF</h4>
                <div id="clientmessages" class="hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="clientmessages_content">
                    </div>
                </div>
                <form class="form-horizontal" role="form" id="frm-create-tarrif" action="{{route('saveTarrif')}}">
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Tarrif</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tarrif_name" name="tarrif_name" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm">Save Tarrif</button>
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
                        <i class="fa fa-th-list"></i>
                    <span>TARRIF LIST</span>
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
                        <th>Tarrif Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tarrifs as $key => $value)
                        <tr>
                            <td>{{$value->tarrif_name}}</td>
                            <td class="del">
                                <Button value="{{$value->tarrif_id}}" class="edit"><i class="fa fa-pencil-square-o"></i></Button>
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

    $('#frm-create-tarrif').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url, data, function (data) {
            var validate = confirm('Tarrif ' + data.tarrif_name + ' Save successfully');
            if (validate === true) {
                location.reload();
            }
            else {
                return false;
            }

        });

    });

    $(document).on('click', '.edit', function (e) {
        console.log('dataclicked');
        $('#tarrif-show').modal('show');
       var tarrif_id = $(this).val();
        $.get("{{route('editTarrif')}}", {tarrif_id: tarrif_id}, function (data) {
            $('#tarrif-name').val(data.tarrif_name);
            $('#tarrif-id').val(data.tarrif_id);

        });
    });
    $('.btn-update-tarrif').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-tarrif').serialize();
        var updateTarrif =$.post("{{route('updateTarrif')}}", data, function (data) {
        });
       // if (updateTarrif==true) {
            $('#tarrifupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
            $('#tarrifupdatemessages_content').html('<h4>Tarrif updated successfully</h4>');
            $('#modal').modal('show');
            $('#tarrif-show').modal('hide');
            location.reload();
       // }else{
          //  return false;
       // }
    });

    $(document).ready(function () {
        $.get("{{route('ready')}}", function () {
        });
    });

</script>
@endsection
