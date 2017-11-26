@extends('layouts.app')
@section('content')
@include('popups.add_tarrif')

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
                    <span>PREPARE INVOICE</span>
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
                <h4 class="page-header">INVOICE DETAILS</h4>
                <form class="form-horizontal form-invoice" role="form">

                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Client</label>
                        <div class="col-sm-4">
                            <select class="s2 populate placeholder clients" id="client_choose">
                                <option>---------</option>
                                @foreach($clients as $key =>$v)
                                <option value="{{$v->client_id}}">{{$v->client_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Vessel</label>
                        <div class="col-sm-4">
                            <select class="s2 populate placeholder vessels" id="vessel_choose">
                                <option>---------</option>
                                @foreach($vessels as $key =>$v)
                                <option value="{{$v->vessel_id}}">{{$v->vessel_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <button class="btn btn-info btn-label-left add-tarrif">
                                <span><i class="fa fa-plus-circle"></i></span>
                                Add Tarrif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>LIST OF ITEMS</span>
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
                <h4 class="page-header">BILL</h4>
                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="invoice-table">
                    <thead>
                        <tr>
                            <th>Vessel Name</th>
                            <th>Client Name</th>
                            <th>Bill Item</th>
                            <th>Vat</th>
                            <th>Invoice Details</th>
                            <th>Invoice Date</th>
 <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>Unit Price: &nbsp; / Quanity: &nbsp; / Total Cost: &nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="del">
                <button value="{{$v->vessel_id}}" class="del-class"><i class="fa fa-trash-o"></i></button>
            </td>
            <td class="del">
                <button value="{{$v->vessel_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></button>
            </td>
                        </tr>

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</div>
<div class="col-sm-2" style="float:left">
    <button type="submit" class="btn btn-primary btn-label-left confirm">
        <span><i class="fa fa-money"></i></span>
        Confirm And Generate Invoice
    </button>
</div>


@endsection

@section('additional_script')
<script type="text/javascript">
    // Run Select2 plugin on elements

// Run Select2 plugin on elements
    function DemoSelect2() {
        $('.s2').select2({placeholder: "Select"});
    }
    // Run timepicker
    function DemoTimePicker() {
        $('#input_time').timepicker({setDate: new Date()});
    }

    function MakeSelect2() {
        $('select').select2();
        $('.dataTables_filter').each(function () {
            $(this).find('label input[type=text]').attr('placeholder', 'Search');
        });
    }

    $(document).ready(function () {
        //disable vessel dropdown and add tarrif button
        $('.vessels').attr("disabled", "disabled");
        $('.add-tarrif').attr("disabled", "disabled");
        $('.submit').attr("disabled", "disabled");
        // Initialize datepicker
        $('#input_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        $('.submit').click(function (e) {
            e.preventDefault();
//            var data = $('.form-invoice').serialize();
//            var url = $('.form-invoice').attr('action');
//            $.post(url, data, function (data) {
            MakePDFInvoice();
//            })
        });
        $('.clients').change(function (e) {
            e.preventDefault();
            $('.vessels').removeAttr("disabled");
        });
        $('.vessels').change(function (e) {
            e.preventDefault();
            $('.add-tarrif').removeAttr("disabled");
        });
    });
    $('.save-tarrif').on('click', function (e) {
        e.preventDefault();
        console.log('received click event for additional invoice creation');
        var data = $("#frm-create-invoice").serialize();
        $.post("{{route('createInvoice')}}", data, function (data) {
            console.log(data);
        });
        $(this).trigger('reset');
        $('#tarrif-charge-modal').modal('hide');

    });
</script>

<script  type="text/javascript" src="{{ URL::asset('js/tarrif-form-builder.js') }}"></script>

@endsection
