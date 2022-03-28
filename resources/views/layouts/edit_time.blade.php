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

<div id="edit-time-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button type="button" class="close" style="color: #fff;" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" style="color: #fff;">{{__('words.Clock Changes')}}</h5>
            </div>
            <form id="update-time-modal">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label class="control-label mb-10">{{__('words.Hour')}}</label>
                            <select class="form-control select2" name="hour" required>
                                <option disabled selected>ساعت را انتخاب کنید</option>
                                @for ($i = 1; $i <= 9; $i++)
                                    <option value="{{$i}}" {{$hour == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 form-group">
                            <label class="control-label mb-10">{{__('words.Mainute')}}</label>
                            <select class="form-control select2" name="mins" required>
                                <option disabled selected>دقیقه را انتخاب کنید</option>
                                @for ($i = 1; $i <= 59; $i++)
                                    <option value="{{$i}}" {{$mins == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 form-group">
                            <label class="control-label mb-10">{{__('words.Extra Minute')}}</label>
                            <select class="form-control select2" name="second_chanse">
                                <option disabled selected>دقیقه را انتخاب کنید</option>
                                @for ($i = 1; $i <= 59; $i++)
                                    <option value="{{$i}}" {{$second_chanse == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 form-group">
                            <label class="control-label mb-10">{{__('words.Changes Time')}}</label>
                            <select class="form-control select2" name="update_time" required>
                                <option disabled selected>دقیقه را انتخاب کنید</option>
                                @for ($i = 1; $i <= 59; $i++)
                                    <option value="{{$i}}" {{$update_time == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="update-time-btn">{{__('words.Update')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('words.Close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.select2').select2();
</script>