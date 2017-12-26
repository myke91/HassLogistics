@extends('layouts.app') @section('content') @include('payment.styles.css-payment')
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li>
				<a href="/">Dashboard</a>
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>SEARCH FOR PAYMENT BY INVOICE NUMBER</span>
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
			<form name="frm-search-payment" id="frm-search-payment" action="{{route('showPayment')}}">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="col-md-3">
						<label class="date-invoice">Date:
							<b>{{date('d-M-Y')}}</b>
						</label>
					</div>
				</div>
				@if(session('error'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{session('error')}}
				</div>
				@endif
				<div class="panel-body">
					<table style="margin-top: 12px;">
						<thead>
							<tr>
								<td>Invoice Number</td>
								<td>Client</td>
								<td>Vessel</td>
								<td>Voyage Number</td>
							</tr>
						</thead>
						<tbody>
							<tr>

								<td>
									<select id="invoice_no" name="invoice_no" class="s2 invoices">
										<option value=""> </option>
										@foreach($invoices as $key => $value)
										<option value="{{$value->invoice_no}}">{{$value->invoice_no}}</option>
										@endforeach
									</select>
								</td>
								<td>
									<select id="client_id" name="client_id" class="s2">
										<option value=""> </option>
										@foreach($clients as $key => $value)
										<option value="{{$value->client_id}}">{{$value->client_name}}</option>
										@endforeach
									</select>
								</td>
								<td>
									<select id="vessel_id" name="vessel_id" class="s2">
										<option value=""> </option>
									</select>

								</td>
								<td>
									<select id="voyage_number" name="voyage_number" class="s2">
										<option value=""> </option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<input type="button" class="btn btn-default btn-reset" value="Reset">
					<input type="submit" id="search-payment" name="search-payment" class="btn btn-default pull-right" value="Search">
				</div>
		</div>
		</form>
	</div>
</div>
</div>

@endsection @section('additional_script')
<script type="text/javascript">
	function DemoSelect2() {
            $('.s2').select2({placeholder: "Select"});
        }

        $(document).ready(function () {
            $.get("{{route('ready')}}", function () {});

            $('.form-control').tooltip();
            LoadSelect2Script(DemoSelect2);
            $('#input_date').datepicker({setDate: new Date()});
            // Load Timepicker plugin
            // LoadTimePickerScript(DemoTimePicker);

            // Add tooltip to form-controls
            $('.form-control').tooltip();

            $('.submit').click(function (e) {
                e.preventDefault();
            });
            $('#client_id').change(function (e) {
                e.preventDefault();
                var value = $('#client_id').val();
                $.get("{{route('getVesselsForClient')}}", {id: value}, function (data) {
                    $.each(data, function (i, value) {
                        $('#vessel_id').append($('<option>').text(value.vessel_name).attr('value', value.vessel_id));
                    });
                });
            });
            $('#vessel_id').change(function (e) {
                e.preventDefault();                
                var value = $('#vessel_id').val();
                $.get("{{route('getVoyageNumbersForVessel')}}", {id: value}, function (data) {
                    $.each(data, function (i, value) {
                        $('#voyage_number').append($('<option>').text(value.voyage_number).attr('value', value.voyage_number));
                    });
                });
            });
        }).on('click', '#search-payment', function (e) {
            e.preventDefault();
            var invoice_no = $('#invoice_no option:selected').val();
            var client_id = $('#client_id option:selected').val();
            var vessel_id = $('#vessel_id option:selected').val();
            var voyage_number = $('#voyage_number option:selected').val();
            console.log(invoice_no);
            $('#frm-search-payment').submit();
            
        }).on('click','.btn-reset',function(e){
            e.preventDefault();
            console.log('triggering reset');
            $('#frm-search-payment').trigger('reset');
        });

</script>
@endsection