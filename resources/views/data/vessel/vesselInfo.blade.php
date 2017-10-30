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
<script>

    $('td', 'table').each(function(i) {
        $(this).text(i+1);
    });



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

    function DemoSelect2() {
        $('#s2_with_tag').select2({placeholder: "Select OS"});
        $('#s2_country').select2();
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
        // Initialize datepicker
        $('#arrival_date').datepicker({setDate: new Date()});
        $('#departure_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Load Datatables and run plugin on tables
        LoadDataTablesScripts(AllTables);
        dateFormat:'yy-mm-dd'
        // Add drag-n-drop feature to boxes
        WinMove();
    });
</script>


