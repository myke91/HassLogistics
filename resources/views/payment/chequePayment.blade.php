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
                            <i class="fa fa-th-list"></i>
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
                    <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
                        <thead>

                        <tr>
                            <th>Vessel Name</th>
                            <th>Client Name</th>
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
                            <td>&nbsp;{{$c->total_cost}}</td>
                            <td>{{$c->amount_paid}}&nbsp;</td>
                            <td>{{$c->total_cost - $c->amount_paid }}&nbsp;</td>
                            <td>&nbsp;Discount: {{$c->discount}} / Payment Date: {{$c->payment_date}} /
                            Received By: {{ucfirst($c->username)}}</td>

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
