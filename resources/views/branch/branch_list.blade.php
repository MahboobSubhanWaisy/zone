@extends('layouts.master')

@section('content') 
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/custom.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/asset/vendors/bower_components/select2/dist/css/select2.min.css')}}">

    <style>
        .select2-container .select2-selection--single {
            height: auto !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 39px !important;
        }
        .select2-results__option {
            text-align: right !important;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            direction: rtl !important;
        }
    </style>

    @if(Session::has('branch-created'))
        <div id="toast-container" class="toast-container toast-bottom-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">ساحه و وسایل</div>
                <div class="toast-message">{{Session::get('branch-created')}}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <h6 class="panel-title txt-dark branch-btn" style="cursor: pointer;"> {{__('words.New Branch')}}</h6>
                </div>
                <div class="panel-wrapper collapse in branch-form">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="POST" action="{{route('create.branch')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 form-group">
                                        <label class="control-label mb-10 text-left">{{__('words.Branch Name')}}</label>
                                        <input type="text" name="side-name" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 form-group">
                                        <label class="control-label mb-10">{{__('words.Zone List')}}</label>
                                        <select class="select2" name="zone-name" required>
                                            <option disabled selected> {{__('words.Select Zone')}}</option>
                                            @foreach ($zones as $zone)
                                                <option value="{{$zone->z_id}}">{{$zone->z_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12 mb-10" style="color: #000;">
                                        <label for="">  {{__('words.Device List')}}</label>
                                    </div>
                                    @foreach ($devices as $device)
                                        <div class="col-lg-3 col-md-3 col-12">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox-{{$device->de_id}}" name="branch-devices[]" value="{{$device->de_id}}" type="checkbox">
                                                <label for="checkbox-{{$device->de_id}}">{{$device->de_name}}</label>
                                            </div>
                                        </div>
                                    @endforeach
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
                        <h6 class="panel-title txt-dark">  {{__('words.Branch List')}}</h6>
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
                                            <th> {{__('words.Branch Name')}}</th>
                                            <th> {{__('words.Zone Name')}}</th>
                                            <th>{{__('words.Changes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branches as $key => $branch)
                                            <tr>
                                                <th>{{$key + 1}}</th>
                                                <td>{{$branch->br_name}}</td>
                                                <td>{{$branch->zone->z_name}}</td>
                                                <td>
                                                    <a href="#!" class="view-btn glyphicon glyphicon-eye-open view-branch-btn" data="{{$branch->br_id}}"></a>
                                                    <a href="#!" class="edit-btn glyphicon glyphicon-edit edit-branch-btn" data="{{$branch->br_id}}"></a>
                                                    <a href="#!" class="remove-btn glyphicon glyphicon-trash delete-branch-btn" data="{{$branch->br_id}}"></a>
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

    <div id="show-branch-modal"></div>

    <form id="delete-branch-form" hidden="">
        @csrf
        <input type="text" name="data-id" id="delete-id">
    </form>

    @section('script')
        <script src="{{asset('public/asset/vendors/toastr.js')}}"></script>
        <script src="{{asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.js')}}"></script>
        <script src="{{asset('public/asset/vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

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
            
            $('.select2').select2();

            $('.branch-form').hide();
            $('.branch-btn').click(function() {
                $('.branch-form').slideToggle(800);
            });

            $('.edit-branch-btn').click(function() {
                $.get("{{route('get.edit.modal')}}/" + $(this).attr('data'), function(response){
                    $('#show-branch-modal').html(response);
                    $('#edit-branch-modal').modal('show');
                });
            });

            $('.view-branch-btn').click(function() {
                $.get("{{route('get.view.modal')}}/" + $(this).attr('data'), function(response){
                    $('#show-branch-modal').html(response);
                    $('#view-branch-modal').modal('show');
                });
            });

            $(document).on('click', '#branch-changes', function() {
                $.post("{{route('update.branch')}}", $('#branch-form').serialize(), function(response){
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

            $('.delete-branch-btn').click(function() {
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

                        $.post("{{route('delete.branch')}}", $('#delete-branch-form').serialize(), function(response) {
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