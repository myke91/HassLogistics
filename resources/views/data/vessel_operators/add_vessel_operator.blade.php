@extends('layouts.app')
@section('content')
@include('data.vessel_operators.edit_vessel_operator')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('add_vessel_operator')}}">Add Vessel Operator</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>CREATE NEW VESSEL OPERATOR</span>
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
                <h4 class="page-header">VESSEL OPERATOR</h4>
                <div id="clientmessages" class="hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div id="clientmessages_content">
                    </div>
                </div>
                <form class="form-horizontal" role="form" id="frm-create-vessel-operator" action="{{route('createVesselOperator')}}">
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Vessel Operator</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="operator_name" name="operator_name" required>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm">Save Vessel Operator</button>
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
                    <span>VESSEL OPERATORS LIST</span>
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
            <div class="box-content no-padding" id="add-vessel-operator-info"><table class="table table-bordered table-striped table-hover table-heading table-datatable" id="vessel-table">
                    <thead>
                    <tr>
                        <th>Operator id</th>
                        <th>Operator Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vesseloperators as $key => $v)
                        <tr>
                            <td>{{$v->vessel_operator_id}}</td>
                            <td>{{$v->operator_name}}</td>
                            <td class="del">
                                <Button value="{{$v->vessel_operator_id}}" class="vo-edit"><i class="fa fa-pencil-square-o"></i></Button>
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
    showClientInfo();


    // Run Datables plugin and create 3 variants of settings
    function AllTables() {
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }


    $('#frm-create-vessel-operator').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url, data, function (data) {
            showClientInfo(data.client_name);
        });
        $(this).trigger('reset');
        $('#clientmessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#clientmessages_content').html('<h4>Vessel operator created Successfully</h4>');
        $('#modal').modal('show');
    });
    function showClientInfo()
    {
        var data = $('#frm-create-client').serialize();
        $.get("{{route('showClientInfo')}}", data, function (data) {
            $('#add-client-info').empty().append(data);
        });
    }
    $(document).on('click', '.vo-edit', function (e) {
        $('#vessel_op-show').modal('show');
        var vessel_operator_id = $(this).val();
        $.get("{{route('edit_vessel_operator')}}", {vessel_operator_id: vessel_operator_id}, function (data) {
            console.log(data);
            $('#operator_name_edit').val(data.operator_name);
            $('#vessel_operator_id_edit').val(data.vessel_operator_id);

        });
    });

    $('.btn-update-client').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-client').serialize();
        $.post("{{route('updateClient')}}", data, function (data) {
            showClientInfo(data.client_name);
        });
        $('#clientupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#clientupdatemessages_content').html('<h4>Vessel operator updated successfully</h4>');
        $('#modal').modal('show');
        $('#frm-update-class').trigger('reset');
    });



</script>
@endsection
