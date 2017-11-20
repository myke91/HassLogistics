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
                                <input class="form-control" name="student_id" value="{{$invoice->invoice_id}}" placeholder="Invoice ID" type="text">
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
                                        <select id="vessel_id" name="vessel_id">
                                            <option value="">--------------------</option>
                                            @foreach($vessel as $key => $p)
                                                <option value="{{$p->vessel_id}}" {{$p->vessel_id==$invoice->vessel_id?
                                'selected' : null}}>{{$p->vessel_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="bill_item" value="{{$invoice->bill_item}}" id="bill_item" readonly="true">
                                    </td>
                                    <td>
                                        <input type="text" name="actual_cost" value="{{$invoice->actual_cost}}" id="Fee" class="cost" readonly="true">
                                        <input type="hidden" name="client_id" id="client_id" value="{{$invoice->client_id}}">
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="userID">
                                        <input type="hidden" name="payment_date" value="{{date('Y-m-d H:i:s')}}" id="payment_date">

                                    </td>
                                    <td>
                                        <input type="text" name="amount" id="Amount" required>
                                    </td>
                                    <td>
                                        <input type="text" name="discount" id="Discount">
                                    </td>
                                    <td>
                                        <input type="text" name="amount_paid" id="Paid">
                                    </td>
                                    <td>
                                        <input type="text" name="balance" id="Lack" readonly="true">
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
                            </table>
                        </div>
                        <div class="panel-footer">
                            <input type="submit" id="btn-go" name="btn-go" class="btn btn-default btn-payment">
                            <input type="button" onclick="this.form.reset()" class="btn btn-default btn-reset pull-right" value="Reset">
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

        // Run Select2 plugin on elements
        function DemoSelect2() {
            $('.s2').select2({placeholder: "Select"});
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
        function MakePDFInvoice() {
            var doc = new jsPDF();
            var elementHandler = {
                '#ignorePDF': function (element, renderer) {
                    return true;
                }
            };
            var source = $('#invoice')[0];
            doc.fromHTML(
                source,
                15,
                15,
                {
                    'width': 180, 'elementHandlers': elementHandler
                });

            doc.output("dataurlnewwindow");
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

        });

    </script>
    <script  type="text/javascript" src="{{ URL::asset('js/calculatepayment.js') }}"></script>

@endsection
