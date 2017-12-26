@extends('layouts.app') @section('content') @include('data.exchange_rate.edit_exchange_rate')
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
				<a href="{{route('addExchangeRate')}}">Add Exchange Currency</a>
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
					<span>CREATE NEW EXCHANGE CURRENCY</span>
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
				<h4 class="page-header">EXCHANGE RATES</h4>

				<form class="form-horizontal" role="form" id="frm-create-exchange-rate" action="{{route('createExchangeRate')}}">
					<div class="form-group has-success">
						<label class="col-sm-2 control-label">Currency</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="currency" name="currency" required>
						</div>
					</div>
					<div class="form-group has-success">
						<label class="col-sm-2 control-label">Selling Price</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="selling_price" name="selling_price" required>
						</div>
					</div>
					<div class="form-group has-success">
						<label class="col-sm-2 control-label">Buying Price</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="buying_price" name="buying_price" required>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-success btn-sm">Save Exchange Currency</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-th-list"></i>
					<span>EXCHANGE RATES LIST</span>
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
			<div class="box-content no-padding" id="add-exchange-rate-info">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="vessel-table">
					<thead>
						<tr>
							<th>Currency</th>
							<th>Selling Price</th>
							<th>Buying Price</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($exchange_rates as $key => $v)
						<tr>
							<td>{{$v->currency}}</td>
							<td>{{$v->selling_price}}</td>
							<td>{{$v->buying_price}}</td>
							<td class="del">
								<Button value="{{$v->exchange_rate_id}}" class="vo-edit">
									<i class="fa fa-pencil-square-o"></i>
								</Button>
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
	// Run Datables plugin and create 3 variants of settings
    function AllTables() {
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
    $(document).ready(function () {
        $.get("{{route('ready')}}", function () {
        });
    });

    $('#frm-create-exchange-rate').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url, data, function (data) {
			showExchangeRates();
			swal('HASS LOGISTICS',
			'Exchange currency saved successfully',
			'success');
			$(this).trigger('reset');
        }).fail(function(){
			swal('HASS LOGISTICS',
			'An error occured',
			'error');
		});
            
    });

    $(document).on('click', '.vo-edit', function (e) {
        $('#exchange-rate-show').modal('show');
        var exchange_rate_id = $(this).val();
        $.get("{{route('editExchangeRate')}}", {exchange_rate_id: exchange_rate_id}, function (data) {
            console.log(data);
            $('#currency_edit').val(data.currency);
            $('#selling_price_edit').val(data.selling_price);
            $('#buying_price_edit').val(data.buying_price);
            $('#exchange_rate_id_edit').val(data.exchange_rate_id);

        });
    });

    $('.btn-update-vo').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-vo').serialize();
        $.post("{{route('updateExchangeRate')}}", data, function (data) {
        });
        $('#clientupdatemessages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#clientupdatemessages_content').html('<h4>Vessel operator updated successfully</h4>');
        $('#modal').modal('show');
        $('#frm-update-class').trigger('reset');

       // location.reload();
    });
	function showExchangeRates()
    {
        var data = $('#frm-create-exchange-rate').serialize();
        console.log(data);
        $.get("{{route('exchangeRate')}}", function (data) {
            $('#add-exchange-rate-info').empty().append(data);
        });
    }

</script>
@endsection