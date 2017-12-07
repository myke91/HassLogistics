<style>
    .del{
        text-align: center;
        vertical-align: middle;
        width: 40px;

    }
</style>
<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="vessel-table">
    <thead>
        <tr>
            <th>Tarrif Name</th>
            <th>Tarrif Type Code</th>
            <th>Tarrif Type Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tarrifTypes as $key => $value)
        <tr>
            <td>{{$value->tarrif_name}}</td>
            <td>{{$value->tarrif_type_code}}</td>
            <td>{{$value->tarrif_type_name}}</td>
            
            <td class="del">
                <Button value="{{$value->tarrif_type_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></Button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>


