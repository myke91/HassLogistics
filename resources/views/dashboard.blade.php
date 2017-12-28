@extends('layouts.app') @section('content')
<!--Start Breadcrumb-->
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li>
				<a href="index.html">Home</a>
			</li>
			<li>
				<a href="#">Dashboard</a>
			</li>
		</ol>

	</div>
</div>
<!--End Breadcrumb-->
<!--Start Dashboard 1-->
<div id="dashboard-header" class="row">
	<div class="col-xs-12 col-sm-4 col-md-5">
		<h3>HASS LOGISTICS INVOICING AND PAYMENT SYSTEM</h3>
	</div>
	<div class="clearfix visible-xs"></div>
	<div class="col-xs-12 col-sm-8 col-md-7 pull-right">
		<div class="row">
			<div class="form-group has-success has-feedback">
				<div class="col-sm-12 pay-summary">
					<div class="radio-inline">
						<label>
							<input type="radio" name="radio-inline" onchange="fnSummary('full-year')" checked> Full Year
							<i class="fa fa-circle-o"></i>
						</label>
					</div>
					<div class="radio-inline">
						<label>
							<input type="radio" name="radio-inline" onchange="fnSummary('first-quarter')"> First Quarter
							<i class="fa fa-circle-o"></i>
						</label>
					</div>
					<div class="radio-inline">
						<label>
							<input type="radio" name="radio-inline" onchange="fnSummary('second-quarter')"> Second Quarter
							<i class="fa fa-circle-o"></i>
						</label>
					</div>
					<div class="radio-inline">
						<label>
							<input type="radio" name="radio-inline" onchange="fnSummary('third-quarter')"> Third Quarter
							<i class="fa fa-circle-o"></i>
						</label>
					</div>
					<div class="radio-inline">
						<label>
							<input type="radio" name="radio-inline" onchange="fnSummary('fourth-quarter')"> Fourth Quarter
							<i class="fa fa-circle-o"></i>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="sparkline-dashboard" id="sparkline-2"></div>
				<div class="sparkline-dashboard-info">
					<span class="pending-payments">GH¢ 245.12M</span>
					<span class="txt-info">PENDING</span>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="sparkline-dashboard" id="sparkline-3"></div>
				<div class="sparkline-dashboard-info">
					<span class="completed-payments">GH¢ 107.83M</span>
					<span>PAYMETNS</span>
				</div>
			</div>
		</div>
	</div>
