@extends('layouts.app')
@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('chequePayments')}}">Cheque Payments</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-search"></i>
                        <span>PAYMENTS MADE BY CHEQUE</span>
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
                    <h4 class="page-header">CHEQUE PAYMENTS</h4>
                    <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="invoice-table">
                        <thead>

                        <tr>
                            <th>Vessel Name</th>
                            <th>Client Name</th>
                            <th>Bill Item</th>
                            <th>Total Cost</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Payment Details</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cheques as $c)
                        <tr>
                            <td>&nbsp;{{$c->vessel_name}}</td>
                            <td>{{$c->client_name}}&nbsp;</td>
                            <td>&nbsp;{{$c->bill_item}}</td>
                            <td>&nbsp;{{$c->actual_cost}}</td>
                            <td>{{$c->amount_paid}}&nbsp;</td>
                            <td>{{$c->balance}}&nbsp;</td>
                            <td>&nbsp;Discount: {{$c->discount}} / Payment Date: {{$c->payment_date}} /
                            Received By: {{ucfirst($c->username)}}</td>

                        </tr>

                        </tbody>
                        @endforeach
                        <tfoot>

                        </tfoot>
                    </table>
                 {{$cheques->links()}}
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

@endsection
