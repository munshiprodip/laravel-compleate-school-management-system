<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpClasstime extends Model
{
    protected $table = 'ep_classtimes';
    protected $fillable = [
        'name', 'start', 'end', 'created_by', 'updated_by', 'active_status',
    ];
}
