<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpGender extends Model
{
    protected $table = 'ep_genders';
    protected $fillable = [
        'genders', 'created_by', 'updated_by', 'activ_status',
    ];
}
