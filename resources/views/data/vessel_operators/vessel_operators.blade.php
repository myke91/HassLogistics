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
        <th>Operator id</th>
        <th>Operator Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($vessel_operators as $key => $v)
        <tr>
            <td>{{$v->vessel_operator_id}}</td>
            <td>{{$v->operator_name}}</td>
            <td class="del">
                <Button value="{{$v->vessel_operator_id}}" class="vo-edit"><i class="fa fa-pencil-square-o"></i></Button>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>


