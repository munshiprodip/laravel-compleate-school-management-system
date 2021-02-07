<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpParent extends Model
{
    protected $table = 'ep_parents';
    protected $fillable = [
        'fathers_name','fathers_occupation','fathers_photo','mothers_name','mothers_occupation',
        'mothers_photo','fathers_mobile','mothers_mobile','active_status', 'created_by', 'updated_by','user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'ep_parents');
    }

    public function students()
    {
        return $this->hasMany('App\Models\EpStudent', 'parents_id', 'id');
    }
}
