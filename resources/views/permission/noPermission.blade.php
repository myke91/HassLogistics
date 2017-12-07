@extends('layouts.app')

@section('content')
    <div>
        <br>
        <br>
    <h1>Hi,<font color="red">{{Auth::user()->fullname}}</font>,you do not have permission <br>to access the requested file</h1>
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

