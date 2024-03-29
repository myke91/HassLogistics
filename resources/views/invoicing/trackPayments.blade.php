@extends('layouts.app') @section('content') @include('popups.track_payments')
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
					<i class="fa fa-bank"></i>
					<span>TRACK PAYMENTS ON INVOICES</span>
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
				<h4 class="page-header">SELECT CLIENT</h4>
				<form class="form-horizontal form-invoice" role="form">

					<div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Client</label>
						<div class="col-sm-6">
							<select class="s2 populate placeholder clients">
								<option>---------</option>
								@foreach($clients as $key =>$v)
								<option value="{{$v->client_id}}">{{$v->client_name}}</option>
								@endforeach
							</select>
						</div>

					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-sm-2 pull-right">
							<button class="btn btn-info btn-label-left execute" value="{{$v->client_id}}">
								<span>
									<i class="fa fa-plus-circle"></i>
								</span>
								Execute
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection @section('additional_script')
<script type="text/javascript">
	// Run Select2 plugin on elements
    function DemoSelect2() {
        $('.s2').select2({placeholder: "Select"});
    }

    $(document).ready(function () {
        LoadSelect2Script(DemoSelect2);

    }).on('click', '.execute', function (e) {
        e.preventDefault();
        $('.client-name').text($('.clients option:selected').text());
        var clientId = $('.clients option:selected').val();
        console.log(clientId);
        $.get("{{route('processPaymentTrack')}}", {id: clientId}, function (data) {
            console.log(data);
            $('#track-payments-table > tbody').empty();
            for (var i = 0, len = data.length; i < len; i++){
                $('#track-payments-table > tbody').append('<tr><td>' + data[i].invoice_no + '</td>' +
                    '<td>' + data[i].payment_currency+' '+ data[i].total_cost + '</td>' +
                    '<td style="color:green">' +data[i].payment_currency+' '+ data[i].amount_paid + '</td>' +
                    '<td  style="color:red">' +data[i].payment_currency+' '+ data[i].balance + '</td>'                  
                    );

            }
            $('#track-payments-modal').modal('show');
        }).fail(function (data) {

        });

    });

</script>
@endsection