<div class="modal fade" id="tarrif-charge-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <span>TARRIF CHARGE DATA EDIT</span>
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
                            <form class="form-horizontal" role="form" id="frm-update-tarrif-charge" action="">

                                    <input type="hidden" id="tarrif-charge-id-edit" name="tarrif_charge_id">
                                    <div class="form-group has-success">
                                        <label class="col-sm-4 control-label">Tarrif Param</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="tarrif-param-id-edit" name="tarrif_param_id">
                                                <option></option>
                                                @foreach($tarriParams as $key =>$t)
                                                    <option value="{{$t->tarrif_param_id}}">{{$t->tarrif_param_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="col-sm-4 control-label">Billable</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="billable-edit" name="billable" required>
                                        </div>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="col-sm-4 control-label">Cost</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="cost-edit" name="cost" required>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                        <button type="button" class="btn btn-success btn-sm  btn-update-tarrif-charge">Update Tarrif Charge</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

