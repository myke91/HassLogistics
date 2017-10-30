@extends('layouts.app')
@section('content')
@include('popups.add_tarrif')

<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
</style>
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
                            <select class="s2 populate placeholder">
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
                            <select class="s2 populate placeholder">
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
                                <span><i class="fa fa-clock-o"></i></span>
                                Add Tarrif
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary btn-label-left submit">
                                <span><i class="fa fa-clock-o"></i></span>
                                Generate
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-------------------------------------------------------------------->
<!--
DISPLAY TABLE
-->
<!--------------------------------------------------------------------->
<div id="invoice" class="row invoice-box" style="display:none">
    <div class="col-xs-12">
        <div class="box">
            <table cellpadding="0" cellspacing="0">
<!--                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    Image here
                                    <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                                </td>

                                <td>
                                    Invoice #: 123<br>
                                    Created: January 1, 2015<br>
                                    Due: February 1, 2015
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Sparksuite, Inc.<br>
                                    12345 Sunny Road<br>
                                    Sunnyville, CA 12345
                                </td>

                                <td>
                                    Acme Corp.<br>
                                    John Doe<br>
                                    john@example.com
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>-->

                <tr class="heading">
                    <td>
                        Payment Method
                    </td>

                    <td>
                        Check #
                    </td>
                </tr>

                <tr class="details">
                    <td>
                        Check
                    </td>

                    <td>
                        1000
                    </td>
                </tr>

                <tr class="heading">
                    <td>
                        Item
                    </td>

                    <td>
                        Price
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        Website design
                    </td>

                    <td>
                        $300.00
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        Hosting (3 months)
                    </td>

                    <td>
                        $75.00
                    </td>
                </tr>

                <tr class="item last">
                    <td>
                        Domain name (1 year)
                    </td>

                    <td>
                        $10.00
                    </td>
                </tr>

                <tr class="total">
                    <td></td>

                    <td>
                        Total: $385.00
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

@section('additional_script')
<script type="text/javascript">
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
        // Add drag-n-drop feature to boxes
        WinMove();
    });
</script>
<script  type="text/javascript" src="{{ URL::asset('js/tarrif-form-builder.js') }}"></script> 
@endsection
