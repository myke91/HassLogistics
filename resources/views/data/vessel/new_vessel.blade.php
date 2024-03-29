@extends('layouts.app')
@section('content')
@include('popups.vesseloperator')
@include('popups.client')
@include('popups.vessel_search_result')
@include('data.vessel.editVesselInfo')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('add_vessel')}}">Add Vessel</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>CREATE NEW VESSEL</span>
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
                <h4 class="page-header">VESSEL DATA</h4>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="vessel-search-field" name="vessel-search-field" title="Vessel search">
                            <button type="submit" class="btn btn-primary btn-label-left search-vessel">
                                <span><i class="fa fa-search"></i></span>
                                Search
                            </button>
                            <button type="submit" class="btn btn-primary btn-label-left add-vessel">
                                <span><i class="fa fa-plus"></i></span>
                                Add Vessel
                            </button>
                        </div>
                    </div>

                </div>
                <form class="form-horizontal" role="form" id="frm-create-vessel" action="{{route('postCreateVessel')}}">
                    <div id="createvesselmessages" class="hide" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div id="createvesselmessages_content">
                        </div>
                    </div>
                     <div class="form-group has-success has-feedback">
                        <label class="col-sm-4 control-label">Vessel Owner / Consignee</label>
                        <div class="col-sm-6">
                            <select id="vessel_owner" name="vessel_owner" class="populate placeholder">
                                <option>--------</option>
                                @foreach($clients as $key =>$v)
                                <option value="{{$v->client_id}}">{{$v->client_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="col-sm-4 fa fa-plus txt-warning form-control-feedback add-more-client"></span>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-sm-2 control-label">Vessel Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_name" name="vessel_name" data-toggle="tooltip" data-placement="bottom"  >
                        </div>
                        <label class="col-sm-2 control-label">Voyage Number</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="voyage_number" name="voyage_number" data-toggle="tooltip" data-placement="bottom" required>
                        </div>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel Class</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="vessel_class" name="vessel_class" data-toggle="tooltip" data-placement="bottom" required>
                        </div>
                        <label class="col-sm-2 control-label">Vessel Operator</label>
                        <div class="col-sm-2">
                            <select id="vessel_operator_id" name="vessel_operator_id" class="populate placeholder" required>
                                <option>--------</option>
                                @foreach($vesseloperator as $key =>$v)
                                <option value="{{$v->vessel_operator_id}}">{{$v->operator_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="fa fa-plus txt-warning form-control-feedback add-more-operator"></span>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel Type</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_type" name="vessel_type" required>
                        </div>

                        <label class="col-sm-2 control-label">Vessel Flag</label>
                        <div class="col-sm-4">
                            <select id="vessel_flag" name="vessel_flag" class="populate placeholder">
                                <option>--------</option>
                                <option>Liberia</option>
                                <option>Germany</option>
                                <option>Kenya</option>
                                <option>Australia</option>
                                <option>Hungary</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group has-success has-feedback">

                        <label class="col-sm-2 control-label">Vessel LOA</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_loa" name="vessel_loa" data-toggle="tooltip" data-placement="top" required>
                        </div>
                        <label class="col-sm-2 control-label">Vessel GRT</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="vessel_grt" name="vessel_grt" data-toggle="tooltip" data-placement="top" required>
                        </div>

                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel Arrival Date</label>
                        <div class="col-sm-4">
                            <input type="text" id="arrival_date" name="arrival_date" class="form-control" placeholder="Date" required>
                            <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                        </div>
                        <label class="col-sm-2 control-label">Vessel Departure Date</label>
                        <div class="col-sm-4">
                            <input type="text" id="departure_date" name="departure_date" class="form-control" placeholder="Date" required>
                            <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                        </div>
                    </div> 
                   

                    <fieldset>
                        <legend>Registration Info</legend>

                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">BL Number</label>
                            <div class="col-sm-2">
                                <input type="text" id="bl_no" name="bl_no" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">Reg Place</label>
                            <div class="col-sm-2">
                                <input type="text" id="reg_place" name="reg_place" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">Construction Year</label>
                            <div class="col-sm-2">
                                <input type="text" id="construction_year" name="construction_year" class="form-control" required>

                            </div>
                        </div> 
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Port of Discharge</label>
                            <div class="col-sm-2">
                                <input type="text" id="port_of_discharge" name="port_of_discharge" class="form-control" required>

                            </div>
                            
                            <label class="col-sm-2 control-label">Port of Loading</label>
                            <div class="col-sm-2">
                                <input type="text" id="port_of_loading" name="port_of_loading" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">Reg Year</label>
                            <div class="col-sm-2">
                                <input type="text" id="reg_year" name="reg_year" class="form-control" required>

                            </div>
                        </div> 
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Tonnage Certificate</label>
                            <div class="col-sm-2">
                                <input type="text" id="tonnage_certificate" name="tonnage_certificate" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">MMSI</label>
                            <div class="col-sm-2">
                                <input type="text" id="mmsi" name="mmsi" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">ISPS No</label>
                            <div class="col-sm-2">
                                <input type="text" id="isps_no" name="isps_no" class="form-control" required>

                            </div>
                        </div> 
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Ice Class</label>
                            <div class="col-sm-2">
                                <input type="text" id="ice_class" name="ice_class" class="form-control" required>

                            </div>

                        </div> 
                    </fieldset>
                    <fieldset>
                        <legend>Particulars</legend>
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">DWT</label>
                            <div class="col-sm-2">
                                <input type="text" id="dwt" name="dwt" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">SBT</label>
                            <div class="col-sm-2">
                                <input type="text" id="sbt" name="sbt" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">Air Draft</label>
                            <div class="col-sm-2">
                                <input type="text" id="air_draft" name="air_draft" class="form-control" required>

                            </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">LL</label>
                            <div class="col-sm-2">
                                <input type="text" id="ll" name="ll" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">GT</label>
                            <div class="col-sm-2">
                                <input type="text" id="gt" name="gt" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">LOA</label>
                            <div class="col-sm-2">
                                <input type="text" id="loa" name="loa" class="form-control" required>

                            </div>
                        </div> 
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Knots</label>
                            <div class="col-sm-2">
                                <input type="text" id="knots" name="knots" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">FTC</label>
                            <div class="col-sm-2">
                                <input type="text" id="ftc" name="ftc" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">NT</label>
                            <div class="col-sm-2">
                                <input type="text" id="nt" name="nt" class="form-control" required>

                            </div>
                        </div>
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Beam</label>
                            <div class="col-sm-2">
                                <input type="text" id="beam" name="beam" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">CBM Tank</label>
                            <div class="col-sm-2">
                                <input type="text" id="cbm_tank" name="cbm_tank" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">RGT</label>
                            <div class="col-sm-2">
                                <input type="text" id="rgt" name="rgt" class="form-control" required>

                            </div>
                        </div> 
                        <div class="form-group has-success has-feedback">
                            <label class="col-sm-2 control-label">Max Draft</label>
                            <div class="col-sm-2">
                                <input type="text" id="max_draft" name="max_draft" class="form-control" required>

                            </div>
                            <label class="col-sm-2 control-label">G-Factor</label>
                            <div class="col-sm-2">
                                <input type="text" id="g_factor" name="g_factor" class="form-control" required>

                            </div>

                        </div> 
                    </fieldset>
                    <fieldset> 
                        <legend>Properties</legend>
                        <div class="form-group has-success has-feedback">
                            <div class="col-sm-8">
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" id="double_bottom" name="double_bottom"> Double Bottom
                                        <i class="fa fa-square-o"></i>
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" id="double_skin" name="double_skin"> Double Skin
                                        <i class="fa fa-square-o"></i>
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" id="double_sides" name="double_sides"> Double Sides
                                        <i class="fa fa-square-o"></i>
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" id="bow_thrusters" name="bow_thrusters"> Bow Thrusters
                                        <i class="fa fa-square-o"></i>
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" id="stern_thrusters" name="stern_thrusters"> Stern Thrusters
                                        <i class="fa fa-square-o"></i>
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" id="annual_fee" name="annual_fee"> Annual Fee
                                        <i class="fa fa-square-o"></i>
                                    </label>
                                </div>
                                <div class="checkbox-inline">
                                    <label>
                                        <input type="checkbox" id="inactive" name="inactive"> Inactive
                                        <i class="fa fa-square-o"></i>
                                    </label>
                                </div>
                            </div>
                        </div> 

                    </fieldset>
                    <div class="clearfix"></div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-success btn-sm">Save Vessel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('additional_script')
<script type="text/javascript">
// Run Select2 plugin on elements
    function DemoSelect2() {
        $('#s2_with_tag').select2({placeholder: "Select OS"});
        $('#s2_country').select2();
    }
// Run timepicker
    function DemoTimePicker() {
        $('#input_time').timepicker({setDate: new Date()});
    }
    // Run Datables plugin and create 3 variants of settings
    function AllTables() {
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
    function MakeSelect2() {
        $('select').select2();
        $('.dataTables_filter').each(function () {
            $(this).find('label input[type=text]').attr('placeholder', 'Search');
        });
    }
    $(document).ready(function () {
        // Initialize datepicker
        $('#arrival_date').datepicker({setDate: new Date()});
        $('#departure_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Load Datatables and run plugin on tables 
        LoadDataTablesScripts(AllTables);
        dateFormat:'yy-mm-dd';
        disableFormFields();
        $('.add-vessel').click(function (e) {
            $('#frm-create-vessel :input').attr("disabled", false);
        });
        // Add drag-n-drop feature to boxes
        WinMove();
    });

    function disableFormFields() {
        $('#frm-create-vessel :input').attr("disabled", true);
    }
</script>
<script  type="text/javascript" src="{{ URL::asset('js/vessel.js') }}"></script> 
@endsection
