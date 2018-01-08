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
	<button class="btn btn-link init-payment-account pull-right">
		<i class="fa fa-money"></i>
		Init Payment Account
	</button>
	<div class="col-xs-12">

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
						@foreach($accounts as $key => $value)
						<tr>
							<td>{{$value->client}}</td>
							<td>{{$value->client_currency}} {{$value->account_balance}}</td>
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
								<button value="{{$value->client_id}}" class="btn btn-link transaction-history">
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
			var id = $(this).val();
			 $.get("{{route('getDetailsForTopup')}}", {id: id}, function (data) {
				 console.log(data);
				$("#client_id").val(data.client_id);
				$("#client_name").val(data.client);
				$("#client_currency").val(data.client_currency);
				$("#account_balance").val(data.account_balance);

                $('#topup-modal').modal('show');
              }).fail(function (data) {

            });  

		});

		$('.save-account-topup').click(function (e) {
            e.preventDefault();
			var id = $(this).val();
			 $.post("{{route('saveAccountTopup')}}",$('#frm-account-topup').serialize(), function (data) {
				 console.log(data);
				swal('HASS LOGISTICS',
				'Account topup saved successfully',
				'success');
				location.reload();
			}).fail(function(data){
				swal('HASS LOGISTICS',
				data.responseText,
				'error');
			});


		});


		$('.account-summary').click(function (e) {
            e.preventDefault();
			var id = $(this).val();
			  $.get("{{route('getAccountSummary')}}", {client_id: id}, function (data) {
console.log(data);
			  $('#acc_summary_client_name').text(data.client_name);
			  $('#acc_summary_client_currency').text(data.client_currency);
			  $('#acc_summary_account_balance').text(data.account_balance); 
			  $('#acc_summary_last_trans_type').text(data.last_trans_type); 
			  $('#acc_summary_last_trans_amount').text(data.last_trans_amount);
			  $('#acc_summary_last_trans_remarks').text(data.last_trans_remarks);

            $('#account-summary-modal').modal('show');
              }).fail(function (data) {

            });  

		});
		
		$('.transaction-history').click(function (e) {
            e.preventDefault();
			 var client_id = $(this).val();
			 $.get("{{route('getTransactionHistory')}}", {client_id: client_id}, function (data) {
				 console.log(data);
				$('#trans_history_client_currency').text(data[0].client_currency);
				$('#trans_history_client_name').text(data[0].client);

                $('#transaction-history > tbody').empty();
                for (var i = 0, len = data.length; i < len; i++){
                $('#transaction-history > tbody').append(
                    '<tr>' +
                    '<td>' + data[i].transaction_type + '</td>' +
					'<td>' + data[i].transaction_date + '</td>' +
					'<td>' + data[i].credit + '</td>' +
					'<td>' + data[i].debit + '</td>' +
					'<td>' + data[i].remarks + '</td>'
                );
                    }  
                $('#transaction-history-modal').modal('show');
              }).fail(function (data) {

            });  

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
		$('.init-account').click(function (e) {
            e.preventDefault();
			$.post("{{route('initAccount')}}",$('#frm-init-account').serialize(),function(data){
				swal('HASS LOGISTICS',
				'Account Initialized Successfully',
				'success');
				location.reload();
			}).fail(function(data){
				swal('HASS LOGISTICS',
				data.responseText,
				'error');
			});

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