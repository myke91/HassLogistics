<div class="modal fade" id="topup-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static"
 data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Account Topup</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<label class="col-sm-12 control-label">Client Name</label>
						<div class="col-sm-12">
							<input id="client_name" name="client_name" class="form-control" readonly="true">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12 control-label">Client Currency</label>
						<div class="col-sm-12">
							<input id="client_currency" name="client_currency" class="form-control" readonly="true">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12 control-label">Current Balance</label>
						<div class="col-sm-12">
							<input id="account_balance" name="account_balance" class="form-control" readonly="true">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-12 control-label">Topup Amount</label>
						<div class="col-sm-12">
							<input id="topup_amount" name="topup_amount" class="form-control">
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary save-account-topup" type="button">Save</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="account-summary-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static"
 data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Account Details</h4>
			</div>
			<div class="modal-body">

				<table class="table table-bordered table-striped table-hover table-datatable">
					<thead>
						<tr>
							<th>Client Name</th>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<th>Client Currency</th>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<th>Account Balance</th>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<th>Last Transaction Type</th>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<th>Last Transaction Amount</th>
							<td>&nbsp;</td>
						</tr>
					</thead>
				</table>

			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="transaction-history-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static"
 data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Transaction History</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-striped table-hover table-datatable">
					<thead>
						<thead>
							<th>Transaction Type</th>
							<th>Transaction Date</th>
							<th>Transaction Amount</th>
						</thead>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</thead>
				</table>
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="init-payment-account-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static"
 data-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Transaction History</h4>
			</div>
			<div class="modal-body">
				<div class="form-group col-sm-6">
					<label class="col-sm-6 control-label">Client</label>
						<select id="client" name="client" class="s2">
							<option></option>
						</select>
				</div>
				<div class="form-group col-sm-6">
					<label class="col-sm-6 control-label">Opening Balance</label>
					<div class="col-sm-6">
						<input id="opening_balance" name="opening_balance" class="form-control">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			</div>

		</div>
	</div>
</div>