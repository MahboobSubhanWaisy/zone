<?php

namespace App\Http\Controllers;

use App\Models\BranchDeviceStatus;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected function index()
    {
        $data['notiCount'] = BranchDeviceStatus::where(['status' => 0, 'approve' => 0])->count();
        $data['hight'] = BranchDeviceStatus::where(['status' => 0, 'approve' => 0, 'priority' => 1])->count();
        $data['middle'] = BranchDeviceStatus::where(['status' => 0, 'approve' => 0, 'priority' => 2])->count();
        $data['low'] = BranchDeviceStatus::where(['status' => 0, 'approve' => 0, 'priority' => 3])->count();
        
        return view('layouts/notifications', $data);
    }
}
