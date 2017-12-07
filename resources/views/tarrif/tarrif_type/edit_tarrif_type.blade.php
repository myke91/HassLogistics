<div class="modal fade" id="tarrif-type-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <span>TARRIF TYPE DATA EDIT</span>
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
                            <div id="clientupdatemessages" class="hide" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div id="clientupdatemessages_content">
                                </div>
                            </div>
                            <div id="updatemessages" class="hide" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div id="updatemessages_content">
                                </div>
                            </div>
                            <form class="form-horizontal" role="form" id="frm-update-tarrif-type" action="">
                                <div class="form-group">
                                    <input type="text" id="edit-tarrif-type-id" name="tarrif_type_id">
                                    <div class="form-group has-success has-feedback">
                                        <label class="col-sm-4 control-label">Tarrif Name</label>
                                        <div class="col-sm-6">
                                            <select id="tarrif-id" name="tarrif_id" class="form-control" disabled required>
                                                <option></option>
                                                <option></option>
                                                @foreach($tarrifs as $key =>$t)
                                                    <option value="{{$t->tarrif_id}}">{{$t->tarrif_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tarrif Type Code</label>
                                    <div class="col-sm-6">
                                        <input type="hidden" class="form-control" id="tarrif-type-code-edit" name="tarrif_type_code" data-toggle="tooltip" required>
                                    </div>
                                </div>
                                <div class="form-group has-success">
                                    <label class="col-sm-4 control-label">Tarrif Type Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="tarrif-type-name-edit" name="tarrif_type_name" data-toggle="tooltip" required>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button type="button" class="btn btn-success btn-sm  btn-update-tarrif-type">Update Tarrif Type</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

