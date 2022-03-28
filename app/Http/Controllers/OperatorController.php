<?php

namespace App\Http\Controllers;

use App\Models\BranchDevice;
use App\Models\BranchDeviceStatus;
use App\Models\CheckTime;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    protected function index()
    {
        return view('operator.index');
    }

    protected function create()
    {
        $data = BranchDeviceStatus::where('user_id', Auth::user()->id)->orderBy('bds_id', 'desc')->first();

        if ($data == '') {
            $devices = BranchDevice::with('deviceName')->where(['branch_id' => Auth::user()->branch, 'is_active' => 1])->get();
            return view('operator.operator', compact('devices'));
        } else {
            $check = CheckTime::first();
            $entryDate = date('Y-m-d', strtotime($data->created_at));
            $fullTime = date('H:i', strtotime($check->insert_time));
            $seconedChance = date('H:i', strtotime($check->insert_chanse_2));

            $times = array();

            $times[] = $fullTime;
            $times[] = $seconedChance;

            function AddPlayTime($times)
            {
                $minutes = 0;
                foreach ($times as $time) {
                    list($hour, $minute) = explode(':', $time);
                    $minutes += $hour * 60;
                    $minutes += $minute;
                }
                $hours = floor($minutes / 60);
                $minutes -= $hours * 60;
                return sprintf('%02d:%02d', $hours, $minutes);
            }

            $validTime = AddPlayTime($times);

            $currentTime = date("H:i");

            $lastInsertTime = date('H:i', strtotime($data->created_at));

            $time1 = new DateTime($lastInsertTime);
            $time2 = new DateTime($currentTime);
            $interval = $time1->diff($time2);

            $hou = $interval->format('%h');
            $min = $interval->format('%i');
            $y = $hou . $min;
            $x = explode(':', $validTime);
            $x = $x[0] . $x[1];

            $remain_time = ($x - $y);
            $msg = "بعد از " . $remain_time . " دقیفه گزارش بدهید ";
            
            if (($x < $y) || ($entryDate != date('Y-m-d'))) {
                $devices = BranchDevice::with('deviceName')->where(['branch_id' => Auth::user()->branch, 'is_active' => 1])->get();
                return view('operator.operator', compact('devices'));
            } else {
                return back()->with('invalid-edit-time', $msg);
            }
        }
    }

    protected function store(Request $request)
    {
        $i = 0;
        foreach ($request->input('radio') as $key => $row) {
            $insert = new BranchDeviceStatus;
            $insert->branch_device_id = $key;
            $insert->branch_id = Auth::user()->branch;
            $insert->zone_id = Auth::user()->zone;
            $insert->status = $row;
            $insert->problem_description = $request->reason[$i];
            $insert->user_id = Auth::user()->id;
            $insert->priority = $request->priority[$key];
            $insert->save();
            $i++;
        }

        return redirect()->route('operator')->with('report-stored', 'گزارش موفقانه ثبت گردید!');
    }

    protected function edit()
    {
        $checking = BranchDeviceStatus::where('user_id', Auth::user()->id)->orderBy('bds_id', 'desc')->first();
        $check = CheckTime::first();

        $insert_time = date('H:i', strtotime($checking->created_at));
        $updateTime = date('i', strtotime($check->update_time));

        $time1 = new DateTime($insert_time);
        $time2 = new DateTime(date('H:i'));
        $interval = $time1->diff($time2);
        $timeDiff = $interval->format('%i');

        if ($timeDiff < $updateTime) {
            $devices = BranchDevice::with('deviceName')->where(['branch_id' => Auth::user()->branch, 'is_active' => 1])->get();
            $devices = count($devices);
            $data = BranchDeviceStatus::with('branch_devices_fun.deviceName')->where('user_id', Auth::user()->id)->orderBy('bds_id', 'desc')->limit($devices)->get();
            return view('operator.edit_operator', compact('data'));
        } else {
            $msg = $updateTime . " دقیقه وقت تغییرات شما ختم گردیده! ";
            return redirect()->route('operator')->with('invalid-edit-time', $msg);
        }
    }

    protected function update(Request $request)
    {
        $i = 0;
        foreach ($request->input('radio') as $key => $row) {
            $update = BranchDeviceStatus::findOrFail($key);
            $update->status = $row;
            $update->problem_description = $request->reason[$i];
            $update->priority = $request->priority[$key];
            $update->save();
            $i++;
        }
        return redirect()->route('operator')->with('report-stored', 'تغییرات در گزارش موفقانه اجرا گردید!');
    }
}
