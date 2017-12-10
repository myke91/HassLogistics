@extends('layouts.app')
@section('content')
@include('payment.styles.css-payment')
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
                    <span>SEARCH FOR PAYMENT BY INVOICE NUMBER</span>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-md-3">
                        <form action="{{route('showPayment')}}" class="search-payment" method="GET">
                            <select id="invoice_no" name="invoice_no" class="s2 invoices">
                                <option value="">--------------------</option>
                                @foreach($invoices as $key => $i)
                                    <option value="{{$i->invoice_no}}">{{$i->invoice_no}}</option>
                                @endforeach
                            </select>
                            {{--<input class="form-control" name="invoice_no" placeholder="Invoice Number" type="text">--}}
                        </form>
                    </div>
                    <div class="col-md-3">
                        <label class="eng-name">Client Name: <b class="client-name"></b></label>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3" style="text-align: right">
                        <label class="date-invoice">Date: <b>{{date('d-M-Y')}}</b></label>
                    </div>
                    <div class="col-md-3" style="text-align: right">
                        <label class="invoice-number">Receipt N<sub>0</sub>: <b></b></label>
                    </div>
                </div>
                @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session('error')}}
                </div>
                @endif
                <div class="panel-body">
                    <table style="margin-top: 12px;">
                        <caption class="academicDetail">

                        </caption>
                        <thead>
                            <tr>
                                <td>Vessel</td>
                                <td>Bill Item</td>
                                <td>Actual Cost(GHC)</td>
                                <td>Amount(GHC)</td>
                                <td>Discount(GHC)</td>
                                <td>Paid(GHC)</td>
                                <td>Balance(GHC)</td>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <select id="VesselID" name="VesselID">
                                    <option value="">--------------------</option>
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option value="">--------------------</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="fee" id="fee" readonly="true">
                                <input type="hidden" name="user_id" id="userID">

                            </td>
                            <td>
                                <input type="text" name="amount" id="Amount" required>
                            </td>
                            <td>
                                <input type="text" name="discount" id="Discount">
                            </td>
                            <td>
                                <input type="text" name="paid" id="Paid">
                            </td>
                            <td>
                                <input type="text" name="balance" id="Balance">
                            </td>
                        </tr>

                        <thead>
                            <tr>
                                <th colspan="2">Remark</th>
                                <th colspan="5">Description</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <input type="text" name="description">
                                </td>
                                <td colspan="5">
                                    <input type="text" name="remark" id="remark">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer" style="height:40px;"></div>
            </div>


        </div>
    </div>
</div>

@endsection

@section('additional_script')
<script type="text/javascript">
    $(document).ready(function () {
        $.get("{{route('ready')}}", function () {
        });
    });

    // Run Select2 plugin on elements

    // Run Select2 plugin on elements
    function DemoSelect2() {
        $('.s2').select2({placeholder: "Select"});
    }
    // Run Datables plugin and create 3 variants of settings
    function AllTables() {
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
    $(document).ready(function () {

        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
    })
    function MakePDFInvoice() {
        var doc = new jsPDF();
        var elementHandler = {
            '#ignorePDF': function (element, renderer) {
                return true;
            }
        };
//        var source = $('#invoice')[0];
//        doc.fromHTML(
//                source,
//                15,
//                15,
//                {
//                    'width': 180, 'elementHandlers': elementHandler
//                });
//
//        doc.output("dataurlnewwindow");
    }
    $(document).ready(function () {
        //disable vessel dropdown and add tarrif button
        // Initialize datepicker
        $('#input_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
       // LoadTimePickerScript(DemoTimePicker);

        // Add tooltip to form-controls
        $('.form-control').tooltip();

        $('.submit').click(function (e) {
            e.preventDefault();
//            var data = $('.form-invoice').serialize();
//            var url = $('.form-invoice').attr('action');
//            $.post(url, data, function (data) {
            MakePDFInvoice();
//            })
        });

    });

    $(document).on('change', '.invoices', function (e) {
        e.preventDefault();
        var invoice_no = $('#invoice_no option:selected').val();
        console.log(invoice_no);
        $.get('{{route('showPayment')}}',{invoice_no:invoice_no} , function (data) {
         console.log(data)
        }).fail(function(data){
            console.log(data);
        });

    });

</script>


@endsection
