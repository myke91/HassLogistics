@extends('layouts.app')
@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('dashboard')}}">Invoice</a></li>
                <li><a href="{{route('add_client')}}">Invoice Modification</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-linux"></i>
                        <span>INVOICE MODIFICATION</span>
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
                <div class="box-content no-padding" id="add-invoice-info">

                </div>
            </div>
        </div>
    </div>

@endsection
@section('additional_script')
    <script type="text/javascript">
        showInvoiceInfo();
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
            $('#arrival_date').datepicker({setDate: new Date()});
            $('#departure_date').datepicker({setDate: new Date()});
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

        function showInvoiceInfo()
        {
            var data = $('#frm-create-invoice').serialize();
            console.log(data);
            $.get("{{route('showInvoiceInfo')}}",data,function (data) {
                $('#add-invoice-info').empty().append(data);
            });
        }


    </script>
@endsection


