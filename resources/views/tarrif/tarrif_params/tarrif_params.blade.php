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
            <th>Client Name</th>
            <th>Office Descriprion</th>
            <th>Head Office</th>
            <th>Client Number</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $key => $c)
        <tr>
            <td>{{$c->client_name}}</td>
            <td>{{$c->client_office_desc}}</td>
            <td>{{$c->client_head_office}}</td>
            <td>{{$c->client_number}}</td>
            <td class="del">
                <Button value="{{$c->client_id}}" class="del-class"><i class="fa fa-trash-o"></i></Button>
            </td>
            <td class="del">
                <Button value="{{$c->client_id}}" class="class-edit"><i class="fa fa-pencil-square-o"></i></Button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>

    </tfoot>
</table>