</div>
<!--End Dashboard 1-->
<!--Start Dashboard 2-->
<div class="row-fluid">
	<div id="dashboard_links" class="col-xs-12 col-sm-2 pull-right">
		<ul class="nav nav-pills nav-stacked">
			<li class="active">
				<a href="#" class="tab-link" id="overview">Overview</a>
			</li>
			<li>
				<a href="#" class="tab-link" id="clients">Clients</a>
			</li>
			<li>
				<a href="#" class="tab-link" id="vessels">Vessels</a>
			</li>
			<li>
				<a href="#" class="tab-link" id="payments">Payments</a>
			</li>
		</ul>
	</div>
	<div id="dashboard_tabs" class="col-xs-12 col-sm-10">
		<!--Start Dashboard Tab 1-->
		<div id="dashboard-overview" class="row" style="visibility: visible; position: relative;">
			<div id="ow-marketplace" class="col-sm-12 col-md-6">
				<div id="ow-setting">
					<a href="#">
						<i class="fa fa-folder-open"></i>
					</a>
					<a href="#">
						<i class="fa fa-credit-card"></i>
					</a>
					<a href="#">
						<i class="fa fa-ticket"></i>
					</a>
					<a href="#">
						<i class="fa fa-bookmark-o"></i>
					</a>
					<a href="#">
						<i class="fa fa-globe"></i>
					</a>
				</div>
				<h4 class="page-header">RECENT USER ACTIVITY</h4>
				<table id="ticker-table" class="table m-table table-bordered table-hover table-heading">
					<thead>
						<tr>
							<th>User</th>
							<th>Activity</th>

						</tr>
					</thead>
					<tbody>
						@foreach($audits as $key=>$value)
						<tr>
							<td class="m-ticker">
								<b>{{$value->user}}</b>
								<span>{{$value->name}}</span>
							</td>
							<td class="m-price">{{$value->activity}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-md-6">
				<div id="ow-donut" class="row">
					<div class="col-xs-4">
						<div id="morris_donut_1" style="width:120px;height:120px;"></div>
					</div>
					<div class="col-xs-4">
						<div id="morris_donut_2" style="width:120px;height:120px;"></div>
					</div>
					<div class="col-xs-4">
						<div id="morris_donut_3" style="width:120px;height:120px;"></div>
					</div>
				</div>

				<div id="ow-summary" class="row">
					<div class="col-xs-12">
						<h4 class="page-header">&Sigma; SUMMARY</h4>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-6">Total clients
										<b>{{$totalClients}}</b>
									</div>
									<div class="col-xs-6">Total vessels
										<b>{{$totalVessels}}</b>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--End Dashboard Tab 1-->
		<!--Start Dashboard Tab 2-->
		<div id="dashboard-clients" class="row" style="visibility: hidden; position: absolute;">
			<div class="row one-list-message">
				<div class="col-xs-1">
					<i class="fa fa-users"></i>
				</div>
				<div class="col-xs-2">
					<b>Name</b>
				</div>
				<div class="col-xs-2">Head Office</div>
				<div class="col-xs-3">Email</div>
				<div class="col-xs-2">Contact Number</div>
				<div class="col-xs-2">Digital Address</div>
			</div>
			<div class="row one-list-message">
				@foreach($clients as $key => $value)
				<div class="col-xs-1">
					<i class="fa fa-user"></i>
				</div>
				<div class="col-xs-2">
					<b>{{$value->client_name}}</b>
				</div>
				<div class="col-xs-2">{{$value->client_head_office}}</div>
				<div class="col-xs-3">{{$value->client_email}}</div>
				<div class="col-xs-2"> {{$value->client_number}}</div>
				<div class="col-xs-2">{{$value->client_digital_address}}</div>
				@endforeach
			</div>

		</div>
		<!--End Dashboard Tab 2-->
		<!--Start Dashboard Tab 3-->

		<div id="dashboard-vessels" class="row" style="visibility: hidden; position: absolute;">
			<div class="row one-list-message">
				<div class="col-xs-1">
					<i class="fa fa-users"></i>
				</div>
				<div class="col-xs-2">
					<b>Name</b>
				</div>
				<div class="col-xs-2">Flag</div>
				<div class="col-xs-2">Vessel Operator</div>
				<div class="col-xs-1">Arrival</div>
				<div class="col-xs-1">Departure</div>
			</div>
			<div class="row one-list-message">
				@foreach($vessels as $key => $value)
				<div class="col-xs-1">
					<i class="fa fa-user"></i>
				</div>
				<div class="col-xs-2">
					<b>{{$value->vessel_name}}</b>
				</div>
				<div class="col-xs-2">{{$value->vessel_flag}}</div>
				<div class="col-xs-2">{{$value->operator_name}}</div>
				<div class="col-xs-1 message-date">{{$value->arrival_date}}</div>
				<div class="col-xs-1 message-date">{{$value->departure_date}}</div>
				@endforeach
			</div>

		</div>
		<!--End Dashboard Tab 3-->
		<!--Start Dashboard Tab 4-->
		<div id="dashboard-payments" class="row" style="visibility: hidden; position: absolute;">
			<div class="row one-list-message">
				<div class="col-xs-1">
					<i class="fa fa-users"></i>
				</div>
				<div class="col-xs-2">
					<b>Name</b>
				</div>
				<div class="col-xs-2">Head Office</div>
				<div class="col-xs-2">Email</div>
				<div class="col-xs-2">Contact Number</div>
				<div class="col-xs-2">Digital Address</div>
				<div class="col-xs-2">Date</div>
			</div>
			<div class="row one-list-message">
				<div class="col-xs-1">
					<i class="fa fa-user"></i>
				</div>
				<div class="col-xs-2">
					<b>USA</b>
				</div>
				<div class="col-xs-2">109455</div>
				<div class="col-xs-2">54322344</div>
				<div class="col-xs-2">
					<i class="fa fa-usd"></i> 354563</div>
				<div class="col-xs-2"></div>
				<div class="col-xs-2 message-date">12/31/13</div>
			</div>

		</div>
		<!--End Dashboard Tab 4-->
	</div>
	<div class="clearfix"></div>
</div>
<!--End Dashboard 2 -->
<div style="height: 40px;"></div>

@endsection @section('additional_script')
<script type="text/javascript">
	$(document).ready(function () {
        $.get("{{route('ready')}}", function () {
        });
    });


	function fnSummary(value){
console.log(value);
$.get("{{route('paymentSummary')}}",{val: value},function(data){
	console.log(data);
	$('.pending-payments').val('GH¢ '+data.pendingPayments);
	$('.completed-payments').val('GH¢ '+data.completedPayments);

});
	}
// Array for random data for Sparkline
    var sparkline_arr_1 = SparklineTestData();
    var sparkline_arr_2 = SparklineTestData();
    var sparkline_arr_3 = SparklineTestData();
    $(document).ready(function () {
        // Make all JS-activity for dashboard
        DashboardTabChecker();
        // Load Knob plugin and run callback for draw Knob charts for dashboard(tab-servers)
        LoadKnobScripts(DrawKnobDashboard);
        // Load Sparkline plugin and run callback for draw Sparkline charts for dashboard(top of dashboard + plot in tables)
        LoadSparkLineScript(DrawSparklineDashboard);
        // Load Morris plugin and run callback for draw Morris charts for dashboard
        LoadMorrisScripts(MorrisDashboard);

        // Make beauty hover in table
        $("#ticker-table").beautyHover();

    });

</script>
@endsection