@extends('layouts.master')

@section('content')
    <link href="{{ asset('public/asset/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    
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
                    <form action="{{ route('operator-report-update') }}" method="post">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = -100; @endphp
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <td>{{ $row->branch_devices_fun->deviceName->de_name }}</td>
                                                <td>
                                                    <div class="radio radio-success">
                                                        <input type="radio" name="radio[{{ $row->bds_id }}]" id="radio-{{ $key + 1 }}" value="1" data="{{$key}}" {{$row->status == '1' ? 'checked' : ''}}>
                                                        <label for="radio-{{ $key + 1 }}">سالم</label>
                                                    </div>
                                                    <div class="radio radio-danger">
                                                        <input type="radio" name="radio[{{ $row->bds_id }}]" id="radio-{{ $key - $i }}" value="0" data="{{$key}}" {{$row->status == '0' ? 'checked' : ''}}>
                                                        <label for="radio-{{ $key - $i }}">خراب</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php if($row->status == '0'){ $vis="block";} else{ $vis = "none";}  @endphp
                                                    <div class="form-group">
                                                        <input type="text" name="reason[]" class="form-control reason-{{ $key }}" style="display: {{$vis}};" value="{{$row->problem_description}}" placeholder="دلیل خراب بودن را بنویسید">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="radio radio-success">
                                                        <input type="radio" name="priority[{{ $row->bds_id }}]" id="priority-{{ $key + 50 }}" value="1" {{$row->priority == '1' ? 'checked' : ''}}>
                                                        <label for="priority-{{ $key + 50 }}">عاجل</label>
                                                    </div>
                                                    <div class="radio radio-danger">
                                                        <input type="radio" name="priority[{{ $row->bds_id }}]" id="priority-{{ $key + 200 }}" value="2" {{$row->priority == '2' ? 'checked' : ''}}>
                                                        <label for="priority-{{ $key + 200 }}">متوسط</label>
                                                    </div>
                                                    <div class="radio radio-danger">
                                                        <input type="radio" name="priority[{{ $row->bds_id }}]" id="priority-{{ $key + 300 }}" value="3" {{$row->priority == '3' ? 'checked' : ''}}>
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
    </script>
    <script>
        $('input[type=radio]').change(function() {
            if ($(this).val() == 1) {
                $('.reason-'+$(this).attr('data')).hide();
                $('.reason-'+$(this).attr('data')).removeAttr('required', '');
            } else {
                $('.reason-'+$(this).attr('data')).show();
                $('.reason-'+$(this).attr('data')).attr('required', '');
            }
        });
    </script>
@endsection
@endsection
