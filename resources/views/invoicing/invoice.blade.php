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
            <div class="box-content" id="box-content">
                <h4 class="page-header">BILL</h4>

                    @if(session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session('success')}}
                        </div>
                    @endif

                <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="invoice-table">
                    <thead>
                        <tr>
                            <th>Vessel Name</th>
                            <th>Client Name</th>
                            <th>Bill Item</th>
                            <th>Vat</th>
                            <th>Invoice Details</th>
                            <th>Invoice Date</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>

                    @foreach($temp as $t)
                        <form action="" method="POST" id="frm-confirm-invoice">
                            {{csrf_field()}}
                    <tbody>
                        <tr>
                            <td>&nbsp;<select name="vessel_id" style="border:none" readonly="true">
                                        <option value="{{$t->vessel_id}}">{{$t->vessel_name}}</option>
                                </select></td>
                            <td><select name="client_id" style="border:none" readonly="true">
                                    <option value="{{$t->client_id}}">&nbsp;{{$t->client_name}}</option>
                                </select></td>
                            <td><input type="text" name="bill_item" value="{{$t->bill_item}}" style="border:none" readonly="true"> </td>
                            <td><input type="text" name="vat" value="{{$t->vat}}" style="border:none" readonly="true" size="4"> </td>
                            <td>Unit Price: <input type="text" name="unit_price" value="{{$t->unit_price}} " style="border:none" readonly="true" size="4">
                                / Quanity: <input type="text" name="quantity" value="{{$t->quantity}} " style="border:none" readonly="true" size="4">
                                / Total Cost:<input type="text" name="actual_cost" value="{{$t->actual_cost}}" style="border:none" readonly="true" size="4">
                                <input type="hidden" name="invoice_status" value="{{$t->invoice_status}}">
                                 </td>
                            <td><input type="text" name="invoice_date" value="{{$t->invoice_date}}" size="8" style="border:none" readonly></td>
                            <td class="del">
                            <button value="{{$t->invoice_id}}" class="del-class"
                                   ><i class="fa fa-trash-o"></i></button>
                        </td>
                        <td class="del">

                            <button value="{{$t->invoice_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></button>
                        </td>
                            <td><button type="submit" class="confirm-save" value="{{$t->invoice_id}}">
                                    <i class="fa fa-check"></i>
                                </button></td>
                        </tr>

                    </tbody>
                    @endforeach
                    <tfoot>

                    </tfoot>
                </table>
                </form>
                    <div class="footer" >

                    </div>

            </div>
        </div>
    </div>
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
        $.post("{{route('createTempInvoice')}}", data, function (data) {
            console.log(data);

        });
        $.get("{{route('invoice')}}", data, function (data) {

        });
        $(this).trigger('reset');
        $('#tarrif-charge-modal').modal('hide');

    });

    $(document).on('click', '.confirm-save', function (e) {
        e.preventDefault();
        var data = $("#frm-confirm-invoice").serialize();
        invoice_id = $(this).val();
        var validate = confirm("Are you sure you want to confirm this invoice? After confirming,you will not be able to edit it again");
        if (validate== true) {
            $.post("{{route('deleteInvoce')}}", {invoice_id:invoice_id}, function (data) {
                console.log(data);
            })
            $.post("{{route('confirmInvoice')}}", data, function (data) {
                console.log(data);

            });
        } else {
            return false;
        }

    })
</script>

<script  type="text/javascript" src="{{ URL::asset('js/tarrif-form-builder.js') }}"></script>

@endsection
