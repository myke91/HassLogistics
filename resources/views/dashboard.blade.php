@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


            </div>
        </div>
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
