@extends('layouts.master')

@section('content')
    <link href="{{ asset('public/asset/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.min.css')}}">

    @if(Session::has('report-stored'))
        <div id="toast-container" class="toast-container toast-bottom-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">گزارش</div>
                <div class="toast-message">{{Session::get('report-stored')}}</div>
            </div>
        </div>
    @endif
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">گزارش</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form action="{{ route('operator-report') }}" method="post">
                        @csrf
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover display pb-30">
                                    <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th>وسایل</th>
                                            <th>عملیات</th>
                                            <th>دلیل</th>
                                            <th>اولویت</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = -100; @endphp
                                        @foreach ($devices as $key => $device)
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <td>{{ $device->deviceName->de_name }}</td>
                                                <td>
                                                    <div class="radio radio-success">
                                                        <input type="radio" name="radio[{{ $device->br_de_id }}]" id="radio-{{ $key + 1 }}" value="1" data="{{$key}}">
                                                        <label for="radio-{{ $key + 1 }}">سالم</label>
                                                    </div>
                                                    <div class="radio radio-danger">
                                                        <input type="radio" name="radio[{{ $device->br_de_id }}]" id="radio-{{ $key + 100 }}" value="0" data="{{$key}}">
                                                        <label for="radio-{{ $key + 100 }}">خراب</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="reason[]" class="form-control reason-{{ $key }}" style="display: none !important;" placeholder="دلیل خراب بودن را بنویسید">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="radio radio-success">
                                                        <input type="radio" name="priority[{{ $device->br_de_id }}]" id="priority-{{ $key + 50 }}" value="1">
                                                        <label for="priority-{{ $key + 50 }}">عاجل</label>
                                                    </div>
                                                    <div class="radio radio-danger">
                                                        <input type="radio" name="priority[{{ $device->br_de_id }}]" id="priority-{{ $key + 200 }}" value="2">
                                                        <label for="priority-{{ $key + 200 }}">متوسط</label>
                                                    </div>
                                                    <div class="radio radio-danger">
                                                        <input type="radio" name="priority[{{ $device->br_de_id }}]" id="priority-{{ $key + 300 }}" value="3">
                                                        <label for="priority-{{ $key + 300 }}">عادی</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="submit" value="ثبت گزارش" class="btn btn-primary pull-right">
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script src="{{ asset('public/asset/vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}">
    <script src="{{asset('public/asset/vendors/toastr.js')}}"></script>
    </script>
    <script>
        $('input[type=radio]').change(function() {
            if ($(this).val() == 1) {
                $('.reason-'+$(this).attr('data')).hide();
                $('.reason-'+$(this).attr('data')).removeAttr('required', '');
            } else if($(this).val() == 0){
                $('.reason-'+$(this).attr('data')).show();
                $('.reason-'+$(this).attr('data')).attr('required', '');
            }
        });
        setTimeout(() => $('.toast_message').fadeOut('slow'), 3000);
    </script>
@endsection
@endsection
