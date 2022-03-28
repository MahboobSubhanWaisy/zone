<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchDeviceStatus extends Model
{
    protected $table = "branch_device_statuses";
    public $primaryKey = "bds_id";

    public function branch_devices_fun()
    {
        return $this->hasOne(BranchDevice::class, 'br_de_id', 'branch_device_id');
    }

    public function branch_details()
    {
        return $this->hasOne(ZoneCoverBranch::class, 'br_id', 'branch_id');
    }

    public function zone_details()
    {
        return $this->hasOne(Zone::class, 'z_id', 'zone_id');
    }
}

