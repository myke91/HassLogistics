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
<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="invoice-table">
    <thead>
    <tr>
        <th>Vessel Name</th>
        <th>Client Name</th>
        <th>Bill Item</th>
        <th>Vat</th>
        <th>Invoice Details</th>
        <th>Invoice Date</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $key => $i)
        <tr>
            <td>{{$i->client_name}}</td>
            <td>{{$i->vessel_name}}</td>
            <td>{{$i->bill_item}}</td>
            <td>{{$i->vat}}</td>
            <td>Unit Price: {{$i->unit_price }} / Quanity: {{$i->quantity}} / Total Cost: {{$i->actual_cost}}</td>
            <td>{{$i->created_at}}</td>
            <td class="del">
                <Button value="{{$i->invoice_id}}" class="del-class"><i class="fa fa-trash-o"></i></Button>
            </td>
            <td class="del">
                <Button value="{{$i->invoice_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></Button>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>
<script type="text/javascript">
    $('table.table-datatable').each(function() {
        var currentPage = 0;
        var numPerPage = 5;
        var $table = $(this);
        $table.bind('repaginate', function() {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function(event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertAfter($table).find('span.page-number:first').addClass('active');

    });

</script>