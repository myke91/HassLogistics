<style>
	.del {
		text-align: center;
		vertical-align: middle;
		width: 40px;
	}
</style>
<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="exchange-rates-table">
	<thead>
		<tr>
			<th>Currency</th>
			<th>Selling Price</th>
			<th>Buying Price</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($exchangeRates as $key => $c)
		<tr>
			<td>{{$c->currency}}</td>
			<td>{{$c->selling_price}}</td>
			<td>{{$c->buying_price}}</td>
			<td class="del">
				<Button value="{{$c->exchange_rate_id}}" class="del-class">
					<i class="fa fa-pencil-o"></i>
				</Button>
			</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>

	</tfoot>
</table>