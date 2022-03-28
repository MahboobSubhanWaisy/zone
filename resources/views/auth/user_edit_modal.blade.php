<div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button type="button" class="close" style="color: #fff;" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" style="color: #fff;">تغییرات</h5>
            </div>
            <form action="{{route('update-user')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="data-id" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label mb-10 text-left">نام و تخلص</label>
                            <input type="text" name="full-name" value="{{$user->name}}" class="form-control" required>
                        </div>
                        @if((Auth::user()->role != 1) && (Auth::user()->role != 2) || (Auth::user()->role == $user->role))
                            <div class="col-md-6 form-group">
                                <label class="control-label mb-10 text-left">رمز گذشته</label>
                                <input type="text" name="old-pass" class="form-control">
                            </div>
                        @endif
                        <div class="col-md-6 form-group">
                            <label class="control-label mb-10 text-left">رمز جدید</label>
                            <input type="text" name="new-pass" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label mb-10 text-left">تایید رمز</label>
                            <input type="text" name="conf-pass" class="form-control">
                        </div>
                        @if(Auth::user()->role == 1)
                            <div class="col-md-6 form-group">
                                <label class="control-label mb-10">لست زون ها</label>
                                <select class=" selectCustom" name="zone" required>
                                    <option disabled selected>زون را انتخاب کنید</option>
                                    @foreach ($zones as $zone)
                                        <option value="{{$zone->z_id}}" {{$user->zone == $zone->z_id ? 'selected' : ''}}>{{$zone->z_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(Auth::user()->role == 2)
                            <div class="col-md-6 form-group">
                                <label class="control-label mb-10">لست ساحه ها</label>
                                <select class=" selectCustom" name="branch" required>
                                    <option disabled selected>ساحه را انتخاب کنید</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->br_id}}" {{$user->branch == $branch->br_id ? 'selected' : ''}}>{{$branch->br_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">اجرا تغییرات</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.selectCustom').select2();
</script>