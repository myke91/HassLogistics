<div class="modal fade" id="track-payments-modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Payment Summary for <span class="client-name">CLIENT NAME</span></h4>
            </div>
            <div class="modal-body">
            <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="track-payments-table">
                        <thead>
                            <tr>
                                <th>Invoice No.</th>
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="invoice_no"></td>
                                <td  class="amount_due"></td>
                                <td  class="amount_paid" style="color:green"></td>
                                <td  class="balance" style="color:red"></td>
                            </tr>
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            <div class="modal-footer">
                <button data-dismiss="modal"  class="btn btn-default" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
