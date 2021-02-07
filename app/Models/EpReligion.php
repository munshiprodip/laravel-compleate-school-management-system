<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpReligion extends Model
{
    protected $table = 'ep_religions';
    protected $fillable = [
        'religions', 'created_by', 'updated_by', 'activ_status',
    ];
}
