@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.min.css') }}">

    @if (Session::has('report-stored'))
        <div id="toast-container" class="toast-container toast-top-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">گزارش</div>
                <div class="toast-message">{{ Session::get('report-stored') }}</div>
            </div>
        </div>
    @endif

    @if (Session::has('invalid-edit-time'))
        <div id="toast-container" class="toast-container toast-top-right toast_message">
            <div class="toast toast-error" aria-live="polite" style="display:block;">
                <div class="toast-title">گزارش</div>
                <div class="toast-message">{{ Session::get('invalid-edit-time') }}</div>
            </div>
        </div>
    @endif

    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <a href="operator-form" class="btn btn-primary btn-outline">ثبت گزارش جدید</a>
                <a href="operator-edit-report" class="btn btn-warning btn-outline ml-30">تغییر گزارش</a>
            </div>
        </div>
    </div>


@section('script')
    <script src="{{ asset('public/asset/vendors/toastr.js') }}"></script>

    <script>
        setTimeout(() => $('.toast_message').fadeOut('slow'), 3000);
    </script>
@endsection
@endsection
