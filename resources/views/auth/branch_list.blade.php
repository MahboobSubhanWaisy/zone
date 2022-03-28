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
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #000 !important;
        line-height: 30px !important;
        float: right;
    }
</style>

<div class="col-lg-4 col-md-4 col-12 form-group" id="zone-list">
    <label class="control-label mb-10">لست ساحه ها</label>
    <select class="select2" name="branch" required>
        <option disabled selected>ساحه را انتخاب کنید</option>
        @foreach ($branches as $branch)
            <option value="{{$branch->br_id}}">{{$branch->br_name}}</option>
        @endforeach
    </select>
    <input type="hidden" name="zone" value="{{Auth::user()->zone}}">
</div>

<script src="{{asset('public/asset/vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script>
    $('.select2').select2();
</script>