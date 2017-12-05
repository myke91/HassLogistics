<form action="" name="frm-create-invoice" id="frm-update-invoice">
    <div class="modal fade" id="invoice-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Select Tarrif</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" name="invoice_id" id="invoice_id">
                            <input type="hidden" name = "invoice_date" value="{{date('Y-m-d')}}">
                            <label class="col-sm-8 control-label">Vessel Name</label>
                            <div class="col-sm-8">
                                <select id="vessel_id" name="vessel_id" class="form-control">
                                    <option>--------</option>
                                    @foreach($vessels as $key =>$v)
                                        <option value="{{$v->vessel_id}}">{{$v->vessel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-8 control-label">Client Name</label>
                            <div class="col-sm-8">
                                <select id="client_id" name="client_id" class="form-control">
                                    <option>--------</option>
                                    @foreach($clients as $key =>$v)
                                        <option value="{{$v->client_id}}">{{$v->client_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                                <label class="col-sm-8 control-label">Tarrif Param</label>
                                <div class="col-sm-8">
                                    <select id="bill_item_edit" name="bill_item" class="form-control">
                                        <option>--------</option>
                                        @foreach($tps as $key =>$t)
                                            <option value="{{$t->tarrif_param_name}}">{{$t->tarrif_param_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-sm-8 control-label">Billable</label>
                                <div class="col-sm-8">
                                    <select id="billable_edit" name="billable" class="form-control">
                                        <option>--------</option>
                                        @foreach($tcs as $key =>$t)
                                            <option value="{{$t->billable}}">{{$t->billable}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-sm-8 control-label">Cost</label>
                                <div class="col-sm-8">
                                    <input id="unit_price" name="unit_price" class="form-control"  placeholder="Cost" readonly ="true">
                                </div>
                                <label class="col-sm-8 control-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input id="quantity_edit" name="quantity" class="form-control" placeholder="Quantity" />
                                </div>
                                <label class="col-sm-8 control-label">Vat</label>
                                <div class="col-sm-8">
                                    <input id="vat_edit" name="vat" class="form-control" placeholder="0%">
                                </div>
                                <label class="col-sm-8 control-label">Actual Cost</label>
                                <div class="col-sm-8">

                                    <input id="actual_cost_edit" name="actual_cost" class="form-control" readonly="true">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success update-temp_invoice" type="button">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>