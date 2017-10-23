@extends('layouts.app')
@section('content')
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
                    <div id="messages" class="hide" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div id="messages_content">
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" id="frm-create-client" action="{{route('postCreateClient')}}">
                        <div class="form-group">
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
                            <!-- <button type="button" class="btn btn-success btn-sm  btn-update-class">Update Course</button>-->
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
        @endsection
@section('additional-script')
    <script type="text/javascript">

        $('#frm-create-client').on('submit',function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,data,function (data) {
            })
            $(this).trigger('reset');
            $('#messages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
            $('#messages_content').html('<h4>Client Created Successfully</h4>');
            $('#modal').modal('show');
        })
    </script>
    @endsection
