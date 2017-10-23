<div class="modal fade" id="vessel-show" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <span>VESSEL DATA EDIT</span>
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
                            <div id="messages" class="hide" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div id="messages_content">
                                </div>
                            </div>
                            <div id="updatemessages" class="hide" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div id="updatemessages_content">
                                </div>
                            </div>
                            <form class="form-horizontal" role="form" id="frm-update-vessel" action="">
                                <input type="text" name="vessel_id" id="vessel_id_edit">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Vessel Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="vessel_name_edit" name="vessel_name" data-toggle="tooltip" data-placement="bottom" title="Tooltip for name">
                                    </div>
                                    <label class="col-sm-2 control-label">Vessel Callsign</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="vessel_callsign_edit" name="vessel_callsign" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                                    </div>
                                </div>
                                <div class="form-group has-success has-feedback">
                                    <label class="col-sm-2 control-label">Vessel Class</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="vessel_class_edit" name="vessel_class" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                                    </div>
                                    <label class="col-sm-2 control-label">Vessel Operator</label>
                                    <div class="col-sm-4">
                                        <select id="vessel_operator_id_edit" name="vessel_operator_id" class="populate placeholder">
                                            @foreach($vesseloperator as $key =>$v)
                                                <option value="{{$v->vessel_operator_id}}">{{$v->operator_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="fa fa-plus txt-warning form-control-feedback" id="add-more-operator"></span>
                                    </div>
                                </div>
                                <div class="form-group has-warning has-feedback">
                                    <label class="col-sm-2 control-label">Vessel Type</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="vessel_type_edit" name="vessel_type" >
                                    </div>

                                    <label class="col-sm-2 control-label">Vessel Flag</label>
                                    <div class="col-sm-4">
                                        <select id="vessel_flag_edit" name="vessel_flag">
                                            <option>Linux</option>
                                            <option>Windows</option>
                                            <option>OpenSolaris</option>
                                            <option>FirefoxOS</option>
                                            <option>MeeGo</option>
                                            <option>Android</option>
                                            <option>Sailfish OS</option>
                                            <option>Plan9</option>
                                            <option>DOS</option>
                                            <option>AIX</option>
                                            <option>HP/UP</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group has-warning has-feedback">
                                    <label class="col-sm-2 control-label">Vessel Owner</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="vessel_owner" id="vessel_owner_edit" data-toggle="tooltip" data-placement="top" title="Hello world!">
                                    </div>
                                    <label class="col-sm-2 control-label">Vessel LOA</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="vessel_LOA_edit" name="vessel_LOA" data-toggle="tooltip" data-placement="top" title="Hello world!">
                                    </div>

                                </div>
                                <div class="form-group has-error has-feedback">
                                    <label class="col-sm-2 control-label">Vessel Arrival Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="arrival_date_edit" name="arrival_date" class="form-control" placeholder="Date">
                                        <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                                    </div>
                                    <label class="col-sm-2 control-label">Vessel Departure Date</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="departure_date_edit" name="departure_date" class="form-control" placeholder="Date">
                                        <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                    <button type="button" class="btn btn-success btn-sm  btn-update-vessel">Update Vessel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

