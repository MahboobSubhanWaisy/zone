<?php

namespace App\Http\Controllers;

use App\Models\BranchDevice;
use App\Models\CheckTime;
use App\Models\Device;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Models\ZoneCoverBranch;
use Session;

class BranchController extends Controller
{
    protected function index()
    {
        $data['branches'] = ZoneCoverBranch::with('zone')->where('is_active', 1)->get();
        $data['zones'] = Zone::where('is_active', 1)->get();
        $data['devices'] = Device::all();
        
        return view('branch/branch_list', $data);
    }

    protected function store(Request $request)
    {
        $validate = $request->validate([
            'side-name'     => ['required', 'string', 'unique:zone_cover_branches,br_name'],
            'zone-name'     => ['required', 'numeric'],
            'branch-devices' => 'required'
        ]);

        $new_branch                 = new ZoneCoverBranch;
        $new_branch->br_name        = $request->input('side-name');
        $new_branch->zone_id        = $request->input('zone-name');
        $new_branch->created_by     = 1;
        $new_branch->save();

        foreach($request->input('branch-devices') as $item)
        {
            $new_device = new BranchDevice;
            $new_device->branch_id = $new_branch->br_id;
            $new_device->device_id = $item;
            $new_device->created_by = 1;
            $new_device->save();
        }

        Session::flash('branch-created', 'ساحه جدید اضافه گردید!');

        return back();
    }

    protected function show($id)
    {
        $data['branch'] = ZoneCoverBranch::with('zone', 'devices.deviceName')->findOrFail($id);

        return view('branch/view_branch_modal', $data);
    }

    // Update Time For Insert and Update Record of Operator 
    protected function editTime()
    {
        $data_db = CheckTime::first();
        $hour = explode(':', $data_db->insert_time);
        $data['hour']  = substr($hour[0], 1, 1);
        $data['mins']   = $hour[1];

        $second_chanse = explode(':', $data_db->insert_chanse_2);
        $data['second_chanse'] = $second_chanse[1];

        $update_time = explode(':', $data_db->update_time);
        $data['update_time'] = $update_time[1];

        return view('layouts/edit_time', $data);
    }

    protected function updateTime(Request $request)
    {
        $update = CheckTime::first();
        $update->insert_time = '0' . $request->input('hour') . ':' . $request->input('mins') . ':00';;
        $update->insert_chanse_2 = '00:' . $request->input('second_chanse') . ':00';
        $update->update_time = '00:' . $request->input('update_time') . ':00';
        $update->save();

        return $update == true ? 'Updated' : 'not';        
    }

    protected function edit($id)
    {
        $data['branch'] = ZoneCoverBranch::with('zone', 'devices.deviceName')->findOrFail($id);
        $data['zones'] = Zone::all();
        $data['devices_all'] = Device::all();

        // dd($data);
        return view('branch/edit_branch_modal', $data);
    }

    protected function update(Request $request)
    {
        $validate = $request->validate([
            'side-name'     => 'required|string',
            'zone-name'     => 'required|numeric'
        ]);

        $update = ZoneCoverBranch::findOrFail($request->input('data-id'));
        $update->br_name    = $request->input('side-name');
        $update->zone_id    = $request->input('zone-name');
        $update->updated_by = 1;
        $update->save();

        $selected_devices = $request->input('branch_devices');

        if($selected_devices != ''){
            foreach($selected_devices as $device_id){
                $old_id = BranchDevice::where('branch_id', ($request->input('data-id')))->where('device_id',$device_id)->get();
                if($old_id->isEmpty()){
                    $insert = new BranchDevice;    
                    $insert->branch_id  = $request->input('data-id');
                    $insert->device_id = $device_id;
                    $insert->created_by = 1;
                    $insert->save();
                }
            }
        }
    
        $old_id = BranchDevice::where('branch_id', ($request->input('data-id')))->get();
        foreach($old_id as $dev){
            if($selected_devices != ''){
                if(!in_array($dev->device_id, $selected_devices)){
                    $update = BranchDevice::findOrFail($dev->br_de_id);
                    $update->is_active = 0;
                    $update->save();
                }else{
                    $update = BranchDevice::findOrFail($dev->br_de_id);
                    $update->is_active = 1;
                    $update->save();
                }
            }else{
                $update = BranchDevice::findOrFail($dev->br_de_id);
                $update->is_active = 0;
                $update->save();
            }
        }

        return $update == true ? 'Updated' : 'not';
    }

    protected function delete(Request $request)
    {
        $delete = ZoneCoverBranch::findOrFail($request->input('data-id'));
        $delete->is_active = 0;
        $delete->save();

        return $delete == true ? 'Deleted' : 'not';
    }
}
