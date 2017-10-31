<div class="modal fade" id="tarrif-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Tarrif</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-2 control-label">Tarrif</label>
                    <div class="col-sm-4">
                        <select id="tarrif-name" name="tarrif_name" class="s2 trigger-tarrif-type">

                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

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
                            <option>--------</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

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
                    <label class="col-sm-2 control-label">Tarrif Params</label>
                    <div class="col-sm-4">
                        <select id="tarrif_params" name="tarrif_params" class="s2 trigger-tarrif-charges">
                            <option>--------</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tarrif-charge-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Tarrif Charges</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-4 control-label">Tarrif Param</label>
                    <div class="col-sm-4">
                        <input id="tarrif-param" name="tarrif-param" class="form-control" disabled placeholder="Date" />                       
                    </div>
                    <label class="col-sm-4 control-label">QUANTITY</label>
                    <div class="col-sm-4">
                        <input id="quantity" name="quantity" class="form-control" placeholder="Quantity" />                       
                    </div>
                    <label class="col-sm-4 control-label">COST</label>
                    <div class="col-sm-4">
                        <input id="cost" name="cost" class="form-control" disabled placeholder="Cost" />                       
                    </div>
                    <label class="col-sm-2 control-label">Tarrif Charges</label>
                    <div class="col-sm-4">
                        <select id="billable" name="billable" class="s2">
                            <option>--------</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>