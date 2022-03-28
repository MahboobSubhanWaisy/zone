<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Session;

class ZoneController extends Controller
{
    protected function index()
    {
        $data['zones'] = Zone::where('is_active', 1)->get();

        return view('zone/zone_list', $data);
    }

    protected function store(Request $request)
    {
        $validate = $request->validate([
            'zone-name'     => ['required', 'string', 'unique:zones,z_name'],
            'zone-location' => 'required|string'
        ]);

        $new_zone               = new Zone;
        $new_zone->z_name       = $request->input('zone-name');
        $new_zone->z_location   = $request->input('zone-location');
        $new_zone->created_by   = 1;
        $new_zone->save();

        Session::flash('zone-created', 'زون جدید اضافه گردید!');

        return back();
    }

    protected function update(Request $request)
    {
        $validate = $request->validate([
            'zone-name'     => 'required|string',
            'zone-location' => 'required|string'
        ]);

        $update = Zone::findOrFail($request->input('data'));
        $update->z_name = $request->input('zone-name');
        $update->z_location = $request->input('zone-location');
        $update->updated_by = 1;
        $update->save();

        return $update == true ? 'Updated' : 'not';
    }

    protected function delete(Request $request)
    {
        $delete = Zone::findOrFail($request->input('data-id'));
        $delete->is_active = 0;
        $delete->save();

        return $delete == true ? 'Deleted' : 'not';
    }
}
