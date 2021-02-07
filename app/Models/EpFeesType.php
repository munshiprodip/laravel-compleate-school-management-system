<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpFeesType extends Model
{
   protected $table = 'ep_fees_types';

    protected $fillable = [
        'name', 'description', 'active_status', 'created_by', 'updated_by',
    ];
}
