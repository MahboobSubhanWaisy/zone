@if(!$zone->isEmpty())
    <h4>گزارش از تاریخ {{ $date_from }} الی {{ $data_to }}</h4>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <form action="{{'super-admin-approve-report'}}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                @foreach ($zone as $z)
                                    <table class="table table-hover table-bordered display pb-30">
                                        <tr>
                                            <th class="text-center" style="color: #000; font-size: 1rem;" colspan="6">{{ $z->zone_details->z_name }}</th>
                                        </tr>
                                        @php
                                            $branchs = App\Models\BranchDeviceStatus::with('branch_details')
                                                ->select('branch_id')
                                                ->where('zone_id', $z->zone_id)
                                                ->whereDate('created_at', '>=', $date_from)
                                                ->whereDate('created_at', '<=', $date_to)
                                                ->distinct()
                                                ->get();
                                        @endphp

                                        @foreach ($branchs as $branch)
                                            <tr>
                                                <th class="text-center" style="color: #000;" colspan="6">{{ $branch->branch_details->br_name }}</th>
                                            </tr>
                                            @php
                                                $status = App\Models\BranchDeviceStatus::with('branch_devices_fun.deviceName')
                                                    ->where('branch_id', $branch->branch_id)
                                                    ->whereDate('created_at', '>=', $date_from)
                                                    ->whereDate('created_at', '<=', $date_to)
                                                    ->get();
                                            @endphp
                                            <tr>
                                                <th style="color: #000;">شماره</th>
                                                <th style="color: #000;">وسایل</th>
                                                <th style="color: #000;">حالت</th>
                                                <th style="color: #000;">تاریخ</th>
                                                <th style="color: #000;">تغییرات</th>
                                                <th style="display: none; color: #000;" id="th-reject-reason">دلیل لغو</th>
                                            </tr>
                                            @php $i = -100; @endphp
                                            @foreach ($status as $key => $item)
                                                <tbody>
                                                    <tr>
                                                        <td style="color: #000; width: 0.1rem;" class="text-center">{{ $key + 1 }}</td>
                                                        <td style="width: 10rem;">{{ $item->branch_devices_fun->deviceName->de_name }}</td>
                                                        <td>{{ $item->status == '0' ? $item->problem_description : 'سالم'}}</td>
                                                        <td style="width: 7rem;"><?php $date = date('Y-m-d', strtotime($item->created_at)); echo to_jalali($date); ?> </td>
                                                        <td style="width: 1rem;">
                                                            <div class="radio radio-success">
                                                                <input type="radio" name="radio[{{ $item->bds_id }}]" id="radio-{{ $item->bds_id }}" class="radioChecked" value="1" data="{{ $key }}">
                                                                <label for="radio-{{ $item->bds_id }}">تایید</label>
                                                            </div>
                                                            <div class="radio radio-danger">
                                                                <input type="radio" name="radio[{{ $item->bds_id }}]" id="radio-{{ $item->bds_id + 100 }}" value="0" data="{{ $key }}" class="radioChecked" value="0">
                                                                <label for="radio-{{ $item->bds_id + 100 }}">لغو</label>
                                                            </div>
                                                        </td>
                                                        <td style="display: none !important;" class="reason-{{ $key }}">
                                                            <div class="form-group">
                                                                <input type="text" name="reason[]" class="form-control reason-{{ $key }}" placeholder="دلیل خراب بودن را بنویسید">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        @endforeach
                                    </table>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary btn-outline pull-right"><i class="fa fa-save"></i> ذخیره</button>
                        </form>
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