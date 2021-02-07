<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpAssignFees extends Model
{
    protected $table = 'ep_assign_fees';
    protected $fillable = [
        'fees_id',
        'student_id',
    ];
}
