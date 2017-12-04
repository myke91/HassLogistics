<style>
    .del{
        text-align: center;
        vertical-align: middle;
        width: 40px;

    }
</style>
<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="tarrif-table">
    <thead>
        <tr>
            <th>Tarrif Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tarrifs as $key => $value)
        <tr>
            <td>{{$value->tarrif_name}}</td>           
            <td class="del">
                <Button value="{{$value->tarrif_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></Button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>


