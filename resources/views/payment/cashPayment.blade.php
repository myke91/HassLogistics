@extends('layouts.app')
@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('cashPayments')}}">Cash Payments</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                            <i class="fa fa-th-list"></i>
                        <span>PAYMENTS MADE BY CASH</span>
                    </div>
                    <div class="box-icons">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="expand-link">
                            <i class="fa fa-expand"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                    <div class="no-move"></div>
                </div>
                <div class="box-content no-padding">
                    <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
                        <thead>
                        <tr>
                            <th>Vessel Name</th>
                            <th>Client Name</th>
                            <th>Currency</th>
                            <th>Total Cost</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Payment Details</th>
                            <th>&nbsp;</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cash as $c)
                            <tr>
                                <td>&nbsp;{{$c->vessel_name}}</td>
                                <td>{{$c->client_name}}&nbsp;</td>
                                <td>{{$c->voyage_number}}</td>
                                <td>{{$c->payment_currency}}</td>
                                <td style="text-align:right">{{$c->total_cost}}</td>
                                <td style="text-align:right">{{$c->amount_paid}}</td>
                                <td style="text-align:right">{{$c->balance}}</td>
                                <td> Payment Date: {{$c->payment_date}} / &nbsp;Discount: {{$c->discount}} /
                                    Received By: {{ucfirst($c->username)}}</td>
                                    <td><button class="btn btn-link" value="{{$c->payment_id}}">
                                        <i class="fa fa-archive"></i>
                                    Payment History    
                                    </button></td>
                            </tr>
                        @endforeach
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
        function AllTables(){
            TestTable1();
            TestTable2();
            TestTable3();
            LoadSelect2Script(MakeSelect2);
        }
        function MakeSelect2(){
            $('select').select2();
            $('.dataTables_filter').each(function(){
                $(this).find('label input[type=text]').attr('placeholder', 'Search');
            });
        }
        $(document).ready(function() {
            // Load Datatables and run plugin on tables
            LoadDataTablesScripts(AllTables);
            // Add Drag-n-Drop feature
            WinMove();
        });
    </script>

@endsection
