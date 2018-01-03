<div class="modal fade" id="client-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <span>CLIENT DATA EDIT</span>
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
                            <form class="form-horizontal" role="form" id="frm-update-client" action="">
                            <div class="form-group">
                                <input type="hidden" id="client_id_edit" name="client_id">
                                <label class="col-sm-4 control-label">Client Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="client_name_edit" name="client_name"required>
                                </div>
                            </div>
                                <div class="form-group">
                                <label class="col-sm-4 control-label">Office Desc</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="client_office_desc_edit" name="client_office_desc" data-toggle="tooltip" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Head office</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="client_head_office_edit" name="client_head_office" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                                </div>
                            </div><div class="form-group">
                                <label class="col-sm-4 control-label">Client Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="client_email_edit" name="client_email" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                                </div>
                            </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Digital Address</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="client_digital_address_edit" name="client_digital_address" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Currency</label>
                                    <div class="col-sm-6">
                                        <select id="client_currency_edit" name="client_currency" class="populate placeholder">
                                            <option>--------</option>
                                            @foreach($exchangeRates as $key =>$v)
                                                <option value="{{$v->currency}}">{{$v->currency}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Client Number</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" id="client_number_edit" name="client_number" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button type="button" class="btn btn-success btn-sm  btn-update-client">Update Client</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

