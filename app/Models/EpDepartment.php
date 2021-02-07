<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpDepartment extends Model
{
    protected $table= 'ep_departments';
    protected $fillable = [
        'department', 'active_status', 'created_by', 'updated_by',
    ];
}
