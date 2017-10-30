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
            <th>Vessel Name</th>
            <th>Operator Name</th>
            <th>Vessel Owner</th>
            <th>Vessel Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vessels as $key => $v)
        <tr>
            <td>{{$v->vessel_name}}</td>
            <td>{{$v->operator_name}}</td>
            <td>{{$v->vessel_owner}}</td>
            <td>{{$v->vessel_type}}</td>
            <td>{{$v->arrival_date}}</td>
            <td>{{$v->departure_date}}</td>
            <td class="del">
                <Button value="{{$v->vessel_id}}" class="del-class"><i class="fa fa-trash-o"></i></Button>
            </td>
            <td class="del">
                <Button value="{{$v->vessel_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></Button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>


