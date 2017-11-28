<div class="modal fade" id="client-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Client</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <form role="form" id="frm-create-client" action="{{route('createClient')}}">
                        <div class="form-group">
                            <label class="col-sm-8 control-label">Client Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="client_name_pop" name="client_name" required>
                            </div>
                            <label class="col-sm-8 control-label">Office Desc</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="client_office_desc" name="client_office_desc" required>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-sm-8 control-label">Head office</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="client_head_office" name="client_head_office" data-placement="bottom">
                            </div>
                            <label class="col-sm-8 control-label">Client Number</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="client_number" name="client_number" data-placement="bottom" >
                            </div>
                        </div>
                         <div class="form-group has-feedback">
                            <label class="col-sm-8 control-label">Client Email Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="client_email" name="client_email" data-toggle="tooltip" data-placement="bottom">
                            </div>
                            
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-sm-8 control-label">Digital Address</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="digital_address" name="digital_address" data-toggle="tooltip" data-placement="bottom">
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button type="submit" class="btn btn-success btn-sm create-client">Create Client</button>
            </div>
        </div>
    </div>
</div>