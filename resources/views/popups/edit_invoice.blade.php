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
<div class="modal fade" id="edit-invoice-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static"
 data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Invoice</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<input type="hidden" name="invoice_id" id="invoice_id">
						<input type="hidden" name="invoice_date" value="{{date('Y-m-d')}}">
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Client Name</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="client_name" value="" disabled />
						</div>

						<label class="col-sm-2 control-label">Vessel Name</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="vessel_name" value="" disabled />
						</div>

					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Voyage Number</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="client_name" value="" disabled />
						</div>

						<label class="col-sm-2 control-label">Due Date</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="client_name" value="" disabled />
						</div>
					</div>
				</div>
				<div class="row" style="margin:20px">
					<table class="table table-bordered table-striped" id="edit-invoice-table">
						<thead>
							<tr>
								<th>Bill Item</th>
								<th>Billable</th>
								<th>Unit Price</th>
								<th>Quantity</th>
								<th>Total Price</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input class="col-sm-7" id="bill_item" name="bill_item" type="text" />
								</td>
								<td>
									<input class="col-sm-7" id="billable" name="billable" type="text" />
								</td>
								<td>
									<input class="col-sm-7" id="unit_price" name="unit_price" type="text" />
								</td>
								<td>
									<input class="col-sm-7" id="quantity" name="quantity" type="text" />
								</td>
								<td>
									<input class="col-sm-7" id="total_price" name="total_price" type="text" disabled />
								</td>

							</tr>

						</tbody>
						<tfoot>

						</tfoot>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			</div>
		</div>
	</div>
</div>
@section('additional_scripts')
<script>
	$(document).ready(
            function () {

            });

</script>
@endsection