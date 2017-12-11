@extends('layouts.app')
@section('content')
@include('payment.styles.css-payment')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>ENTER PAYMENT DETAILS</span>
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
            @if(session('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{session('success')}}
            </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-md-3">

                        <form action="{{route('showPayment')}}" class="search-payment" method="GET">
                            <select id="invoice_no" name="invoice_no" class="form-control invoices">
                                {{--<option value="">--------------------</option>--}}
                                @foreach($invoices as $key => $i)
                                <option value="{{$i->invoice_no}}">{{$i->invoice_no}}</option>
                                    @endforeach
                            </select>
                            {{--<input class="form-control" name="invoice_no" value="{{$invoice->invoice_no}}"--}}
                                   {{--placeholder="Invoice Number" type="text">--}}
                        </form>
                    </div>
                    <div class="col-md-3">
                        <label class="eng-name">Name: <b class="student-name">
                                {{$invoice->client_name}}
                            </b></label>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3" style="text-align: right">
                        <label class="date-invoice">Date: <b>{{date('d-M-Y')}}</b></label>
                    </div>
                    <div class="col-md-3" style="text-align: right">
                        <label class="invoice-number">Receipt N<sub>0</sub>: <b>{{sprintf('%05d','000')}}</b></label>
                    </div>
                </div>
                <form action="{{route('savePayment')}}" method="POST" id="frmPayment">
                    {{csrf_field()}}

                    <div class="panel-body">
                        <table style="margin-top: 12px;">
                            <caption class="academicDetail">

                            </caption>
                            <thead>
                                <tr>
                                    <th colspan="2">Vessel</th>
                                    <th>Total Cost(GHC)</th>
                                    <th>Amount(GHC)</th>
                                    <th>Discount(GHC)</th>
                                    <th>Paid(GHC)</th>
                                    <th>Balance(GHC)</th>
                                </tr>
                            </thead>
                            <tr>
                                <td colspan="2">
                                    <select id="vessel_id" name="vessel_id" class="form-control">
                                        <option value="">--------------------</option>
                                        @foreach($vessel as $key => $p)
                                        <option value="{{$p->vessel_id}}" {{$p->vessel_id==$invoice->vessel_id?
                                            'selected' : null}}>{{$p->vessel_name}}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <input type="hidden" name="payment_id" id="payment_id" value="{{$invoice->payment_id}}">
                                    <input type="text" name="total_cost" value="{{$invoice->total_cost}}" id="Fee" class="cost" readonly="true">
                                    <input type="hidden" name="client_id" id="client_id" value="{{$invoice->client_id}}">
                                    <input type="hidden" name="actual_cost" id="actual_cost" value="{{$invoice->actual_cost}}">
                                    <input type="hidden" name="invoice_no" id="invoice_no" value="{{$invoice->invoice_no}}">
                                    <input type="hidden" name="user" value="{{Auth::user()->fullname}}" id="userID">
                                    <input type="hidden" name="username" value="{{Auth::user()->username}}" id="userID">
                                    <input type="hidden" name="payment_date" value="{{date('Y-m-d H:i:s')}}" id="payment_date">

                                </td>
                                <td>
                                    <input type="text" name="amount_paid" value="{{$invoice->amount_paid}}" id="Amount" readonly = "true">
                                </td>
                                <td>
                                    <input type="text" name="discount" id="Discount">
                                </td>
                                <td>
                                    <input type="text" name="amount" id="Paid">
                                </td>
                                <td>
                                    <input type="text" name="balance" value="{{$invoice->total_cost - $invoice->amount_paid}}" id="Lack" readonly="true">
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
                                        <input type="text" name="remark" id="remark">
                                    </td>
                                    <td colspan="5">
                                        <input type="text" name="description" id="description">
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                <tr>
                                    <th colspan="2">
                                        Payment Mode
                                    </th>
                                    <th colspan="2">Account Number</th>
                                    <th colspan="2">Account Name</th>
                                    <th>Cheque Date</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td colspan="2">
                                        <select name="payment_mode" id="paymentmode" class="form-control" onchange="showCheque()" required>
                                            <option></option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="On Account">On Account</option>
                                        </select>
                                    </td>
                                    <td colspan="2"><input type="text" name="account_name" id="account_name"></td>
                                    <td colspan="2"><input type="text" name="account_number" id="account_number"></td>
                                    <td><input type="text" name="cheque_date" id="cheque_date" placeholder="Click to add date"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <input type="button" onclick="this.form.reset()" class="btn btn-default btn-reset" value="Reset">
                        <input type="submit" id="btn-go" name="btn-go" class="btn btn-default btn-payment pull-right">
                        <input type="hidden" id="reciept-file-name" name="file" />
                        <a href="{{route('downloadRecieptFile')}}" class="btn btn-link btn-label-left" id="download-receipt" style="float:right;text-decoration: none">
                            <span><i class="fa fa-download"></i></span>
                            Download Reciept
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

@endsection

@section('additional_script')
<script type="text/javascript">

    function DemoSelect2() {
        $('.s2').select2({placeholder: "Select"});
    }
     
    $(document).ready(function () {
      $.get("{{route('ready')}}", function () {
        });


        $('#cheque_date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
         $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        showCheque();
        $('#download-receipt').attr("disabled", "disabled");
        $('#account_name').attr("disabled","disabled")
        $('#account_number').attr("disabled","disabled")
        $('#cheque_date').attr("disabled","disabled")
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        $('.submit').click(function (e) {
            e.preventDefault();
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
        $( "#payment-search-form" ).submit();
//        $.get('{{route('showPayment')}}',{invoice_no:invoice_no} , function (data) {
//
//        }).fail(function(data){
//            console.log(data);
//        });

    });
    function showCheque(){
        var val = document.getElementById('paymentmode').value;
        if (val =='Cash'){
            $('#account_name').attr("disabled");
            $('#account_number').attr("disabled");
            $('#cheque_date').attr("disabled");
        }
       else if (val =='On Account'){
            $('#account_name').attr("disabled");
            $('#account_number').attr("disabled");
            $('#cheque_date').attr("disabled");
        }
        else {
            $('#account_name').removeAttr("disabled");
            $('#account_number').removeAttr("disabled");
            $('#cheque_date').removeAttr("disabled");
        }

    }

</script>
{{--<script  type="text/javascript" src="{{ URL::asset('js/calculatepayment.js') }}"></script>--}}


@endsection
