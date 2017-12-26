<div class="modal fade" id="exchange-rate-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">EXCHANGE RATE EDIT</h4>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-name">
                                <i class="fa fa-search"></i>
                                <span>EXCHANGE RATE EDIT</span>
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
                            <form class="form-vertical" role="form" id="frm-update-vo" action="">
                            <div class="form-group">
                                <input type="hidden" id="exchange_rate_id_edit" name="exchange_rate_id">
                                <label class="col-sm-2 control-label">Currency</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="currency_edit" name="currency" required>
                                </div>
                                <label class="col-sm-2 control-label">Selling Price</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="selling_price_edit" name="selling_price" required>
                                </div>
                                <label class="col-sm-2 control-label">Buying Price</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="buying_price_edit" name="buying_price_edit" required>
                                </div>

                            </div>
                                <div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button type="button" class="btn btn-success btn-sm  btn-update-vo">Update Exchange Rate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

