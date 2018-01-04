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
					<form id="frm-account-topup" name="frm-account-topup">
						<input id="client_id" name="client_id" class="form-control" type="hidden" />
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
					</form>
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
							<td id="acc_summary_client_name">&nbsp;</td>
						</tr>
						<tr>
							<th>Client Currency</th>
							<td id="acc_summary_client_currency">&nbsp;</td>
						</tr>
						<tr>
							<th>Account Balance</th>
							<td id="acc_summary_account_balance">&nbsp;</td>
						</tr>
						<tr>
							<th>Last Transaction Type</th>
							<td id="acc_summary_last_trans_type">&nbsp;</td>
						</tr>
						<tr>
							<th>Last Transaction Amount</th>
							<td id="acc_summary_last_trans_amount">&nbsp;</td>
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
				<span style="color: green">
					CLIENT:
					<span id="trans_history_client_name" style="font-weight: bold"></span>
				</span>
				<br />
				<span style="color: green">
					CURRENCY:
					<span id="trans_history_client_currency" style="font-weight: bold"></span>
				</span>
				<br />
				<table class="table table-bordered table-striped table-hover table-datatable" id="transaction-history">
					<thead>
						<thead>
							<th>Transaction Type</th>
							<th>Transaction Date</th>
							<th>Credit</th>
							<th>Debit</th>
							<th>Remarks</th>
						</thead>
						<tbody>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</tr>
						</tbody>
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
				<h4 class="modal-title">Initialize Payment Account</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form class="form-horizontal" role="form" id="frm-init-account">
						<div class="form-group">
							<label class="col-sm-4 control-label">Client</label>
							<div class="col-sm-6">
								<select id="client" name="client" class="s2">
									@foreach($allClients as $key =>$v)
									<option value="{{$v->client_id}}">{{$v->client_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Opening Balance</label>
							<div class="col-sm-6">
								<input id="opening_balance" name="opening_balance" class="form-control">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary init-account" type="button">Init Account</button>
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			</div>

		</div>
	</div>
</div>