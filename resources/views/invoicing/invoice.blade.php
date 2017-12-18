@extends('layouts.app') @section('content') @include('popups.add_tarrif') @include('popups.edit_invoice')
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
					<i class="fa fa-search"></i>
					<span>PREPARE INVOICE</span>
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
				<h4 class="page-header">INVOICE DETAILS</h4>
				<form class="form-horizontal form-invoice" role="form">

					<div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Client</label>
						<div class="col-sm-4">
							<select class="s2 populate placeholder clients" id="client_choose">
								<option>---------</option>
								@foreach($clients as $key =>$v)
								<option value="{{$v->client_id}}">{{$v->client_name}}</option>
								@endforeach
							</select>
						</div>

					</div>

					<div class="form-group has-success has-feedback">
						<label class="col-sm-2 control-label">Vessel</label>
						<div class="col-sm-4">
							<select class="s2 populate placeholder vessels" id="vessel_choose">
								<option>---------</option>
								@foreach($vessels as $key =>$v)
								<option value="{{$v->vessel_id}}">{{$v->vessel_name}}</option>
								@endforeach
							</select>
						</div>

					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="col-sm-2">
							<button class="btn btn-info btn-label-left add-tarrif">
								<span>
									<i class="fa fa-plus-circle"></i>
								</span>
								Add Tarrif
							</button>
						</div>
						<div class="col-sm-2">
							<button class="btn btn-danger btn-label-left clear">
								<span>
									<i class="fa fa-exclamation-triangle"></i>
								</span>
								Clear
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>LIST OF ITEMS</span>
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
			<div class="box-content" id="box-content">
				<h4 class="page-header">BILL</h4>
				@if(session('success'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{{session('success')}}
				</div>
				@endif
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="invoice-table">
					<thead>
						<tr>
							<th>Vessel Name</th>
							<th>Client Name</th>
							<th>Bill Item</th>
							<th>Billable</th>
							<th>Invoice Details</th>
							<th>Invoice Date</th>
							<th colspan="3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($temp as $tr)
						<tr class="data">
							<td style="display:none;" class="inputValue">{{$tr->vessel_id}}</td>
							<td class="inputValue">{{$tr->vessel_name}}</td>
							<td style="display:none;" class="inputValue">{{$tr->client_id}}</td>
							<td style="display:none;" class="inputValue">{{$tr->invoice_no}}</td>
							<td>{{$tr->client_name}}</td>
							<td class="inputValue">{{$tr->bill_item}}</td>
							<td class="inputValue">{{$tr->billable}}</td>
							<td>
								Unit Price:
								<span class="inputValue">{{$tr->unit_price}}</span>
								/ Quantity:
								<span class="inputValue">{{$tr->quantity}}</span>
								/ Total Price:
								<span class="inputValue">{{$tr->actual_cost}}</span>

							</td>
							<td class="inputValue" style="display:none;">{{Auth::user()->id}}</td>
							<td style="display:none;" class="inputValue">{{$tr->invoice_status}}</td>
							<td class="inputValue">{{$tr->invoice_date}}</td>
							<td style="display:none;" class="inputValue">{{$tr->invoice_id}}</td>
							<td class="del">
								<button value="{{$tr->invoice_id}}" class="del-class" onclick="return confirm('Are you sure you want to delete this invoice?');">
									<i class="fa fa-trash-o"></i>
								</button>
							</td>
							<td class="del">
								<button value="{{$tr->invoice_id}}" class="invoice-edit">
									<i class="fa fa-pencil-square-o"></i>
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>

					</tfoot>
				</table>

				<div class="footer">

				</div>
			</div>

		</div>
		<div class="col-sm-2" style="float: right">

			<button class="btn btn-info btn-label-left" id="generate-invoice">
				<span>
					<i class="fa fa-money"></i>
				</span>
				Confirm and Generate Invoice
			</button>



			<form action="{{route('downloadInvoiceFile')}}">
				<input type="hidden" id="pdf-file-name" name="file" />
				<button type="submit" class="btn btn-link btn-label-left" id="download-invoice">
					<span>
						<i class="fa fa-download"></i>
					</span>
					Download Invoice
				</button>

			</form>

		</div>
	</div>
</div>



@endsection @section('additional_script')
<script type="text/javascript">
	// Run Select2 plugin on elements
    function DemoSelect2() {
        $('.s2').select2({placeholder: "Select"});
    }

    function MakeSelect2() {
        $('select').select2();
        $('.dataTables_filter').each(function () {
            $(this).find('label input[type=text]').attr('placeholder', 'Search');
        });
    }

    function invoiceNo() {
        return 'HSLINV' + Date.now();
    }

    $(document).ready(function () {
        //disable vessel dropdown and add tarrif button
        $('.vessels').attr("disabled", "disabled");
        $('.add-tarrif').attr("disabled", "disabled");
        $('.submit').attr("disabled", "disabled");
        $('.clear').attr("disabled", "disabled");
        $('#download-invoice').attr("disabled", "disabled");
        $('#generate-invoice').attr("disabled", "disabled");
        $('#invoice_no').val('HSLINV' + Date.now());


        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        $('.submit').click(function (e) {
            e.preventDefault();

        });
        $('.clients').change(function (e) {
            e.preventDefault();
            $('.vessels').removeAttr("disabled");
            var value = $('#client_choose').val();
            console.log(value);
            $.get("{{route('getVesselsForClient')}}", {id: value}, function (data) {
                console.log(data);
                $('#vessel_choose').html($('<option>').text('-------'));
                $.each(data, function (i, value) {
                    console.log(value.vessel_name);
                    $('#vessel_choose').append($('<option>').text(value.vessel_name).attr('value', value.vessel_id));
                });
            });
        });
        $('.vessels').change(function (e) {
            e.preventDefault();
            $('.vessels').attr("disabled", "disabled");
            $('.clients').attr("disabled", "disabled");
            $('.add-tarrif').removeAttr("disabled");
            $('.clear').removeAttr("disabled");
        });

    }).on('click', '.confirm-save', function (e) {
        var invoice_id = $(this).val();
        $.post("{{route('deleteInvoce')}}", {invoice_id: invoice_id}, function (data) {

        });
    }).on('click', '.save-tarrif', function (e) {
        e.preventDefault();
        console.log('received click event for additional invoice creation');
        var data = $("#frm-create-invoice").serialize();
        $.post("{{route('createTempInvoice')}}", data, function (data) {
            console.log(data);
            $('#invoice-table > tbody').append('<tr class="data"><td style="display:none;" class="inputValue">' + data.vessel_id + '</td>' +
                    '<td class="inputValue">' + data.vessel_name + '</td>' +
                    '<td style="display:none;" class="inputValue">' + data.client_id + '</td>' +
                    '<td style="display:none;" class="inputValue">' + data.invoice_no + '</td>' +
                    '<td>' + data.client_name + '</td>' +
                    '<td class="inputValue">' + data.bill_item + '</td>' +
                    '<td class="inputValue">' + data.billable + '</td>' +
                    '<td> Unit Price: <span class="inputValue">' + data.unit_price + '</span>' +
                    ' / Quantity:  <span class="inputValue">' + data.quantity + '</span>' +
                    ' / Total Price: <span class="inputValue">' + data.actual_cost + '</span>' +
                    '<span class="inputValue">' + data.id + '</span> </td>' +
                    '<td style="display:none;" class="inputValue">' + data.invoice_status + '</td>' +
                    '<td class="inputValue">' + data.invoice_date + '</td>' +
                    '<td style="display:none;" class="inputValue">' + data.invoice_id + '</td>' +
                    '<td class="del"><button value="' +
                    data.invoice_id + 'class="del-invoice"' +
                    ' onclick="return confirm(\'Are you sure you want to delete this invoice?\');">' +
                    '<i class="fa fa-trash-o"></i></button></td>' +
                    '<td class="del"><button value = "' +
                    data.invoice_id +
                    '" class="invoice-edit"><i class="fa fa-pencil-square-o"></i></button></td>'
                    );
        }).fail(function (data) {
            console.log(data);
        });
        $('#tarrif-charge-modal').trigger('reset');
        $('#tarrif-charge-modal').modal('hide');
        $('#generate-invoice').removeAttr("disabled");

    }).on('click', '#generate-invoice', function (e) {
        e.preventDefault();
        var entries = [];
        $("#invoice-table tr.data").map(function (index, elem) {
            var ret = [];
            $('.inputValue', this).each(function () {
                var d = $(this).val() || $(this).text();
                ret.push(d);
            });
            entries.push(ret);
            return ret;
        });
        console.log(entries);
        $.post("{{route('saveAllAndGenerateInvoice')}}", {data: entries}, function (data) {
            console.log(data);
            $('#download-invoice').removeAttr("disabled");
            $('#pdf-file-name').val(data.invoice);
            $('#invoice-table tbody').empty();
        }).fail(function (data) {
            console.log(data);
        });
    }).on('click', '.clear', function (e) {
        e.preventDefault();
        var entries = [];
        $("#invoice-table tr.data").map(function (index, elem) {
            var ret = [];
            $('.inputValue', this).each(function () {
                var d = $(this).val() || $(this).text();
                ret.push(d);
            });
            entries.push(ret);

        });
        console.log(entries);
        if (entries.length === 0) {
            location.reload();
        } else {
            $.post("{{route('clearTempInvoiceTable')}}", {data: entries}, function (data) {
                location.reload();

            }).fail(function (data) {
                console.log(data);
            });
        }
    });


    $(document).on('click', '.confirm-save', function (e) {
        e.preventDefault();
        var data = $("#frm-confirm-invoice").serialize();
        invoice_id = $(this).val();
        var validate = confirm("Are you sure you want to confirm this invoice? After confirming,you will not be able to edit it again");
        if (validate === true) {
            $.post("{{route('confirmInvoice')}}", data, function (data) {
                console.log(data);

            });
            $.post("{{route('deleteInvoce')}}", {invoice_id: invoice_id}, function (data) {
                console.log(data);
            });

            $('#invoiceconfirm').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
            $('#invoiceconfirm_content').html('<h4>Invoice confirmed succussfully</h4>');
            $('#modal').modal('show');
        } else {
            return false;
        }

    });
    $(document).on('click', '.del-invoice', function (e) {
        invoice_id = $(this).val();
        var validate = confirm("Are you sure you want to delete this invoice? After deleting,you will not be able to edit it again");
        if (validate === true) {
            $.post("{{route('deleteInvoce')}}", {invoice_id: invoice_id}, function (data) {
                console.log(data);
                location.reload();
            });
        } else {
            return false;
        }
    });
    $(document).on('click', '.invoice-edit', function (e) {
        $('#invoice-modal').modal('show');
        var invoice_id = $(this).val();
        $.get("{{route('editTempInvoice')}}", {invoice_id: invoice_id}, function (data) {

            $('#vessel_id').val(data.vessel_id);
            $('#client_id').val(data.client_id);
            $('#bill_item_edit').val(data.bill_item);
            $('#billable_edit').val(data.billable);
            $('#unit_price').val(data.unit_price);
            $('#quantity_edit').val(data.quantity);
            $('#actual_cost_edit').val(data.actual_cost);
            $('#invoice_id').val(data.invoice_id);
        });
    });
    $('.update-temp_invoice').on('click', function (e) {
        e.preventDefault();
        var data = $('#frm-update-invoice').serialize();
        $.post("{{route('updateTempInvoice')}}", data, function (data) {

        });

    });

</script>

<script type="text/javascript" src="{{ URL::asset('js/tarrif-form-builder.js') }}"></script>

@endsection