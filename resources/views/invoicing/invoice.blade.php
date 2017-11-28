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
                        <div class="col-sm-2">
                            <button class="btn btn-danger btn-label-left clear">
                                <span><i class="fa fa-exclamation-triangle"></i></span>
                                Clear
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
                    <form action="{{route('confirmInvoice')}}" method="POST">
                        {{csrf_field()}}
                        <tbody>
                            <tr class="data">
                                <td>&nbsp;<select name="vessel_id" class="inputValue" style="border:none" readonly="true">
                                        <option value="{{$t->vessel_id}}">{{$t->vessel_name}}</option>
                                    </select></td>
                                <td><select name="client_id" class="inputValue" style="border:none" readonly="true">
                                        <option value="{{$t->client_id}}">&nbsp;{{$t->client_name}}</option>
                                    </select></td>
                                <td><input type="text" class="inputValue" name="bill_item" value="{{$t->bill_item}}" style="border:none" readonly="true"> </td>
                                <td><input type="text" class="inputValue" name="vat" value="{{$t->vat}}" style="border:none" readonly="true" size="4"> </td>
                                <td>Unit Price: <input type="text" class="inputValue" name="unit_price" value="{{$t->unit_price}} " style="border:none" readonly="true" size="4">
                                    / Quanity: <input type="text" class="inputValue" name="quantity" value="{{$t->quantity}} " style="border:none" readonly="true" size="4">
                                    / Total Cost:<input type="text" class="inputValue" name="actual_cost" value="{{$t->actual_cost}}" style="border:none" readonly="true" size="4">
                                    <input type="hidden" class="inputValue" name="invoice_status" value="{{$t->invoice_status}}">
                                </td>
                                <td><input type="text" class="inputValue" name="invoice_date" value="{{$t->invoice_date}}" size="8" style="border:none" readonly></td>
                                <td class="del">
                                    <button value="{{$t->invoice_id}}" class="inputValue" class="del-class"
                                            onclick="return confirm('Are you sure you want to delete this invoice?');"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <td class="del">

                                    <button value="{{$t->invoice_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></button>
                                </td>
                                <td><button type="submit" class="confirm-save" value="{{$t->invoice_id}}"
                                            onclick="return confirm('Are you sure you want to confirm this invoice? After confirming,will not be able to edit it again');">
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
        <div class="col-sm-2" style="float: right">
            <button class="btn btn-info btn-label-left" id="generate-invoice">
                <span><i class="fa fa-money"></i></span>
                Confirm and Generate Invoice
            </button>
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


        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        $('.submit').click(function (e) {
            e.preventDefault();

        });
        $('.clients').change(function (e) {
            e.preventDefault();
            $('.vessels').removeAttr("disabled");
            var value = $('#client_choose').val();
            console.log(value);
            $.get("{{route('getVesselsForClient')}}", {id: value}, function (data) {
                console.log(data);
                $('#vessel_choose').html($('<option>').text('-------'));
                $.each(data, function (i, value) {
                    console.log(value.vessel_name);
                    $('#vessel_choose').append($('<option>').text(value.vessel_name).attr('value', value.vessel_id));
                });
            });
        });
        $('.vessels').change(function (e) {
            e.preventDefault();
            $('.add-tarrif').removeAttr("disabled");
        });
    }).on('click', '.confirm-save', function (e) {
        var invoice_id = $(this).val();
        $.post("{{route('deleteInvoce')}}", {invoice_id: invoice_id}, function (data) {

        });
    }).on('click', '.save-tarrif', function (e) {
        e.preventDefault();
        console.log('received click event for additional invoice creation');
        var data = $("#frm-create-invoice").serialize();
        $.post("{{route('createTempInvoice')}}", data, function (data) {
            console.log(data);
            location.reload();
        }).fail(function (data) {

        });
        $(this).trigger('reset');
        $('#tarrif-charge-modal').modal('hide');

    }).on('click', '#generate-invoice', function (e) {
        e.preventDefault();
        var entries = [];
        $("#invoice-table tr.data").map(function (index, elem) {
            var ret = [];
            $('.inputValue', this).each(function () {
                var d = $(this).val() || $(this).text();
                ret.push(d);
            });
            entries.push(ret);
            return ret;
        });
        console.log(entries);
        var client = $('#client_choose').text();
        var vessel = $('#vessel_choose').text();
        $.post("{{route('saveAllAndGenerateInvoice')}}", {data: entries, client: client, vessel: vessel}, function (data) {

        }).fail(function (data) {

        });
    });
</script>

<script  type="text/javascript" src="{{ URL::asset('js/tarrif-form-builder.js') }}"></script>

@endsection
