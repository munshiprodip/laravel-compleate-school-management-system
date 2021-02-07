<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpSession extends Model
{
    protected $table= 'ep_sessions';
    protected $fillable = [
        'sessions', 'active_status', 'created_by', 'updated_by',
    ];
}
