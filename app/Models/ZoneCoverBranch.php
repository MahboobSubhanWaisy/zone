<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneCoverBranch extends Model
{
    protected $table = "zone_cover_branches";
    protected $primaryKey = "br_id";

    public function zone()
    {
        return $this->hasOne('App\Models\Zone', 'z_id', 'zone_id');
    }
    
    public function devices()
    {
        return $this->hasMany('App\Models\BranchDevice', 'branch_id', 'br_id')->where('is_active', 1);
    }
}
