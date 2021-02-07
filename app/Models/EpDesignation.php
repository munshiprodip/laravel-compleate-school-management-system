<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpDesignation extends Model
{
    protected $table= 'ep_designations';
    protected $fillable = [
        'designation', 'active_status', 'created_by', 'updated_by',
    ];
}
