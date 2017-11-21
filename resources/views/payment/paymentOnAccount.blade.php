@extends('layouts.app')
@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('paymentOnAccount')}}">Payments On Account</a></li>
            </ol>
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
