@extends('layouts.master')

@section('content')
    <link rel="stylesheet" media="screen" href="{{ asset('public/asset/vendors/clock/main.css') }}">

    <div class="row">
        <div id="myclock" style="direction: ltr;"></div>
    </div>


@section('script')
    <script src="{{ asset('public/asset/vendors/clock/jquery.thooClock.js') }}"></script>

    <script>
        $('#myclock').thooClock({
            size: 250,
            sweepingMinutes: true,
            sweepingSeconds: true
        });

    </script>
@endsection
@endsection
