<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpBloodgroup extends Model
{
    protected $table = 'ep_bloodgroups';
    protected $fillable = [
        'bloodgroups', 'created_by', 'updated_by', 'active_status',
    ];
}
