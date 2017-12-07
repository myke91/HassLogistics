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
<div class="modal fade" id="invoice-details-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Details of Invoice</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 20px">
                    <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="invoice-table">
                        <thead>
                            <tr>
                                <th>Vessel Name</th>
                                <th>Client Name</th>
                                <th>Bill Item</th>
                                <th>Billable</th>
                                <th>Vat</th>
                                <th>Invoice Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    Unit Price:
                                    / Quantity: 
                                    / Total Price: 
                                </td>

                            </tr>

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal"  class="btn btn-default" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
@section('additional_scripts')
<script>
    $(document).ready(
            function () {

            });
    function showClientInfo()
    {
        var data = $('#frm-create-invoice').serialize();
        console.log(data);
        $.get("{{route('showInvoiceInfo')}}", data, function (data) {
            $('#add-invoice-info').empty().append(data);
        });
    }
</script>
@endsection