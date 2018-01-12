@extends('layouts.app') @section('content') @include('popups.edit_invoice')
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
				<a href="#">Invoice</a>
			</li>
			<li>
				<a href="{{route('getUnapprovedInvoices')}}">Unapproved Invoices</a>
			</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-thumbs-down"></i>
					<span>UNAPPROVED INVOICES</span>
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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable paged" id="datatable-3">
					<thead>
						<tr>
							<th>Client Name</th>
							<th>Vessel Name</th>
							<th>Voyage Number</th>
							<th>Invoice Number</th>
							<th>Total Amount</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $key => $value)
						<tr>
							<td>{{$value->client}}</td>
							<td>{{$value->vessel}}</td>
							<td>{{$value->voyage_number}}</td>
							<td>{{$value->invoice_no}}</td>
                            <td>{{$value->invoice_currency}} {{$value->total_amount}}</td>
							<td>
								<button value="{{$value->invoice_header_id}}" class="btn btn-link edit-invoice">
									<i class="fa fa-list"></i>
									View Details
								</button>
							</td>
							<td>
									<button value="{{$value->invoice_header_id}}" class="btn btn-link approve-invoice">
										<i class="fa fa-check"></i>
										Approve Invoice
									</button>
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
	//    showClientInfo();
    function DemoSelect2() {
        $('#s2_with_tag').select2({placeholder: "Select OS"});
        $('#s2_country').select2();
    }
    // Run timepicker
    function DemoTimePicker() {
        $('#input_time').timepicker({setDate: new Date()});
    }
    // Run Datables plugin and create 3 variants of settings
    function AllTables() {
        TestTable1();
        TestTable2();
        TestTable3();
        LoadSelect2Script(MakeSelect2);
    }
    function MakeSelect2() {
        $('select').select2();
        $('.dataTables_filter').each(function () {
            $(this).find('label input[type=text]').attr('placeholder', 'Search');
        });
    }
    $(document).ready(function () {
		$('.edit-invoice').click(function (e) {
            e.preventDefault();
			{{--  var headerId = $('.show-invoice-details').val();
			 $.get("{{route('getInvoiceDetails')}}", {headerId: headerId}, function (data) {
                $('#invoice-details-table > tbody').empty();
                for (var i = 0, len = data.length; i < len; i++){
                $('#invoice-details-table > tbody').append(
                    '<tr>' +
                    '<td>' + data[i].bill_item + '</td>' +
                    '<td>' + data[i].billable + '</td>' +
                    '<td> Unit Price: <span>' + data[i].unit_price + '</span>' +
                    ' / Quantity:  <span>' + data[i].quantity + '</span>' +
                    ' / Total Price: <span>' + data[i].actual_cost + '</span>'
                );
                }  --}}
                $('#edit-invoice-modal').modal('show');

            {{--  }).fail(function (data) {

            });  --}}

		});
		
         $('.approve-invoice').click(function (e) {
            e.preventDefault();
			var headerId = $('.approve-invoice').val();
			console.log(headerId);
            $.post("{{route('approveInvoice')}}", {id: headerId}, function (data) {
               swal('HASS LOGISTICS',
               'Invoice approved successfully',
               'success');
            }).fail(function (data) {
				console.log(data.responseText);
                swal('HASS LOGISTICS',
                data.responseText,
                'error')
            });

        });
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Load Datatables and run plugin on tables
        LoadDataTablesScripts(AllTables);
        // Add drag-n-drop feature to boxes
        WinMove();
    });

    function showClientInfo()
    {
        $.get("{{route('showInvoiceInfo')}}", '', function (data) {
            $('#add-invoice-info').empty().append(data);
        });
    }


</script>
@endsection