<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpFeesSetup extends Model
{
    protected $table = 'ep_fees_setup';
    protected $fillable = [
        'description', 'type_id', 'end_date', 'taka', 'active_status', 'created_by', 'updated_by'
    ];

    public function feesType()
    {
        return $this->belongsTo('App\Models\EpFeesType', 'type_id', 'id', 'ep_fees_types');
    }

    public function assignedStudent()
    {
        return $this->belongsToMany(EpStudent::class, 'ep_assign_fees', 'fees_id', 'student_id');

    }
}
