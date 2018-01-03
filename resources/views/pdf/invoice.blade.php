<!Doctype html>
<html>
<style>
	html,
	body {
		margin: 0;
		padding: 0;
		height: 100%;
		background: linear-gradient(#000, #899);
	}

	#container {
		min-height: 100%;
		position: relative;
	}

	#header {
		padding: 10px;
	}

	#body {
		padding: 10px;
		padding-bottom: 60px;
		/* Height of the footer */
	}

	#footer {
		position: absolute;
		bottom: 0;
		width: 100%;
		height: 150px;
	}
</style>

<body>
	<div id="header">
		<table border="0" width="100%">
			<tr>
				<td>
					<p style="font-weight:bolder">
						<span style="color: #ff2d55">H</span>
						<span style="color: #20895e">A</span>
						<span style="color: #F4C63D">S</span>
						<span style="color: #0066ff">S</span>
						<span style="color: #265186">LOGISTICS</span>
					</p>
					<span>Meridian Roundabout, Main Harbour</span>
					<br />
					<span>Community 1, Tema</span>
					<br />
					<span>+233 303 220 181-2</span>
					<br />
					<span>
						<a href="mailto:operations@hasslogistics.com?subject=Invoice%20Enquiry">operations@hasslogistics.com</a>
					</span>
					<br />
					<span>
						<a href="mailto:info@hasslogistics.com?subject=Invoice%20Enquiry">info@hasslogistics.com</a>
					</span>
					<br />
				</td>
				<td>
					<center>
						<img src="{{public_path()}}\img\hlg-logo.png" />
						<span>
							<small>
								<i>[Local Knowledge,Our Strength]</i>
							</small>
						</span>
					</center>
				</td>

				<td>
					<span>Invoice No: {{$data[0]->invoice_no}} </span>
					<br />
					<span>Date: {{date('d-M-Y')}}</span>
					<br />
					<span>Customer: {{$data[0]->client}}</span>
					<br />
				</td>
			</tr>
		</table>
	</div>
	<br />
	<div id="client-information">
		<table border="0" width="100%">
			<tr>
				<td>TO:</td>
				<td>{{$data[0]->client_name}}</td>
			</tr>
			<tr>
				<td style="text-align:top">
					ATTN:
				</td>
				<td>
					<span>{{$data[0]->client_head_office}} </span>
					<br />
					<span> {{$data[0]->client_office_desc}}</span>
					<br />
					<span> {{$data[0]->client_email}}</span>
					<br />
					<span> {{$data[0]->client_number}}</span>
					<br />
					<span> {{$data[0]->client_digital_address}}</span>
				</td>
			</tr>
		</table>
	</div>

	<br />
	<div id="body">



		<table border="1" width="100%">
			<tr>
				<td>Vessel: {{$data[0]->vessel}}</td>
				<td>ETA: {{$data[0]->arrival_date}}</td>
				<td>Port of Loading: {{$data[0]->port_of_loading}}</td>
			</tr>

			<tr>
				<td>Voyage: {{$data[0]->voyage_number}}</td>
				<td>ETS: {{$data[0]->departure_date}}</td>
				<td>Port of Discharge: {{$data[0]->port_of_discharge}}</td>
			</tr>
		</table>

		<p border="1">BL NO: {{$data[0]->bl_no}}</p>
		<?php
            $total = 0;
            $i = 0
            ?>
			<table border="1" width="100%">
				<tbody>
					<tr>
						<td>Item No.</td>
						<td>Description</td>
						<td>Billable</td>
						<td style="text-align:right">Quantity</td>
						<td style="text-align:right">Unit Price</td>
						<td style="text-align:right">Amount GH¢</td>
					</tr>
					@foreach($data as $key => $value)
					<tr>
						<td>{{++$i}}.</td>
						<td>{{$value->bill_item}}</td>
						<td>{{$value->billable}}</td>
						<td style="text-align:right">{{$value->quantity}}</td>
						<td style="text-align:right">{{$value->unit_price}}</td>
						<td style="text-align:right">{{$value->actual_cost}}</td>
					</tr>
					<?php $total += $value->actual_cost ?> @endforeach


				</tbody>
				<tfoot>
					<tr>
						<td colspan="5" style="text-align:right">SUBTOTAL</td>
						<td style="text-align:right">GH¢ {{ number_format($total,2)}}</td>
					</tr>
					<?php
                        $vatValue = $total / ($vat->value * 100);
                        $grandTotal = $vatValue + $total;
                        ?>
						<tr>
							<td colspan="5" style="text-align:right">VAT/NHIL</td>
							<td style="text-align:right">GH¢ {{number_format($vatValue,2)}}</td>
						</tr>
						<tr>

							<td colspan="5" style="text-align:right">TOTAL</td>
							<td style="text-align:right">GH¢ {{number_format($grandTotal,2)}}</td>
						</tr>
				</tfoot>
			</table>
	</div>
	<br />

	<div id="footer" style="font-weight:bold; padding: 20px">
		@foreach($data as $d)
		@if($d->client_currency == 'GHS')
		<div id="local-currency-details">
			<span>
				<u>BANK DETAILS:</u>
			</span>
			<br />
			<span>BANK: PRUDENTIAL BANK LIMITED</span>
			<br />
			<span>COMMUNITY 1 BRANCH, TEMA</span>
			<br />
			<span>ACCOUNT NAME: HASS LOGISTICS GHANA LIMITED</span>
			<br />
			<span>ACCOUNT NO-GHS: 0122001600013</span>
			<br />
			<br />
		</div>
		@else
		<div id="foreign-currency-details">
			<span>
				<u>BANK DETAILS:</u>
			</span>
			<br />
			<span>BANK: CREDITSUISSE</span>
			<br />
			<span>IBAN: CH13 0486 6257 6006 8200 0</span>
			<br />
			<span>CURRENCY: USD</span>
			<br />
			<span>
				ACCOUNT NAME: HASS LOGISTICS GHANA LIMITED
				<br />CIF 0835-2576006-8
			</span>
			<span> SWIFT: CRESCHZH </span>
			<br />
			<br />
		</div>
		@endif
		@endforeach
		<div style="font-weight: normal; text-align: center">
			<small>Make all cheques payable to HASS Logistics Ghana Limited</small>
			<br/>
			<strong>THANK YOU FOR YOUR BUSINESS!</strong>
		</div>
	</div>
</body>

</html>