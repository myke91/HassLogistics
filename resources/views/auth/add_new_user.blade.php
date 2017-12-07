@extends('layouts.app')

@section('content')
    @include('auth.editUser')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('postUser') }}">
                    {{ csrf_field() }}
                    @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{session('success')}}
                    </div>
                    @endif
                    <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                        <label for="fullname" class="col-md-4 control-label">Full Name</label>

                        <div class="col-md-6">
                            <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}" required autofocus>

                            @if ($errors->has('fullname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fullname') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 control-label">Username</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id" class="col-md-4 control-label">Role</label>
                        <div class="col-md-6">
                            <select id="role_id" name="role_id" class="s2 form-control"  required>
                                <option></option>
                                @foreach($roles as $key =>$v)
                                <option value="{{$v->r_id}}">{{$v->name}}</option>
                                @endforeach
                            </select> 

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
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
                    <span>TARRIF TYPE LIST</span>
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
            <div class="box-content no-padding" id="add-tarrif-type-info">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="vessel-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $u)
                        <tr>
                            <td>{{$u->fullname}}</td>
                            <td>{{$u->username}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->name}}</td>

                            <td class="del">
                                <Button value="{{$u->id}}" class="user-edit"><i class="fa fa-pencil-square-o"></i></Button>
                            </td>
                        </tr>

                    </tbody>
                    <tfoot>
                    @endforeach
                    </tfoot>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection


@section('additional_script')
<script type="text/javascript">
    $(document).ready(function () {
        $.get("{{route('ready')}}", function () {
        });
    });
    $(document).on('click', '.user-edit', function (e) {
        console.log('dataclicked');
        $('#user-show').modal('show');
        var id = $(this).val();
        $.get("{{route('editUser')}}", {id:id}, function (data) {
            $('#fullname-edit').val(data.fullname);
            $('#username-edit').val(data.username);
            $('#email-edit').val(data.email);
            $('#role-edit').val(data.role_id);
            $('#user-id-edit').val(data.id);

        });
    });
    $('.btn-update-user').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-user').serialize();
        var updateUser =$.post("{{route('updateUser')}}", data, function (data) {
        });
        // if (updateTarrif==true) {
        $('#userupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#userupdatemessages_content').html('<h4>User updated successfully</h4>');
        $('#modal').modal('show');
        $('#user-show').modal('hide');
        location.reload();
        // }else{
        //  return false;
        // }
    });
</script>
@endsection

