<?php

namespace App\Http\Controllers;

use App\Models\BranchDevice;
use App\Models\BranchDeviceStatus;
use App\Models\Zone;
use App\Models\ZoneCoverBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ReportController extends Controller
{
    protected function index()
    {
        if (Auth::user()->role == 1) {
            $data['branches'] = ZoneCoverBranch::all();
            $data['zones'] = Zone::all();
        } else if (Auth::user()->role == 2) {
            $data['branches'] = ZoneCoverBranch::where('zone_id', Auth::user()->zone)->get();
        }

        return view('report.index', $data);
    }

    protected function show(Request $request)
    {
        include 'public/asset/dist/jdate.php';
        $data['date_from'] = to_gregorian($request->start_date);
        $data['date_to'] = to_gregorian($request->end_date);

        if (Auth::user()->role == '1') {
            $data['zone'] = BranchDeviceStatus::with('zone_details')->select('zone_id')->where('zone_id', $request->zone)->whereDate('created_at', '>=', $data['date_from'])->whereDate('created_at', '<=', $data['date_to'])->distinct()->get();
            return view('report.show_report', $data);
        } else if (Auth::user()->role == '2') {
            $data['branchs'] = BranchDeviceStatus::with('branch_details')->where('branch_id', $request->branch)->whereDate('created_at', '>=', $data['date_from'])->whereDate('created_at', '<=', $data['date_to'])->first();

            return view('report.show_report_as_branch', $data);
        }
    }

    protected function superAdminApprove(Request $request)
    {
        $i = 0;
        foreach ($request->input('radio') as $key => $row) {
            $update = BranchDeviceStatus::findOrFail($key);
            $update->approve = $row;
            $update->reject_description = $request->reason[$i];
            $update->approved_by = Auth::user()->id;
            $update->save();
            $i++;
        }
        return redirect()->route('report')->with('approve-report', 'گزارش موفقانه تایید گردید!');
    }
}
