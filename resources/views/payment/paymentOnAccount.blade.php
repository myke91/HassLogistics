@extends('layouts.app') @section('content') @include('popups.payment_on_account')
<style>
	.del {
		text-align: center;
		vertical-align: middle;
		width: 40px;
	}

	div.pager {
		text-align: center;
		margin: 1em 0;
	}

	div.pager span {
		display: inline-block;
		width: 1.8em;
		height: 1.8em;
		line-height: 1.8;
		text-align: center;
		cursor: pointer;
		background: #000;
		color: #fff;
		margin-right: 0.5em;
	}

	div.pager span.active {
		background: #c00;
	}
</style>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li>
				<a href="{{route('dashboard')}}">Dashboard</a>
			</li>
			<li>
				<a href="{{route('dashboard')}}">Payment</a>
			</li>
			<li>
				<a href="{{route('paymentOnAccount')}}">Payment On Account</a>
			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<button class="btn btn-primary init-payment-account">
				<i class="fa fa-money"></i>
				Init Payment Account
			</button>
		</div>
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-bank"></i>
					<span>Accounts</span>
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

			<div class="box-content no-padding">


				<table class="table table-bordered table-striped table-hover table-heading table-datatable paged" id="payment-on-account-table">
					<thead>

						<th>Client Name Number</th>
						<th>Remaining Balance</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>

					</thead>
					<tbody>
						@foreach($clients as $key => $value)
						<tr>
							<td>{{$value->client_name}}</td>
							<td>{{$value->client_name}}</td>
							<td>
								<button value="{{$value->client_id}}" class="btn btn-link topup-details">
									<i class="fa fa-credit-card"></i> Topup
								</button>
							</td>
							<td>
								<button value="{{$value->client_id}}" class="btn btn-link account-summary">
									<i class="fa fa-eur"></i> Account summary
								</button>
							</td>
							<td>
								<button value="{{$value->invoice_header_id}}" class="btn btn-link transaction-history">
									<i class="fa fa-info"></i> Transactions History
								</button>
							</td>

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

@endsection @section('additional_script')
<script type="text/javascript">
	//    showClientInfo();
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
        // Initialize datepicker\
         $('.topup-details').click(function (e) {
            e.preventDefault();
		 /*	var headerId = $('.show-invoice-details').val();
			 $.get("{{route('getInvoiceDetails')}}", {headerId: headerId}, function (data) {
                $('#invoice-details-table > tbody').empty();
                for (var i = 0, len = data.length; i < len; i++){
                $('#invoice-details-table > tbody').append(
                    '<tr>' +
                    '<td>' + data[i].bill_item + '</td>' +
                    '<td>' + data[i].billable + '</td>' +
                    '<td> Unit Price: <span>' + data[i].unit_price + '</span>' +
                    ' / Quantity:  <span>' + data[i].quantity + '</span>' +
                    ' / Total Price: <span>' + data[i].actual_cost + '</span>'
                ); 
                    } */
                $('#topup-modal').modal('show');
            /*  }).fail(function (data) {

            });  */

		});
		
		$('.account-summary').click(function (e) {
            e.preventDefault();
			/*var headerId = $('.show-invoice-details').val();
			  $.get("{{route('getInvoiceDetails')}}", {headerId: headerId}, function (data) {
                $('#invoice-details-table > tbody').empty();
                for (var i = 0, len = data.length; i < len; i++){
                $('#invoice-details-table > tbody').append(
                    '<tr>' +
                    '<td>' + data[i].bill_item + '</td>' +
                    '<td>' + data[i].billable + '</td>' +
                    '<td> Unit Price: <span>' + data[i].unit_price + '</span>' +
                    ' / Quantity:  <span>' + data[i].quantity + '</span>' +
                    ' / Total Price: <span>' + data[i].actual_cost + '</span>'
                );
                    }  */
                $('#account-summary-modal').modal('show');
            /*  }).fail(function (data) {

            });  */

		});
		
		$('.transaction-history').click(function (e) {
            e.preventDefault();
			/* var headerId = $('.show-invoice-details').val();
			 $.get("{{route('getInvoiceDetails')}}", {headerId: headerId}, function (data) {
                $('#invoice-details-table > tbody').empty();
                for (var i = 0, len = data.length; i < len; i++){
                $('#invoice-details-table > tbody').append(
                    '<tr>' +
                    '<td>' + data[i].bill_item + '</td>' +
                    '<td>' + data[i].billable + '</td>' +
                    '<td> Unit Price: <span>' + data[i].unit_price + '</span>' +
                    ' / Quantity:  <span>' + data[i].quantity + '</span>' +
                    ' / Total Price: <span>' + data[i].actual_cost + '</span>'
                );
                    }  */
                $('#transaction-history-modal').modal('show');
            /*  }).fail(function (data) {

            });  */

		});
		
		
		$('.save-account-topup').click(function (e) {
            e.preventDefault();
			/* var clientId = $('.client_id').val();
			var topupAmount = $('.topup_amount').val();
			 $.get("{{route('saveAccountTopup')}}", {clientId: clientId, topupAmount: topupAmount}, function (data) {
              
                    }  */
            /*  }).fail(function (data) {

            });  */

		});

		$('.init-payment-account').click(function (e) {
            e.preventDefault();
			$('#init-payment-account-modal').modal('show');

		});
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

</script>
@endsection