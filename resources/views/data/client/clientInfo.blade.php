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
<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
	<thead>
		<tr>
			<th>Client Name</th>
			<th>Head Office</th>
			<th>Client Currency</th>
			<th>Client Number</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach($clients as $key => $c)
		<tr>
			<td>{{$c->client_name}}</td>
			<td>{{$c->client_head_office}}</td>
			<td>{{$c->client_currency}}</td>
			<td>{{$c->client_number}}</td>

			<td class="del">
				<Button value="{{$c->client_id}}" class="class-edit">
					<i class="fa fa-pencil-square-o"></i>
				</Button>

			</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>

	</tfoot>
</table>
<script type="text/javascript">
	//    $('table.table-datatable').each(function() {
//        var currentPage = 0;
//        var numPerPage = 5;
//        var $table = $(this);
//        $table.bind('repaginate', function() {
//            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
//        });
//        $table.trigger('repaginate');
//        var numRows = $table.find('tbody tr').length;
//        var numPages = Math.ceil(numRows / numPerPage);
//        var $pager = $('<div class="pager"></div>');
//        for (var page = 0; page < numPages; page++) {
//            $('<span class="page-number"></span>').text(page + 1).bind('click', {
//                newPage: page
//            }, function(event) {
//                currentPage = event.data['newPage'];
//                $table.trigger('repaginate');
//                $(this).addClass('active').siblings().removeClass('active');
//            }).appendTo($pager).addClass('clickable');
//        }
//        $pager.insertAfter($table).find('span.page-number:first').addClass('active');
//
//    });

function AllTables(){
    TestTable1();
    TestTable2();
    TestTable3();
    LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
    $('select').select2();
    $('.dataTables_filter').each(function(){
        $(this).find('label input[type=text]').attr('placeholder', 'Search');
    });
}
$(document).ready(function() {
    // Load Datatables and run plugin on tables
    LoadDataTablesScripts(AllTables);
    // Add Drag-n-Drop feature
    WinMove();
});

</script>