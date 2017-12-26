<!Doctype html>
<html>
<div>
	<center>
		<img src="{{public_path()}}\img\hlg-logo.png" />
	</center>
	<br/>
	<table width="100%">
		<tbody>
			<tr>
				<td>
					<span>Received From:{{$client->client_name}}</span>
					<br/>
					<span>Location: {{$client->client_head_office}}</span>
					<br/>
					<span>Tel: {{$client->client_number}}</span>
					<br/>
					<span>Email:{{$client->client_email}} </span>
				</td>
				<td>
					<span>Receipt No. {{$data->receipt_no}}</span>
					<br/>
					<span>Issue Date {{date('d-M-Y')}} </span>
				</td>
			</tr>
		</tbody>
	</table>
	<br/>

	<div>
		PAYMENT FOR:
		<span>{{$data->vessel_name}}</span>
	</div>
	<br/>
	<div>
		AMOUNT:
		<span>
			<strong>
				<i>GHC {{$data->amount}}</i>
			</strong>
		</span>
		<br/>
		<span>
			<small>
				<i>[{{$data->amount_in_words}} ghana cedis]</i>
			</small>
		</span>
	</div>

	<br/>
	<br/>
	<table width="100%">
		<tbody>
			<tr>
				<td>
					Paid By:{{$data->payment_mode}}
				</td>
				<td style="text-align:right">
					Received By:{{$data->username}}
				</td>
			</tr>
		</tbody>
	</table>
	<br/>

	<table border="1" width="100%" style="float:right">
		<tr>
			<td width="80%" style="text-align: right;">Total Amount</td>
			<td style="text-align: right;">GH¢ {{$data->total_cost}} </td>
		</tr>
		<tr>
			<td width="80%" style="text-align: right;">This Payment</td>
			<td style="text-align: right;">GH¢ {{$data->amount}} </td>
		</tr>
		<tr>
			<td width="80%" style="text-align: right;">Balance Due</td>
			<td style="text-align: right;">GH¢ {{$data->balance}}</td>
		</tr>
	</table>

</div>
<br />
<br />
<br />
<br />
<br />
<br />
<div style="border: dotted 1px #f00; margin: 10px"></div>


<div style="padding-top: 50px">
	<center>
		<img src="{{public_path()}}\img\hlg-logo.png" />
	</center>
	<br/>
	<table width="100%">
		<tbody>
			<tr>
				<td>
					<span>Received From: {{$client->client_name}}</span>
					<br/>
					<span>Location: {{$client->client_head_office}}</span>
					<br/>
					<span>Tel: {{$client->client_number}}</span>
					<br/>
					<span>Email: {{$client->client_email}} </span>
				</td>
				<td>
					<span>Receipt No. {{$data->receipt_no}}</span>
					<br/>
					<span>Issue Date {{date('d-M-Y')}} </span>
				</td>
			</tr>
		</tbody>
	</table>
	<br/>

	<div>
		PAYMENT FOR:
		<span>{{$data->vessel_name}}</span>
	</div>
	<br/>
	<div>
		AMOUNT:
		<span>
			<strong>
				<i>GHC {{$data->amount}}</i>
			</strong>
		</span>
		<br/>
		<span>
			<small>
				<i>[{{$data->amount_in_words}} ghana cedis]</i>
			</small>
		</span>
	</div>

	<br/>
	<br/>
	<table width="100%">
		<tbody>
			<tr>
				<td>
					Paid By:{{$data->payment_mode}}
				</td>
				<td>
					Received By:{{$data->username}}
				</td>
			</tr>
		</tbody>
	</table>
	<br/>

	<table border="1" width="100%" style="float:right">
		<tr>
			<td width="80%" style="text-align: right;">Total Amount</td>
			<td style="text-align: right;">GH¢ {{$data->total_cost}} </td>
		</tr>
		<tr>
			<td width="80%" style="text-align: right;">This Payment</td>
			<td style="text-align: right;">GH¢ {{$data->amount}} </td>
		</tr>
		<tr>
			<td width="80%" style="text-align: right;">Balance Due</td>
			<td style="text-align: right;">GH¢ {{$data->balance}}</td>
		</tr>
	</table>
</div>
<center>
	<span>
		<i>
			<small>
				<strong>THANK YOU FOR YOUR BUSINESS</strong>
			</small>
		</i>
	</span>
</center>

</html>