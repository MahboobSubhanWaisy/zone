@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/bower_components/select2/dist/css/select2.min.css') }}">

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

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000 !important;
            line-height: 30px !important;
            float: right;
        }

    </style>

    @if (Session::has('account-created'))
        <div id="toast-container" class="toast-container toast-bottom-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">کاربر</div>
                <div class="toast-message">{{ Session::get('account-created') }}</div>
            </div>
        </div>
    @endif

    @if (Session::has('user-updated'))
        <div id="toast-container" class="toast-container toast-bottom-right toast_message">
            <div class="toast toast-success" aria-live="polite" style="display:block;">
                <div class="toast-title">کاربر</div>
                <div class="toast-message">{{ Session::get('user-updated') }}</div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <h6 class="panel-title txt-dark user-btn" style="cursor: pointer;">{{__('words.New User')}}</h6>
                </div>
                <div class="panel-wrapper collapse in user-form">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="POST" action="{{ route('register-user') }}">
                                @csrf
                                <div class="row" id="register-form">
                                    <div class="col-lg-4 col-md-4 col-12 form-group">
                                        <label class="control-label mb-10 text-left">{{__('words.Full Name')}}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 form-group">
                                        <label class="control-label mb-10 text-left">{{__('words.Email')}}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 form-group">
                                        <label class="control-label mb-10 text-left">{{__('words.Password')}}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 form-group">
                                        <label class="control-label mb-10 text-left">{{__('words.Password Conf')}}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12 form-group">
                                        <label class="control-label mb-10">{{__('words.Role List')}}</label>
                                        <select class="select2" name="role" required id="role">
                                            <option disabled selected>{{__('words.Select Role')}}</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-outline pull-right"><i
                                        class="fa fa-save"></i> {{__('words.Save')}}</button>
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
                        <h6 class="panel-title txt-dark">{{__('words.User List')}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display pb-30">
                                    <thead>
                                        <tr>
                                            <th>{{__('words.Number')}}</th>
                                            <th>{{__('words.Full Name')}}</th>
                                            <th>{{__('words.Email')}}</th>
                                            <th>{{__('words.Role')}}</th>
                                            <th>{{__('words.Zone')}}</th>
                                            <th>{{__('words.Branch')}}</th>
                                            <th>{{__('words.Changes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->roles->role_name }}</td>
                                                <td>@if ($user->zones != ''){{ $user->zones->z_name }}@else ---------- @endif</td>
                                                <td>@if ($user->branches != ''){{ $user->branches->br_name }}@else ---------- @endif</td>
                                                <td>
                                                    <a href="#!" class="edit-btn glyphicon glyphicon-edit user-edit-btn" data="{{$user->id}}"></a>
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

    <div id="user-modal"></div>

@section('script')
    <script src="{{ asset('public/asset/vendors/toastr.js') }}"></script>
    <script src="{{ asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('public/asset/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $('.user-form').hide();
        $('.user-btn').click(function() {
            $('.user-form').slideToggle(800);
        });

        $('#role').change(function() {
            if ($(this).val() == 2) {
                $.get("{{ route('zone-list', 2) }}", function(response) {
                    $('#register-form').append(response);
                });
            } else if ($(this).val() == 3) {
                $.get("{{ route('zone-list', 3) }}", function(response) {
                    $('#register-form').append(response);
                });
            } else {
                $('#zone-list').remove();
            }
        });

        $('.user-edit-btn').click(function (){
            $.get("{{route('edit-user')}}/" + $(this).attr('data'), function(data) {
                $('#user-modal').html(data);
                $('#edit-user-modal').modal('show');
            });
        });

        $('.select2').select2();
        setTimeout(() => $('.toast_message').fadeOut('slow'), 1500);
    </script>
@endsection
@endsection
