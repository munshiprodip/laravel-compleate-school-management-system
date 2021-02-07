<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpClassroom extends Model
{
    protected $table = 'ep_classrooms';
    protected $fillable = [
        'name', 'capacity', 'created_by', 'updated_by', 'active_status',
    ];
}
