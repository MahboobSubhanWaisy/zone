@extends('layouts.master')

@section('content') 
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/custom.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.css')}}">

    @if(Session::has('devices-created'))
        <div id="toast-container" class="toast-container toast-bottom-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">وسایل</div>
                <div class="toast-message">{{Session::get('devices-created')}}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <h6 class="panel-title txt-dark zone-btn" style="cursor: pointer;"> {{__('words.New Device')}}</h6>
                    
                </div>
                <div class="panel-wrapper collapse in zone-form">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="POST" action="{{route('create.device')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 form-group">
                                        <label class="control-label mb-10 text-left"> {{__('words.Device Name')}} </label>
                                        <input type="text" name="device_name[]" class="form-control" required>
                                    </div>
                                    <div id="input-container">

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-outline pull-right"><i class="fa fa-save"></i> {{__('words.Save')}}</button>
                                <button type="button" class="btn btn-primary btn-sm" id="add-new-input-btn"><i class="zmdi zmdi-plus"></i>&nbsp;&nbsp;{{__('words.Add')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">  {{__('words.Device List')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display pb-30" >
                                    <thead>
                                        <tr>
                                            <th> {{__('words.Number')}}</th>
                                            <th> {{__('words.Device Name')}}</th>
                                            <th> {{__('words.Changes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $key => $device)
                                            <tr>
                                                <th>{{$key + 1}}</th>
                                                <td>{{$device->de_name}}</td>
                                                <td>
                                                    <a href="#!" class="edit-btn glyphicon glyphicon-edit edit-device-btn" data="{{$device->de_id}}" name="{{$device->de_name}}"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    
    <div id="edit-device-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="close" style="color: #fff;" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" style="color: #fff;"> {{__('words.Changes')}}</h5>
                </div>
                <form id="device-form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="data" id="data-id">
                        <div class="form-group">
                            <label class="control-label mb-10 text-left"> {{__('words.Device Name')}} </label>
                            <input type="text" name="device-name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="device-changes"> {{__('words.Update')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"> {{__('words.Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('script')
        <script src="{{asset('public/asset/vendors/toastr.js')}}"></script>
        <script src="{{asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.js')}}"></script>
        
        <script>
            $('#datable_1').DataTable({
                "bInfo": false,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "aaSorting": [[0,"desc"]],
                "info": true,
                "language": {
                    "sSearch": "جستجو",
                    "paginate": {
                        "previous": "قبلی",
                        "next": "بعدی"
                    },
                    "sEmptyTable": "دیتا موجود نیست"
                }
            });
            
            $('.zone-form').hide();
            $('.zone-btn').click(function() {
                $('.zone-form').slideToggle(800);
            });

            $('.edit-device-btn').click(function() {
                $('#data-id').val($(this).attr('data'));
                $('#name').val($(this).attr('name'));

                $('#edit-device-modal').modal('show');
            });

            $('#device-changes').click(function() {
                $.post("{{route('update.device')}}", $('#device-form').serialize(), function(response){
                    if(response == 'Updated'){
                        Swal.fire(
                            'تغییرات اجرا شد!',
                            '',
                            'success'
                        );
                        setTimeout(() => location.reload(), 1500);
                    }else{
                        alert('Error Occured.!');
                    }
                });
            });

            $('#add-new-input-btn').click(function() {
                var new_input = '<div class="col-lg-6 col-md-6 col-12 form-group">\
                                    <label class="control-label mb-10 text-left">نام وسیله</label>\
                                    <div class="input-group mb-15"> \
                                        <span class="input-group-btn">\
                                            <button type="button" class="btn btn-danger remove-input-btn"><i class="zmdi zmdi-close"></i></button>\
                                        </span>\
                                        <input type="text" name="device_name[]" class="form-control" required>\
                                    </div>\
                                </div>';
                
                $('#input-container').append(new_input);
            });

            $(document).on('click', '.remove-input-btn', function() {
                $(this).closest($('.form-group')).remove();
            });

            setTimeout(function() {
                $('.toast_message').fadeOut('slow');
            }, 3000);
        </script>
    @endsection
@endsection