<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchDevice extends Model
{
    protected $table = "branch_devices";
    protected $primaryKey = "br_de_id";

    public function deviceName()
    {
        return $this->hasOne(Device::class, 'de_id', 'device_id');
    }
}
