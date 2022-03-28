@if($branchs != '')
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered display pb-30">
                                <tr>
                                    <th class="text-center" style="color: #000; font-size: 1rem;" colspan="4">{{ $branchs->branch_details->br_name }}</th>
                                </tr>
                                @php
                                    $status = App\Models\BranchDeviceStatus::with('branch_devices_fun.deviceName')
                                        ->where('branch_id', $branchs->branch_id)
                                        ->whereDate('created_at', '>=', $date_from)
                                        ->whereDate('created_at', '<=', $date_to)
                                        ->get();
                                @endphp
                                <tr>
                                    <th style="color: #000;">شماره</th>
                                    <th style="color: #000;">وسایل</th>
                                    <th style="color: #000;">حالت</th>
                                    <th style="color: #000;">تاریخ</th>
                                </tr>
                                @php $i = -100; @endphp
                                @foreach ($status as $key => $item)
                                    <tbody>
                                        <tr>
                                            <td style="color: #000; width: 0.1rem;" class="text-center">{{ $key + 1 }}</td>
                                            <td style="width: 10rem;">{{ $item->branch_devices_fun->deviceName->de_name }}</td>
                                            <td>{{ $item->status == '0' ? $item->problem_description : 'سالم'}}</td>
                                            <td style="width: 7rem;"><?php $date = date('Y-m-d', strtotime($item->created_at)); echo to_jalali($date); ?> </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="col-md-12">
        <div class="alert alert-dismissable" style="background-color: #12accb;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="zmdi zmdi-alert-circle-o pr-15 pull-left"></i><p class="pull-left">فعلا گزارش موجود نیست!</p>
            <div class="clearfix"></div>
        </div>
    </div>
@endif