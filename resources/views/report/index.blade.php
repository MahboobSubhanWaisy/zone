@extends('layouts.master')
<?php include('public/asset/dist/jdate.php');
$date=to_jalali(date('Y-m-d'));
?>
@section('content')
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/asset/vendors/toastr.min.css') }}">

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

        @media print {
            #filter-section{
                display: none;
            }

            #text-headert{
                margin-top: -20rem !important; 
            }
        }
    </style>

    @if (Session::has('approve-report'))
    <div id="toast-container" class="toast-container toast-top-right toast_message">
        <div class="toast toast-success" aria-live="polite" style="display:block;">
            <div class="toast-title">گزارش</div>
            <div class="toast-message">{{ Session::get('approve-report') }}</div>
        </div>
    </div>
    @endif

    <div class="col-md-12" id="filter-section">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div style="display: flex; justify-content:space-between;">
                    <h3 class="panel-title txt-dark">{{__('words.Select Feilds To Show Report')}}</h3>
                    <a class="btn btn-success btn-outline fa fa-print" onclick="window.print();"></a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form id="search-form">
                        @csrf
                        <div class="form-wrap">
                            <div class="row">
                                @if(Auth::user()->role == 1)
                                    <div class="col-lg-3 col-md-3 col-12 form-group">
                                        <label class="control-label mb-10">{{__('words.Zone List')}}</label>
                                        <select class="select2" name="zone">
                                            <option disabled selected>{{__('words.Select Zone')}}</option>
                                            @foreach ($zones as $zone)
                                                <option value="{{ $zone->z_id }}">{{ $zone->z_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if(Auth::user()->role == 2)
                                    <div class="col-lg-3 col-md-3 col-12 form-group">
                                        <label class="control-label mb-10">{{__('words.Branch List')}}</label>
                                        <select class="select2" name="branch">
                                            <option disabled selected>{{__('words.Select Branch')}}</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->br_id }}">{{ $branch->br_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="col-lg-3 col-md-3 col-12 form-group">
                                    <label class="control-label mb-10 text-left">{{__('words.Start Date')}}</label>
                                    <input type="text" name="start_date" class="form-control pdp" id="start-date" value="{{$date}}" autocomplete="off">
                                </div>
                                <div class="col-lg-3 col-md-3 col-12 form-group">
                                    <label class="control-label mb-10 text-left">{{__('words.End Date')}}</label>
                                    <input type="text" name="end_date" class="form-control pdp" id="end-date" value="{{$date}}" autocomplete="off">
                                </div>
                                <div class="col-lg-3 col-md-3 col-12 form-group mt-30">
                                    <button type="button" class="btn btn-primary btn-outline" id="search-btn" style="width: 100%"><i class="fa fa-search"></i> {{__('words.Search')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div style="width: 100%; display: flex; justify-content: center;">
        <img src="{{asset('public/asset/dist/img/loader.gif')}}" style="height: 8rem;" id="loader" hidden="">
    </div>
    <h5 class="text-center" id="text-header">گزارش از تاریخ <span id="start-date-show"></span> الی <span id="end-date-show"></span></h5>
    <div id="show-report"></div>

@section('script')
    <script src="{{asset('public/asset/vendors/jquery-3.6.0.js')}}"></script>
    <script src="{{ asset('public/asset/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/asset/vendors/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/asset/vendors/datepicker/bootstrap-datepicker.fa.min.js') }}"></script>
    <script src="{{ asset('public/asset/vendors/toastr.js') }}"></script>
    <script>
        $('.select2').select2();
        $('#text-header').hide();

        $(".pdp").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: "yy-mm-dd"
        });

        $('#search-btn').click(function() {
            $('#show-report').empty();
            $('#loader').removeAttr('hidden', '');
            $.post("{{route('show-report')}}", $('#search-form').serialize(), function(response) {
                $('#text-header').show();
                $('#start-date-show').text($('#start-date').val());
                $('#end-date-show').text($('#end-date').val());
                $('#show-report').html(response);
                $('#loader').attr('hidden', '');
            });
        });

        $(document).on('click', '.radioChecked', function() {
            if($('.radioChecked').is(':checked')) { 
                if ($(this).val() == 1) {
                    $('#th-reject-reason').hide();
                    $('.reason-'+$(this).attr('data')).hide();
                    $('.reason-'+$(this).attr('data')).removeAttr('required', '');
                } else {
                    $('#th-reject-reason').show();
                    $('.reason-'+$(this).attr('data')).show();
                    $('.reason-'+$(this).attr('data')).attr('required', '');
                }
            }
        });

        setTimeout(() => $('.toast_message').fadeOut('slow'), 3000);
    </script>
@endsection
@endsection
