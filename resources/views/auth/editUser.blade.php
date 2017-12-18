<div class="modal fade" id="user-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-name">
                                <i class="fa fa-search"></i>
                                <span>USER DATA EDIT</span>
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
                            <h4 class="page-header"></h4>
                            <div id="userupdatemessages" class="hide" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div id="userupdatemessages_content">
                                </div>
                            </div>
                            <form class="form-horizontal" role="form" id="frm-update-user" action="">
                                <input type="hidden" id="user-id-edit" name="id"/>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Full Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="fullname-edit" name="fullname" required>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="username-edit" name="username" required>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email-edit" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Role</label>
                                    <div class="col-sm-8">
                                        <select id="role-edit" name="role_id" class="" required>
                                            <option></option>
                                            @foreach($roles as $key =>$v)
                                                <option value="{{$v->r_id}}">{{$v->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button type="button" class="btn btn-success btn-sm  btn-update-user">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

