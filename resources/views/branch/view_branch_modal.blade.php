<div id="view-branch-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button type="button" class="close" style="color: #fff;" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" style="color: #fff;"> {{__('words.Branch Details')}}</h5>
            </div>
            <div class="container-fluid">
                <div class="modal-body">
                    <p style="text-align: center; color: #000;" class="mt-20">{{$branch->zone->z_name}} ({{$branch->br_name}})</p>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <p style="color: #000;" class="mb-10">  {{__('words.Device List')}}</p>
                        @foreach($branch->devices as $item)
                        <div class="col-lg-3 col-md-3 col-12" style="border: 1px solid; padding: 0.3rem;">
                            {{$item->deviceName->de_name}}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>