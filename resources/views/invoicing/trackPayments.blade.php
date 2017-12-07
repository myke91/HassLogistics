@extends('layouts.app')
@section('content')
@include('popups.track_payments')
<div class="row">
    <div id="breadcrumb" class="col-xs-12">
        <a href="#" class="show-sidebar">
            <i class="fa fa-bars"></i>
        </a>
        <ol class="breadcrumb pull-left">
            <li><a href="/">Dashboard</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="box-name">
                    <i class="fa fa-search"></i>
                    <span>TRACK PAYMENTS ON INVOICES</span>
                </div>
                <div class="box-icons">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="expand-link">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
                <div class="no-move"></div>
            </div>
            <div class="box-content">
                <h4 class="page-header">SELECT CLIENT</h4>
                <form class="form-horizontal form-invoice" role="form">

                    <div class="form-group has-success has-feedback">
                        <label class="col-sm-2 control-label">Client</label>
                        <div class="col-sm-6">
                            <select class="s2 populate placeholder clients">
                                <option>---------</option>
                            </select>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-2 pull-right">
                            <button class="btn btn-info btn-label-left execute">
                                <span><i class="fa fa-plus-circle"></i></span>
                                Execute
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_script')
<script type="text/javascript">
// Run Select2 plugin on elements
    function DemoSelect2() {
        $('.s2').select2({placeholder: "Select"});
    }

    $(document).ready(function () {
        LoadSelect2Script(DemoSelect2);

    }).on('click', '.execute', function (e) {
        e.preventDefault();
        $('#track-payments-modal').modal('show');
    });
</script>
@endsection
