<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Session; 

class DeviceController extends Controller
{
    protected function index()
    {
        $data['devices'] = Device::all();
        // dd($data);

        return view('device/device_list', $data);
    }

    protected function store(Request $request)
    {
        $validate = $request->validate([
            'device_name' => ['required', 'string', 'unique:devices,de_name']
        ]);

        $all = count($request->device_name);

        for($i = 0; $i < $all; $i++){
            $new_device = new Device;
            $new_device->de_name = $request->device_name[$i];
            $new_device->created_by = 1;
            $new_device->save();
        }

        Session::flash('devices-created', 'وسایل اضافه گردید!');

        return back();
    }

    protected function update(Request $request)
    {
        $validate = $request->validate([
            'device-name' => ['required', 'string', 'unique:devices,de_name']
        ]);

        $update_device = Device::findOrFail($request->input('data'));
        $update_device->de_name = $request->input('device-name');
        $update_device->updated_by = 1;
        $update_device->save();

        return $update_device == true ? 'Updated' : 'not';
    }
}
