@extends('layouts.master')

@section('content') 
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/custom.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.css')}}">

    @if(Session::has('zone-created'))
        <div id="toast-container" class="toast-container toast-bottom-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">زون</div>
                <div class="toast-message">{{Session::get('zone-created')}}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <h6 class="panel-title txt-dark zone-btn" style="cursor: pointer;">{{__('words.New Zone')}}</h6>
                </div>
                <div class="panel-wrapper collapse in zone-form">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="POST" action="{{route('create.zone')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 form-group">
                                        <label class="control-label mb-10 text-left">{{__('words.Zone Name')}}</label>
                                        <input type="text" name="zone-name" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 form-group">
                                        <label class="control-label mb-10 text-left">{{__('words.Zone Location')}}</label>
                                        <input type="text" name="zone-location" class="form-control" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-outline pull-right"><i class="fa fa-save"></i> {{__('words.Save')}}</button>
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
                        <h6 class="panel-title txt-dark">{{__('words.Zone List')}}</h6>
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
                                            <th>{{__('words.Number')}}</th>
                                            <th> {{__('words.Zone Name')}}</th>
                                            <th> {{__('words.Zone Location')}}</th>
                                            <th>{{__('words.Changes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($zones as $key => $zone)
                                            <tr>
                                                <th>{{$key + 1}}</th>
                                                <td>{{$zone->z_name}}</td>
                                                <td>{{$zone->z_location}}</td>
                                                <td>
                                                    <a href="#!" class="edit-btn glyphicon glyphicon-edit edit-zone-btn" data="{{$zone->z_id}}" name="{{$zone->z_name}}" loc="{{$zone->z_location}}"></a>
                                                    <a href="#!" class="remove-btn glyphicon glyphicon-trash delete-zone-btn" data="{{$zone->z_id}}"></a>
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
    
    <div id="edit-zone-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="close" style="color: #fff;" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" style="color: #fff;">{{__('words.Changes')}}</h5>
                </div>
                <form id="zone-form">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="data" id="data-id">
                        <div class="form-group">
                            <label class="control-label mb-10 text-left"> {{__('words.Zone Name')}}</label>
                            <input type="text" name="zone-name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10 text-left"> {{__('words.Zone Location')}}</label>
                            <input type="text" name="zone-location" id="location" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="zone-changes">{{__('words.Update')}} </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('words.Close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="delete-zone-form" hidden="">
        @csrf
        <input type="text" name="data-id" id="delete-id">
    </form>

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
                    "sSearch": "{{__('words.Search')}}",
                    "paginate": {
                        "previous": "{{__('words.Previous')}}",
                        "next": "{{__('words.Next')}}"
                    },
                    "sEmptyTable": "{{__('words.No Data Exist')}}"
                }
            });
            
            $('.zone-form').hide();
            $('.zone-btn').click(function() {
                $('.zone-form').slideToggle(800);
            });

            $('.edit-zone-btn').click(function() {
                $('#data-id').val($(this).attr('data'));
                $('#name').val($(this).attr('name'));
                $('#location').val($(this).attr('loc'));

                $('#edit-zone-modal').modal('show');
            });

            $('#zone-changes').click(function() {
                $.post("{{route('update.zone')}}", $('#zone-form').serialize(), function(response){
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

            $('.delete-zone-btn').click(function() {
                Swal.fire({
                    title: 'آیا مطمین استید؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'حذف',
                    cancelButtonText: 'نخیر' 
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-id').val($(this).attr('data'));

                        $.post("{{route('delete.zone')}}", $('#delete-zone-form').serialize(), function(response) {
                            if (response == 'Deleted') {
                                Swal.fire({
                                    confirmButtonText: 'درست',
                                    title: 'عملیه اجرا شد!',
                                    icon: 'success'
                                });
                                setTimeout(() => location.reload(), 1500);
                            }
                        });
                    }
                });
            });

            setTimeout(function() {
                $('.toast_message').fadeOut('slow');
            }, 3000);
        </script>
    @endsection
@endsection