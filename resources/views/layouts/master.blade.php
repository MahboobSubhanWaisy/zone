<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Maintenance Department</title>
    <meta name="description" content="Philbert is a داشبورد & Admin Site Responsive Template by hencework." />
    <meta name="keywords"
        content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('public/asset/vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Data table CSS -->
    <link href="{{ asset('public/asset/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" type="text/css" />

    {{-- <link href="{{asset('public/asset/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">

    <link rel="stylesheet"
        href="{{ asset('public/asset/vendors/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.css') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('public/asset/dist/css/style.css') }}" rel="stylesheet" type="text/css">

    <style>
        .navbar.navbar-inverse.navbar-fixed-top .nav-header .logo-wrap .brand-img {
            margin-left: 4rem;
        }

    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-green">
        <!-- Top Menu Items -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="mobile-only-brand pull-left">
                <div class="nav-header pull-left">
                    <div class="logo-wrap">
                        <a href="index-2.html">
                            <img class="brand-img ml-45" src="{{ asset('public/asset/dist/img/emirate.png') }}"
                                alt="brand" style="width: 5.5rem;" />
                        </a>
                    </div>
                </div>
                <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left"
                    href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
                <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view"
                    href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
                <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i
                        class="zmdi zmdi-more"></i></a>
            </div>
            <div id="mobile_only_nav" class="mobile-only-nav pull-right">
                <ul class="nav navbar-right top-nav pull-right">


                    <li class="dropdown app-drp">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i
                                class="zmdi zmdi-apps top-nav-icon"></i></a>
                        <ul class="dropdown-menu app-dropdown" data-dropdown-in="slideInRight"
                            data-dropdown-out="flipOutX">
                            <li>
                                <div class="slimScrollDiv"
                                    style="position: relative; overflow: hidden; width: auto; height: 85px;">
                                    <div class="app-nicescroll-bar"
                                        style="overflow: hidden; width: auto; height: 162px;">
                                        <ul class="app-icon-wrap pa-10">
                                            <li>
                                                <a href="{{route('english')}}" class="connection-item">
                                                    <img src="{{asset('public/asset/flags/british.png')}}" alt="" style="width: 2rem;">
                                                    <span class="block">{{__('words.English')}}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('dari')}}" class="connection-item">
                                                    <img src="{{asset('public/asset/flags/Afghanistan.jpg')}}" alt="" style="width: 2rem;">
                                                    <span class="block">{{__('words.Dari')}}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('pashto')}}" class="connection-item">
                                                    <img src="{{asset('public/asset/flags/Afghanistan.jpg')}}" alt="" style="width: 2rem;">
                                                    <span class="block">{{__('words.Pashto')}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="slimScrollBar"
                                        style="background: rgb(135, 135, 135); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 162px;">
                                    </div>
                                    <div class="slimScrollRail"
                                        style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                    {{-- Notification Section --}}
                    <li class="dropdown alert-drp">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="zmdi zmdi-notifications top-nav-icon"><span class="top-nav-icon-badge"></span></i>
                        </a>
                        <ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn"
                            data-dropdown-out="bounceOut">
                            <li>
                                <div class="notification-box-head-wrap">
                                    <span class="notification-box-head pull-left inline-block">{{ __('words.Notifications') }}</span>
                                    <div class="clearfix"></div>
                                    <hr class="light-grey-hr ma-0" />
                                </div>
                            </li>
                            <li id="show-content">

                            </li>
                        </ul>
                    </li>
                    <li class="dropdown auth-drp">
                        <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                            <img src="{{ asset('public/asset/dist/img/user_default.jpg') }}" alt="user_auth"
                                class="user-auth-img img-circle" /><span class="user-online-status"></span>
                        </a>
                        <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX"
                            data-dropdown-out="flipOutX">
                            <li>
                                <a href="{{ route('change-password') }}"><i class="zmdi zmdi-lock"></i><span>{{ __('words.Change Password') }}</span></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
                                    <i class="zmdi zmdi-power"></i><span>{{ __('words.Logout') }}</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        <div class="fixed-sidebar-left">
            <ul class="nav navbar-nav side-nav nicescroll-bar">
                <li class="navigation-header">
                    <span>{{ __('words.Main') }}</span>
                    <i class="zmdi zmdi-more"></i>
                </li>
                <li>
                    <a class="{{ Request::is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span
                                class="right-nav-text">{{ __('words.Home') }}</span></div>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <hr class="light-grey-hr mb-10" />
                </li>
                @if (Auth::user()->role == 1)
                    <li>
                        <a class="{{ Request::is('zone-list') ? 'active' : '' }}" href="{{ route('zone.list') }}">
                            <div class="pull-left"><i class="zmdi zmdi-globe-alt mr-20"></i><span
                                    class="right-nav-text">{{ __('words.Zone') }}</span></div>
                            <div class="pull-right"></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a class="{{ Request::is('branch-list') ? 'active' : '' }}"
                            href="{{ route('branch.list') }}">
                            <div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span
                                    class="right-nav-text">{{ __('words.Branch') }}</span></div>
                            <div class="pull-right"></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a class="{{ Request::is('device-list') ? 'active' : '' }}"
                            href="{{ route('device.list') }}">
                            <div class="pull-left"><i class="zmdi zmdi-settings mr-20"></i><span
                                    class="right-nav-text">{{ __('words.Device') }}</span></div>
                            <div class="pull-right"></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="#!" id="edit-time-btn">
                            <div class="pull-left"><i class="zmdi zmdi-time mr-20"></i><span
                                    class="right-nav-text">{{ __('words.Clock Settings') }}</span></div>
                            <div class="pull-right"></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <hr class="light-grey-hr mb-10" />
                    </li>
                @endif
                @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                    <li>
                        <a class="{{ Request::is('report') ? 'active' : '' }}" href="{{ route('report') }}">
                            <div class="pull-left"><i class="fa fa-list mr-20"></i><span
                                    class="right-nav-text">{{ __('words.Reports') }}</span></div>
                            <div class="pull-right"></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <hr class="light-grey-hr mb-10" />
                    </li>
                    <li>
                        <a class="{{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">
                            <div class="pull-left"><i class="fa fa-users mr-20"></i><span
                                    class="right-nav-text">{{ __('words.User') }}</span></div>
                            <div class="pull-right"></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 3)
                    <li>
                        <a class="{{ Request::is('operator') || Request::is('operator-edit-report') || Request::is('operator-form')? 'active': '' }}"
                            href="{{ route('operator') }}">
                            <div class="pull-left"><i class="fa fa-list mr-20"></i><span
                                    class="right-nav-text">{{ __('words.Rport') }}</span></div>
                            <div class="pull-right"></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /Left Sidebar Menu -->

        <!-- Right Sidebar Backdrop -->
        <div class="right-sidebar-backdrop"></div>
        <!-- /Right Sidebar Backdrop -->

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid pt-25">
                @yield('content')
            </div>
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    <div id="show-time-modal"></div>

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="{{ asset('public/asset/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('public/asset/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Data table JavaScript -->
    <script src="{{ asset('public/asset/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>

    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('public/asset/dist/js/jquery.slimscroll.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('public/asset/dist/js/dropdown-bootstrap-extended.js') }}"></script>

    <script src="{{ asset('public/asset/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/asset/vendors/bower_components/sweetalert/dist/sweetalert2.min.js') }}"></script>

    <!-- Init JavaScript -->
    <script src="{{ asset('public/asset/dist/js/init.js') }}"></script>
    <script src="{{ asset('public/asset/dist/js/dashboard-data.js') }}"></script>

    <script>
        $('#edit-time-btn').click(function() {
            $.get("{{ route('edit.time') }}", function(response) {
                $('#show-time-modal').html(response);
                $('#edit-time-modal').modal('show');
            });
        });

        $(document).on('click', '#update-time-btn', function() {
            $.post("{{ route('update.time') }}", $('#update-time-modal').serialize(), function(response) {
                if (response == 'Updated') {
                    Swal.fire(
                        'تغییرات اجرا شد!',
                        '',
                        'success'
                    );
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert('Error Occured.!');
                }
            });
        });

        setInterval(() => {
            $.get("{{ route('get-notification') }}", function(data) {
                $('#show-content').html(data);
                $('.top-nav-icon-badge').html(notificationCount);
            });
        }, 1000);
    </script>

    @yield('script')
</body>

</html>
