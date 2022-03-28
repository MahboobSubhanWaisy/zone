@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.min.css') }}">

    @if (Session::has('password-updated'))
        <div id="toast-container" class="toast-container toast-top-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">رمز عبور</div>
                <div class="toast-message">{{ Session::get('password-updated') }}</div>
            </div>
        </div>
    @endif

    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <h3 class="panel-title txt-dark">انتخاب گزینه برای مشاهد گزارش</h3>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        <div class="form-wrap">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-12 form-group">
                                    <label class="control-label mb-10 text-left">رمز گذشته</label>
                                    <input type="text" name="old-pass" class="form-control" autocomplete="off" required>
                                    @error('old-pass')
                                        <span style="color: #dc3545;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-12 form-group">
                                    <label class="control-label mb-10 text-left">رمز جدید</label>
                                    <input type="text" name="password" class="form-control" autocomplete="off" required>
                                    @error('new-pass')
                                        <span style="color: #dc3545;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-12 form-group">
                                    <label class="control-label mb-10 text-left">تایید رمز</label>
                                    <input type="text" name="password_confirmation" class="form-control"
                                        autocomplete="off" required>
                                    @error('conf-pass')
                                        <span style="color: #dc3545;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-3 col-md-3 col-12 form-group mt-30">
                                    <button type="submit" class="btn btn-primary btn-outline" style="width: 100%"><i
                                            class="fa fa-save"></i> تغییر رمز</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@section('script')
    <script>
        setTimeout(() => $('.toast_message').fadeOut('slow'), 3000);
    </script>
@endsection
@endsection
