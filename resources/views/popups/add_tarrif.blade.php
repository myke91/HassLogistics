<form action="" name="frm-create-invoice" id="frm-create-invoice">
<div class="modal fade" id="tarrif-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Tarrif</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="invoice_status" id="invoice_status" value="1">
                    <input type="hidden" name="vessel_id" id="vessel">
                    <input type="hidden" name ="client_id" id="client">
                    <label class="col-sm-2 control-label">Tarrif</label>
                    <div class="col-sm-4">
                        <select id="tarrif-name" name="tarrif_name" class="s2 trigger-tarrif-type">

                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-default next1" type="button">Next</button>
                <button class="btn btn-default prev1" type="button">Previous</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tarrif-type-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Tarrif Type</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-4 control-label">Tarrif Type</label>
                    <div class="col-sm-6">
                        <select id="tarrif-type" name="tarrif-type" class="s2 trigger-tarrif-params">
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-default next2" type="button">Next</button>
                <button class="btn btn-default prev2" type="button">Previous</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tarrif-param-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Tarrif Params</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-4 control-label">Tarrif Params</label>
                    <div class="col-sm-6">
                        <select id="tarrif-params" name="tarrif-params" class="s2 trigger-tarrif-charges">

                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-default next3" type="button">Next</button>
                <button class="btn btn-default prev3" type="button">Previous</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tarrif-charge-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tarrif Charges</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-8 control-label">Tarrif Param</label>
                        <div class="col-sm-8">
                            <input id="tarrif-charge-param" name="bill_item" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-8 control-label">Billable</label>
                        <div class="col-sm-8">
                            <select id="billable" name="billable" class="s2">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-8 control-label">Cost</label>
                        <div class="col-sm-8">
                            <input id="tarrif-charge-cost" name="unit_price" class="form-control"  placeholder="Cost" readonly ="true">
                        </div>
                    </div>
                    <div class="form-group quantity">
                        <label class="col-sm-8 control-label">Quantity</label>
                        <div class="col-sm-8">
                            <input id="quantity" name="quantity" class="form-control" placeholder="Quantity" />                       
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-8 control-label">Vat</label>
                        <div class="col-sm-8">
                            <input id="vat" name="vat" class="form-control" placeholder="0%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-8 control-label">Actual Cost</label>
                        <div class="col-sm-8">
                            <input id="actual_cost" name="actual_cost" class="form-control" readonly="true">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left prev1" type="button">Previous</button>
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-success save-tarrif" type="button">Save</button>
            </div>
        </div>
    </div>
</div>
</form>