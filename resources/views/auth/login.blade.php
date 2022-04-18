<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Maintenance Department</title>
		<meta name="description" content="Philbert is a داشبورد & Admin Site Responsive Template by hencework." />
		<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
		<meta name="author" content="hencework"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="{{asset('public/asset/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
		
		<!-- Custom CSS -->
		<link href="{{asset('public/asset/dist/css/style.css')}}" rel="stylesheet" type="text/css">

        <style>
     
    </style>
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
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
																	<span class="block">English</span>
																</a>
															</li>
															<li>
																<a href="{{route('dari')}}" class="connection-item">
																	<img src="{{asset('public/asset/flags/Afghanistan.jpg')}}" alt="" style="width: 2rem;">
																	<span class="block">دری</span>
																</a>
															</li>
															<li>
																<a href="{{route('pashto')}}" class="connection-item">
																	<img src="{{asset('public/asset/flags/Afghanistan.jpg')}}" alt="" style="width: 2rem;">
																	<span class="block">پشتو</span>
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
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">{{__('words.Care maintenance management system')}}</h3>
											<h5 class="text-center nonecase-font txt-grey">{{__('words.Login Page')}}</h5>
										</div>
									
						
										<div class="form-wrap">
											<form method="POST" action="{{ route('login') }}">
                                                @csrf
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">{{__('words.Email Address')}}</label>
													<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">{{__('words.Password')}}</label>
													<div class="clearfix"></div>
													<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-success btn-rounded mt-20" style="padding: 0.7rem 8rem;">{{__('words.Login')}}</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="{{asset('public/asset/vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="{{asset('public/asset/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('public/asset/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')}}"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="{{asset('public/asset/dist/js/jquery.slimscroll.js')}}"></script>
		
		<!-- Init JavaScript -->
		<script src="{{asset('public/asset/dist/js/init.js')}}"></script>
	</body>
</html>
