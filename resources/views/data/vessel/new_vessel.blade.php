@extends('layouts.app')
@section('content')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="/">Dashboard</a></li>
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
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vessel Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="First name" data-toggle="tooltip" data-placement="bottom" title="Tooltip for name">
                        </div>
                        <label class="col-sm-2 control-label">Vessel Callsign</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Last name" data-toggle="tooltip" data-placement="bottom" title="Tooltip for last name">
                        </div>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel Class</label>
                        <div class="col-sm-4">
                            <select id="s2_with_tag" class="populate placeholder">
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
                        <label class="col-sm-2 control-label">Vessel Operator</label>
                        <div class="col-sm-4">
                            <select id="s2_with_tag" class="populate placeholder">
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
                        <label class="col-sm-2 control-label">Vessel Type</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="City">
                            <span class="fa fa-key txt-warning form-control-feedback"></span>
                        </div>

                        <label class="col-sm-2 control-label">Vessel Flag</label>
                        <div class="col-sm-4">
                            <select id="s2_with_tag" class="populate placeholder">
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
                            <input type="text" class="form-control" placeholder="Another info" data-toggle="tooltip" data-placement="top" title="Hello world!">
                        </div>
                        <label class="col-sm-2 control-label">Vessel LOA</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Another info" data-toggle="tooltip" data-placement="top" title="Hello world!">
                        </div>

                    </div>
                    <div class="form-group has-warning has-feedback">
                        <label class="col-sm-2 control-label">Vessel Owner</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Another info" data-toggle="tooltip" data-placement="top" title="Hello world!">
                        </div>
                        <label class="col-sm-2 control-label">Vessel LOA</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Another info" data-toggle="tooltip" data-placement="top" title="Hello world!">
                        </div>

                    </div>
                    <div class="form-group has-error has-feedback">
                        <label class="col-sm-2 control-label">Vessel Arrival Date</label>
                        <div class="col-sm-4">
                            <input type="text" id="input_date" class="form-control" placeholder="Date">
                            <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                        </div>
                        <label class="col-sm-2 control-label">Vessel Departure Date</label>
                        <div class="col-sm-4">
                            <input type="text" id="input_date" class="form-control" placeholder="Date">
                            <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                        </div>
                    </div>                                                                                
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-2">
                            <button type="cancel" class="btn btn-default btn-label-left">
                                <span><i class="fa fa-clock-o txt-danger"></i></span>
                                Cancel
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary btn-label-left">
                                <span><i class="fa fa-clock-o"></i></span>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------->
<!--
DISPLAY TABLE
-->
<!--------------------------------------------------------------------->
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-linux"></i>
                    <span>VESSEL LIST</span>
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
            <div class="box-content no-padding">
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
                    <thead>
                        <tr>
                            <th>Rate</th>
                            <th>Distro</th>
                            <th>Votes</th>
                            <th>Homepage</th>
                            <th>Version</th>
                            <th>Icon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ubuntu</td>
                            <td>16%</td>
                            <td><i class="fa fa-home"></i><a href="http://ubuntu.com" target="_blank">http://ubuntu.com</a></td>
                            <td>13.10</td>
                            <td><i class="fa fa-linux"></i></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Debian</td>
                            <td>14.1%</td>
                            <td><i class="fa fa-home"></i><a href="http://debian.org" target="_blank">http://debian.org</a></td>
                            <td>7.4</td>
                            <td><i class="fa fa-linux"></i></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Arch Linux</td>
                            <td>10.8%</td>
                            <td><i class="fa fa-home"></i><a href="http://archlinux.org" target="_blank">http://archlinux.org</a></td>
                            <td>2014.02.01</td>
                            <td><i class="fa fa-linux"></i></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Linux Mint</td>
                            <td>10.5%</td>
                            <td><i class="fa fa-home"></i><a href="http://linuxmint.com" target="_blank">http://linuxmint.com</a></td>
                            <td>16</td>
                            <td><i class="fa fa-linux"></i></td>
                        </tr>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
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
        $('#input_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Load Datatables and run plugin on tables 
        LoadDataTablesScripts(AllTables);
        // Add drag-n-drop feature to boxes
        WinMove();
    });


</script>
@endsection
