<div id="edit-branch-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button type="button" class="close" style="color: #fff;" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" style="color: #fff;">  {{__('words.Changes')}}</h5>
            </div>
            <form id="branch-form">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="data-id" value="{{$branch->br_id}}">
                    <div class="form-group">
                        <label class="control-label mb-10 text-left">  {{__('words.Branch Name')}}</label>
                        <input type="text" name="side-name" value="{{$branch->br_name}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">  {{__('words.Zone List')}}</label>
                        <select class=" selectCustom" name="zone-name" required>
                            <option disabled selected>  {{__('words.Select Zone')}}</option>
                            @foreach ($zones as $zone)
                                <option value="{{$zone->z_id}}" {{$branch->zone_id == $zone->z_id ? 'selected' : ''}}>{{$zone->z_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12 mb-10" style="color: #000;">
                        <label for=""> {{__('words.Device List')}}</label>
                    </div>
                    @foreach ($devices_all as $key => $device)
                        <div class="col-lg-3 col-md-3 col-12 mb-20">
                            <div class="checkbox checkbox-success">
                                <input id="checkbox-{{$key}}" name="branch_devices[]" value="{{$device->de_id}}" type="checkbox" 
                                @foreach ($branch->devices as $item)  
                                    {{$item->device_id == $device->de_id ? 'checked' : ''}}
                                @endforeach >
                                <label for="checkbox-{{$key}}">{{$device->de_name}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="branch-changes">{{__('words.Update')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('words.Close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.selectCustom').select2();
</script>