<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpSubject extends Model
{
    protected $table = 'ep_subjects';
    protected $fillable = [
      'subjects',  'subject_type', 'class_id', 'section_id', 'active_status', 'created_by', 'updated_by',
    ];


    public function classes()
    {
        return $this->belongsTo('App\Models\EpClass', 'class_id', 'id', 'ep_subjects');
    }
    public function sections()
    {
        return $this->belongsTo('App\Models\EpSection', 'section_id', 'id', 'ep_subjects');
    }
}
