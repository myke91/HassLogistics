@extends('layouts.app')
@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li><a href="{{route('paymentOnAccount')}}">Payments On Account</a></li>
            </ol>
        </div>
    </div>


@endsection

@section('additional_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $.get("{{route('ready')}}", function () {
            });
        });
    </script>

@endsection
